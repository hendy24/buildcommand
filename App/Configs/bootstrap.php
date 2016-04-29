<?php

/*
 *	Set site directories
 */


	define('CSS', SITE_URL . DS . 'css');
	define('IMAGES', SITE_URL . DS . 'images');
	define('JS', SITE_URL . DS . 'js');
	define('FILES', SITE_URL . DS . 'files');
	define('FONTS', SITE_URL . DS . 'fonts');
	define('VIEWS', APP_DIR . DS . 'Views');

	// Framework directories
	define('FRAMEWORK_URL', SITE_URL . DS . 'aptitude-public');
	define('FRAMEWORK_CSS', FRAMEWORK_URL . DS . 'css');
	define('FRAMEWORK_IMAGES', FRAMEWORK_URL . DS . 'images');
	define('FRAMEWORK_JS', FRAMEWORK_URL . DS . 'js');



/*
 * Error Reporting
 *
 */

 	//set_error_handler('_exeption_handler', E_STRICT);

 	if (file_exists(ROOT . DS . '.development')) {
 		define(DEVELOPMENT, true);
	 	ini_set('html_errors', 'on');
	 	ini_set('display_errors', 'on');
 	} else {
 		define(DEVELOPMENT, false);
	 	ini_set('html_errors', 'off');
	 	ini_set('display_errors', 'off');
 	}


// set timezone
date_default_timezone_set('America/Boise');

/*
 * -------------------------------------------
 * INCLUDE ALL REQUIRED FILES
 * -------------------------------------------
 *
 */

 	//require_once(FRAMEWORK_PROTECTED_DIR . DS . 'Vendors/Smarty-3.1.19/Libraries/Smarty.class.php');
 	require(APTITUDE_CORE . DS . 'Controllers' . DS . 'MainController.php');
 	require(APTITUDE_CORE . DS . 'Models' . DS . 'MainModel.php');
 	require_once(APTITUDE_CORE . DS . 'Vendors' . DS . 'Smarty-3.1.19' . DS . 'libs' . DS . 'Smarty.class.php');
 	require_once (APTITUDE_CORE . DS . 'Vendors' . DS . 'PHPMailer' . DS . 'PHPMailerAutoload.php');
 	require(APTITUDE_CORE . DS . 'Libraries/Singleton.php');
 	require(APTITUDE_CORE . DS . 'Libraries/Common.php');
 	require(APTITUDE_CORE . DS . 'Libraries/Authentication.php');
 	require_once(APTITUDE_CORE . DS . 'Libraries' . DS .'MySqlDb.php');
  	require_once(APTITUDE_CORE . DS . 'Configs/config.php');
  	require_once(APP_DIR . DS . 'Configs/database.php');

  	spl_autoload_register('__autoload');

 	function __autoload($className) {
	 	// list of directories to scan
		$dirs = array(
			APTITUDE_CORE . DS . 'Controllers',
			APTITUDE_CORE . DS . 'Libraries/',
			APTITUDE_CORE . DS . 'Libraries/Components/',
			APTITUDE_CORE . DS . 'Models/',
			APP_DIR . DS . 'Controllers/',
			APP_DIR . DS . 'Libraries/',
			APP_DIR . DS . 'Libraries/Components/',
			APP_DIR . DS . 'Helpers/',
			APP_DIR . DS . 'Models/',
		);


		// if the file exists in any of the defined directories, require it...
		foreach ($dirs as $d) {
			if (file_exists("{$d}/{$className}.php")) {
				require_once ("{$d}/{$className}.php");
			} elseif (file_exists("{$d}/{$className}Controller.php")) {
				require_once ("{$d}/{$className}Controller.php");
			} elseif (file_exists("{$d}/{$className}Component.php")) {
				require_once ("{$d}/{$className}Component.php");
			} elseif (file_exists("{$d}/{$className}Helper.php")) {
				require_once ("{$d}/{$className}Helper.php");
			}
		}


 	}




/*
 * -------------------------------------------
 * Instantiate Smarty
 * -------------------------------------------
 *
 */

	$smarty = new Smarty();
	$smarty->setTemplateDir(APP_DIR . DS . 'Views')
		->setCompileDir(APP_DIR . DS . 'Compile')
		->setCacheDir(APP_DIR . DS . 'Cache')
		->setConfigDir(APP_DIR . DS . 'ViewConfigs');

	$smarty->assign(array(
		'APP_NAME' => APP_NAME,
		'COMPANY_NAME' => COMPANY_NAME,
		'ROOT' => ROOT,
		'SITE_URL' => SITE_URL,
		'FRAMEWORK_URL' => FRAMEWORK_URL,
		'FRAMEWORK_CSS' => FRAMEWORK_CSS,
		'FRAMEWORK_IMAGES' => FRAMEWORK_IMAGES,
		'FRAMEWORK_JS' => FRAMEWORK_JS,
		'CSS' => CSS,
		'IMAGES' => IMAGES,
		'JS' => JS,
		'FILES' => FILES,
		'VIEWS' => VIEWS,
		'flashMessages' => ''
	));



	$smarty->escape_html = true;

/*
 * Include any additional variables to be available globally
 *
 */

 	$error_messages = array();
 	global $error_messages;

 	$success_messages = array();
 	global $success_messages;

 	// Instantiate classes



	if (! function_exists('db')) {
		function db() {
			global $db;
			return $db;
		}
	}

	session_start();
	$session = Session::getInstance();


	if (! function_exists ('session')) {
		function session() {
			global $session;
			return $session;
		}
	}
	$smarty->assignByRef('session', $session);


	$auth = Authentication::getInstance();
	if (! function_exists('auth')) {
		function auth() {
			global $auth;
			return $auth;
		}
	}

	$smarty->assignByRef('auth', $auth);


	$input = new Input();
	if (! function_exists('input')) {
		function input() {
			global $input;
			return $input;
		}
	}
	$smarty->assignByRef('input', $input);



	if (! function_exists('smarty')) {
		function smarty() {
			global $smarty;
			return $smarty;
		}
	}


 /*
 * INCLUDE ROUTES.PHP
 *
 */



	if (file_exists (APTITUDE_CORE . '/Configs/routes.php')) {
		require (APTITUDE_CORE . '/Configs/routes.php');
	} else {
		echo "Make sure that " . APTITUDE_CORE . "/Configs/routes.php exists";
		exit;
	}
