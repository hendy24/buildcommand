<?php 

/**
 *	Index
 *
 *	This is the main page for handling all requests.  The apache config file should be set for the URL to go straight to this page.
 *
 * 	PHP 5
 *
 *	This framework was developed by Aptitude for use on any type of project ranging from a small public website to a large we-based application.
 *
 *	@copyright  	Copyright 2014, Aptitude IT, LLC
 * 	@version  		AptitudeFramework version 2.0
 */

	if (!defined('DS')) {
		define('DS', DIRECTORY_SEPARATOR);
	}

/**
 *	If the apache config file is set correctly the root directory will not yet be defined.  Define it here.
 */

	if (!defined('ROOT')) {
		define('ROOT', dirname(dirname(dirname(__FILE__))));
	}

	if (!defined('APP_DIR')) {
		define('APP_DIR', dirname(dirname(__FILE__)));
	}

 	define('APTITUDE_CORE', ROOT . DS . 'Core');


	// Check for https
	if ($_SERVER['HTTPS']) {
		define('SITE_URL', 'https://' . $_SERVER['SERVER_NAME']);
	} else {
		define('SITE_URL', 'http://' . $_SERVER['SERVER_NAME']);
	}

	define('APP_NAME', 'BuildCommand');
	define('COMPANY_NAME', 'BuildCommand');

/**
 *
 * Include the bootstrap file in the protected directory and we're off!
 */

	if (file_exists(APP_DIR . DS . 'Configs' . DS . 'bootstrap.php')) {
		require(APP_DIR . DS . 'Configs' . DS . 'bootstrap.php');
	} else {
		echo "Make sure " . APP_DIR . DS . 'Configs' . DS . "/bootstrap.php exists";
	}
