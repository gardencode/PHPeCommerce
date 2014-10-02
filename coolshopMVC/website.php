<?php
	include 'lib/interfaces.php';
	include 'lib/context.php';	
	include 'models/user.php';	
	try {
		$context=Context::createFromConfigurationFile("website.conf");
		
		$controller=getController($context->getURI());
		
		$controllerPath='controllers/'.strtolower($controller).'Controller.php';
		$controllerClass=$controller.'Controller';
		if (isset($controllerPath)) {
			require $controllerPath;
		}
		
		$actor = new $controllerClass($context);
		$actor->process();
	} catch (Exception $ex) {
		logException ($ex);
		echo 'Page not found<br/>';
		
		exit;
	}
	

	function getController($uri) {
		$path=$uri->getPart();
		switch ($path) {
			case "admin":
				return getAdminController($uri);
			default:
				throw new InvalidRequestException ("No such page");
		}		
	}
	function getAdminController($uri) {

	// check here if admin
		$path=$uri->getPart();
		switch ($path) {
			case "customer":
				return "Customer";
			case "customers":
				return "Customers";
				
			default:
				throw new InvalidRequestException ("No such page");
		}
	}
	
	function logException ($ex) {
		print 'Well that was a bit awkward: '.$ex->getMessage().'<br/>';
		
	}
?>
