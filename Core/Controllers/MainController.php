<?php

/*
 *	All other classes will extend the MainController, so use functions here that need to be 
 *	used in all other controllers.
 *
 */


class MainController {

	protected $module;
	protected $page;
	protected $action;
	protected $content = null;
	protected $template = 'default';
	protected $helper = null;
	protected $title = null;
	

	/*
	 * -------------------------------------------------------------------------
	 *  CONSTRUCT THE CLASS
	 * -------------------------------------------------------------------------
	 */

	public function __construct() {			
		// Load any other components defined in the child class
		if (!empty($this->components)) {
			foreach($this->components as $c) {
				$this->loadComponent($c);
			}
		}
	}


	/*
	 * -------------------------------------------------------------------------
	 *  AJAX CALL TO DELETE BY ID
	 * -------------------------------------------------------------------------
	 */

	public function deleteId() {
		//	If the id var is filled then delete the item with that id
		if (input()->id != '') {
			$model = getModelName(input()->page);
			$class = $this->loadModel($model, input()->id);

			// $class->public_id = input()->id;			
			if ($class->delete()) {
				return true;
			}

			return false;
		}

		return false;
	}

	



	
	/*
	 *
	 * -------------------------------------------------------------
	 *  LOAD MODELS, VIEWS, PLUGINS, COMPONENTS, AND HELPERS
	 * -------------------------------------------------------------
	 * 
	 */

	
	public function loadModel($name, $id = false) {
		if (file_exists (APP_DIR . DS . 'Models' . DS . $name . '.php')) {
			require_once (APP_DIR . DS . 'Models' . DS . $name . '.php');		
		} 

		if (class_exists($name)) {
			$class = new $name;
		} else {
			smarty()->assign('message', "Could not find the class {$name}");
			$this->loadView('error', 'index');
			exit;
		}

		if ($id) {
			return $class->fetchById($id);
		} else {
			//  This is an empty object, get the column names
			return $class->fetchColumnNames();			
		}
		
	}





	/*
	 * -------------------------------------------------------------------------
	 * PAGE VIEW
	 * -------------------------------------------------------------------------
	 *
	 *	Set the content - this is the tpl file fort method which is called in the
	 *	controller,  then call the default main.tpl file.
	 *
	 */

	public function loadView($folder, $name, $module = '') {	
		smarty()->assign('currentUrl', SITE_URL . $_SERVER['REQUEST_URI']);

		//	Make sure the session is valid and get the user info
		//	Re-direction is failing here, for some reason we are not passing the 
		//	auth()->isLoggedIn() test

		if (!auth()->isLoggedIn()) {
			if ($folder != 'login' && $folder != "site") {
				$this->redirect(array('page' => 'login', 'action' => 'logout'));
			} 
		} 

		// Load any info from AppController
		$appController = new AppController;
		$appController->siteData();
		
		if ($this->helper != null) {
			$helper = $this->loadHelper($this->helper, $this->module);
			smarty()->assignByRef($helper, $helper);
		}

		$this->page = ucfirst($folder);
		$this->action = $name;

		// Check session for errors to be displayed
		session()->checkFlashMessages();
		
		//	If is_micro is set in the url then display a blank template
		if (isset (input()->isMicro) && input()->isMicro == 1) {
			$this->template = 'blank';
		}

		if ($this->content != "") {
			$name = $this->content;
		} 

		if (file_exists (VIEWS . DS . underscore_string($folder) . DS . $name . '.tpl')) {
			smarty()->assign('content', underscore_string($folder) . '/' . $name . '.tpl');
		} else {
			smarty()->assign('content', "error/no-template.tpl");
		}
		if ($this->title != '') {
			$title = $this->title;
		} else {
			$title = stringify($name);
		}
		smarty()->assign('title', $title);

		// set the base template
		smarty()->display("layouts/{$this->template}.tpl");
		
	}





	/*
	 * -------------------------------------------------------------------------
	 *  LOAD AN ELEMENT
	 * -------------------------------------------------------------------------
	 */
	
	public function loadElement($name) {
		$obj = new PageController();
		$element = $obj->element($name);
		return $element;
	}




	/*
	 * -------------------------------------------------------------------------
	 *  LOAD A PLUGIN
	 * -------------------------------------------------------------------------
	 */
	
	public function loadPlugin($name) {
		if (file_exists (PROTECTED_DIR . '/plugins/' . $name . '.php')) {
			require (PROTECTED_DIR . '/plugins/' . $name . '.php');
		} 
	}




	/*
	 * -------------------------------------------------------------------------
	 *  LOAD A HELPER -- this is a view helper
	 * -------------------------------------------------------------------------
	 */
	
	public function loadHelper($name, $module = null) {
		if (file_exists (APTITUDE_CORE . '/Views/helpers/' . $name . 'Helper.php')) {
			require (APTITUDE_CORE . '/Views/helpers/' . $name . 'Helper.php');
		} elseif (file_exists (APP_DIR . DS . 'Views/helpers/' . $name . 'Helper.php')) {
			require (APP_DIR . '/Views/helpers/' . $name . 'Helper.php');
		} 

		$className = $name . 'Helper';
		$helper = new $className;
		return $helper;
	}




	/*
	 * -------------------------------------------------------------------------
	 *  LOAD A COMPONENT CLASS
	 * -------------------------------------------------------------------------
	 */
	
	public function loadComponent($name) {
		$component = new $name;
		return $component;
	}
	


	/*
	 * -------------------------------------------------------------------------
	 *  LOAD AN ALTERNATE TEMPLATE TO USE
	 * -------------------------------------------------------------------------
	 */
	
	// public function template($name = false) {
	// 	global $config;
	// 	if ($name) {
	// 		$config['main_template'] = $name.'.tpl';
	// 	}
		
	// }
	


	/*
	 * -------------------------------------------------------------------------
	 *  SET A VARIABLE TO BE LOADED WITH THE CLASS
	 * -------------------------------------------------------------------------
	 */
	
	public function set($name, $var) {
		$this->$name = $var;
	}
	
	




			
	/*
	 *
	 * -------------------------------------------------------------
	 *  PAGE REDIRECTION
	 * -------------------------------------------------------------
	 */
		
	public function redirect($params = false) {	

		if (is_array($params)) {	
				$redirect_url = SITE_URL . "/?";

				if (isset ($params['page'])) {
					$params['page'] =  strtolower(preg_replace('/([^A-Z-])([A-Z])/', '$1-$2', $params['page']));
				} 

				if (isset ($params['action'])) {
					if ($params['action'] == 'index') {
						unset ($params['action']);
					}
				}
				foreach ($params as $k => $p) {
					$redirect_url .= "{$k}={$p}&";
				}

				$redirect_url = trim ($redirect_url, "&amp;");
		} elseif ($params) {
			$redirect_url = $params;
		} else {
			$redirect_url = SITE_URL;
		}

		$this->redirectTo($redirect_url);
		
	}	
	
	private function redirectTo($url) {
		header("Location: " . $url);
		exit;
	}
		
	




	
	/*
	 *
	 * -------------------------------------------------------------
	 *  VALIDATE DATA
	 * -------------------------------------------------------------
	 * 
	 */
	 
	 protected function validateData($dataArray = array(), $flash_message = false, $redirect_to = false) {
	 	$fail = false;
		$returnData = array();
		foreach ($dataArray as $key => $data) {
			foreach ($data as $k => $d) {
				 if ($d == '') {
				 	$fail = true;
					session()->setFlash($flash_message);
					$this->redirect($redirect_to);
				} else {
					session()->saveData($k, strip_tags($d));
					$returnData[$key][$k] = strip_tags($d);
				}
			}
		}
		
		if ($fail) {
			exit;
		}
		
		return $returnData;		

	 }
	
	



	
	/*
	 *
	 * -------------------------------------------------------------
	 *  Looks in a folder and returns the contents
	 * -------------------------------------------------------------
	 * 
	 * This method is especially useful for folders with photos (i.e. - for the slideshow on the home page)
	 *
	 */
	
	protected function directoryToArray($directory, $recursive) {
	    $array_items = array();
	    if ($handle = opendir($directory)) {
	        while (false !== ($file = readdir($handle))) {
	            if ($file != "." && $file != "..") {
	                if (is_dir($directory. "/" . $file)) {
	                    if($recursive) {
	                        $array_items = array_merge($array_items, directoryToArray($directory. "/" . $file, $recursive));
	                    }
	                    $file = $directory . "/" . $file;
	                    $array_items[] = preg_replace("/\/\//si", "/", $file);
	                } else {
	                    $file = $directory . "/" . $file;
	                    $array_items[] = preg_replace("/\/\//si", "/", $file);
	                }
	            }
	        }
	        closedir($handle);
	    } else {
		    echo "<br />Make sure $directory exists and try again.";
		    exit;
	    }
	    
	    foreach ($array_items as $item) {
		    $explodedArray[] = (explode('/', $item));
	    }
	    
	    foreach ($explodedArray as $a) {
		    $filteredArray[] = array_pop($a);

	    }
	    
	    return $filteredArray;
	}
		
	


	public function getColumnHeaders($data, $class = null) {
		if (is_object($data)) {
			foreach($data as $key => $column) {
				if (!in_array($key, $data->fetchColumnsToInclude())) {
					unset($data->$key);
				}
			}
		} else {
			foreach($data as $key => $column) {
				if (!in_array($column, $class->fetchColumnsToInclude())) {
					unset($data[$key]);
				}
			}
		}
		

		return $data;
	}
	
	
	


	
	/*
	 * -------------------------------------------------------------
	 *  PHPMailer -- send emails
	 * -------------------------------------------------------------
	 * 
	 */
	 
	public function sendEmail($data) {
		
		global $config;
		global $params;
		
		$mail = new PHPMailer(true);
		$mail->IsSMTP();
		
		/**
		 * These mail settings are specific to bluehost
		 */
		
		
		try {				
			$mail->SMTPDebug = 2;                    
			$mail->SMTPAuth = true;    
			$mail->SMTPSecure = "ssl";              
			$mail->Host = $config['email_host'];  // email must be sent from server for bluehost 
			$mail->Port = 465;                   
			$mail->Username = $config['email_username'];  
			$mail->Password = $config['email_password'];       
			$mail->SetFrom($data['post']['email'], $data['post']['name']);    
			$mail->AddAddress($config['email_to']);
			$mail->Subject = $params['site_name'] . ' Message: ' . $data['post']['subject'];
			$mail->Body = $data['post']['message_body'];
			if ($mail->Send()) {
				return true;
			} else {
				return false;
			}
		} catch (phpmailerException $e) {
			echo $e->errorMessage(); //Pretty error messages from PHPMailer
		} catch (Exception $e) {
			echo $e->getMessage(); //Boring error messages from anything else!
		}
	}


}