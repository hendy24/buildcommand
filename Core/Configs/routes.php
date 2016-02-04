<?php

/*
*
* -------------------------------------------------------------
* ROUTE TO THE CORRECT PAGE BASED ON URL
* -------------------------------------------------------------
* 
* NOTE:  This routes file will handle urls like site_url/page/action or site_url?page=page&action=action.
*
*/	
	
// Get the requested URL
$request = $_SERVER['REQUEST_URI'];

/*
 * Check first for post variables which contain a page and action
 */

if (isset (input()->page)) {
	$page = ucfirst(camelizeString(input()->page));
	if (isset (input()->action)) {
		$action = input()->action;
	} else {
		$action = "index";
	}
} else {
	$page = "Site";
	$action = "index";

	$queryString = explode('/', $request);
	if (isset ($queryString[1])) {
		if ($queryString[1] != '') {
			if (method_exists("SiteController", $queryString[1])) {
				$page = "Site";	
			} elseif (method_exists("LoginController", $queryString[1])) {
				$page = "Login";
			} elseif (method_exists($queryString[1]."Controller", $queryString[2])) {
				$page = $queryString[1];
			}
			$action = $queryString[1];
		} else {
			$action = "index";
		}
		
		
	} 
	
}


//	Camelize and underscore the action to check for different method naming conventions
$camelizedAction = camelizeString($action);
$underscored_action = underscore_string($action);

/*
 * -------------------------------------------
 * INSTANTIATE THE CONTROLLER CLASS
 * -------------------------------------------
 *
 */	 
 
if (file_exists (APP_DIR . DS . 'Controllers' . DS . $page.'Controller.php')) { 
	include_once (APP_DIR . DS . 'Controllers' . DS . $page.'Controller.php');
} 

$className = $page.'Controller';

// If the class exists, instantiate it and load the coorespondig view from the Views folder. Otherwise, load the
// error page.
if (class_exists($className)) {	
	$controller = new $className;	

	// Check the camelized, underscored, and action variables for the method within the class	
	if (method_exists($controller, $camelizedAction)) {
		$controller->$camelizedAction();
		$controller->loadView(lcfirst($page), $camelizedAction);
	} elseif (method_exists($controller, $underscored_action)) { 
		$controller->$underscored_action();
		$controller->loadView(lcfirst($page), $underscored_action);
	} elseif (method_exists($controller, $action)) { 
		$controller->$action();
		$controller->loadView(lcfirst($page), $action);
	} else {
		$controller = new ErrorController();
		// If it does not exist load the default error view
		$controller->loadView('Error', 'index');
	}		
		
} else {  // If there is not a matching class redirect to the home page.
	$controller = new MainController();
	$controller->redirect();
}
