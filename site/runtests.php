<?php
	include "lib/interfaces.php";
	try {
		spl_autoload_register(function ($class) {
			if (substr($class,-strlen("Model"))==="Model") {
				require 'models/' . $class . '.php';
			} elseif (substr($class,-strlen("View"))==="View") {
				require 'views/' . $class . '.php';
			} elseif (substr($class,-strlen("Controller"))==="Controller") {
				require 'controllers/' . $class . '.php';
			} else {
				require 'lib/' . $class . '.php';
			}
		},true);
		
		date_default_timezone_set('Pacific/Auckland');
		set_error_handler("exception_error_handler");
		error_reporting(E_ALL | E_STRICT);	
		$context=Context::createFromConfigurationFile("website.conf");
		$context->setUser(new UserModel($context));
		$tests = new TestController($context);
		$tests->process();
	} catch (Exception $ex) {
		echo $ex->getMessage();
	}
	function exception_error_handler($errno, $errstr, $errfile, $errline ) {
		throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
	}
?>