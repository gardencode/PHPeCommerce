<?php
	include 'lib/interfaces.php';

	// version check 	
	if ((!function_exists('version_compare')) ||
	    (version_compare(PHP_VERSION, '5.3.0') < 0) ) {
		echo "This software requires PHP 5.3 or higher\n";
		exit;
	}
	try {	
		// common stuff can go here
		date_default_timezone_set('Pacific/Auckland');
		set_error_handler("exception_error_handler");
		error_reporting(E_ALL | E_STRICT);
	
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
		
		$context=Context::createFromConfigurationFile("website.conf");
		$context->setUser(new UserModel($context));

		// getController will throw an exception if the request path is invalid
		// or the user is not authorised for access		
		$controller=getController($context).'Controller';
		$actor = new $controller($context);
		$actor->process();
		
	} catch (LoginException $ex) {
		echo 'TODO: please login or timeout message<br/>';
		
	} catch (Exception $ex) {
		logException ($ex);
		echo 'Page not found<br/>';
		// It is bad security practice to reveal exceptions to users
		// We shouuld log the exception and give a looser description of
		// the problem to the user.
		// We'll make the output prettier later
		
		
		exit;
	}
		
	function logException ($ex) {
		// do no logging for now, just display
		print "Exception thrown: {$ex->getMessage()}>br/>";
	}
	
	// This is a very simple router
	// We just match the URI to a stub of the controller name
	function getController($context) {
		$uri=$context->getURI();
		$path=$uri->getPart();
		switch ($path) {
			case 'admin':
				return getAdminController($context);
			case '':
				$uri->prependPart('home');
				return 'Static';
			case 'static':
				return 'Static';
			case 'login':
				return 'Login';
			case 'logout':
				return 'Logout';
			case 'register':
				return 'Register';		
			case 'products':
				return 'Products';
			case 'search':
				return 'Search';
			case 'cart':
				return 'Cart';
			case 'checkout':
				return 'Checkout';
				
			default:
				throw new InvalidRequestException ("No such page");
		}
	}

	// This is a very simple admin router
	// We match the next part of the URI to the controller name for the action
	function getAdminController($context) {
/*
		if (!$context->getUser()->isAdmin() ) {
			throw new InvalidRequestException('Administrator access is required for this page');
		}
*/
		$uri=$context->getURI();
		$path=$uri->getPart();
		switch ($path) {
		    case 'categories':
				return 'AdminCategories';
		    case 'category':
				return 'AdminCategory';
		    case 'products':
				return 'AdminProducts';
		    case 'product':
				return 'AdminProduct';
		    case 'customers':
				return 'AdminCustomers';
			case 'customer':
				return 'AdminCustomer';
			default:
				throw new InvalidRequestException ('No such page');
		}
	}
/**
 * Convert errors, notices, warnings etc. into exceptions.
 */
	function exception_error_handler($errno, $errstr, $errfile, $errline ) {
		throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
	}
?>