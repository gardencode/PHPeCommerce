<?php
	include 'lib/context.php';	
	try {
	
	
		$context=Context::createFromConfigurationFile("website.conf");
		
		$controller=getController($context->getURI());
		
		$controllerPath='controllers/'.strtolower($controller).'Controller.php';
		$controllerClass=$controller.'Controller';
		if (isset($controllerPath)) {
			require $controllerPath;
		}
	} catch (Exception $ex) {
		logException ($ex);
		echo 'Page not found<br/>';
		
		exit;
	}
	
	try {
	
		$actor = new $controllerClass($context);
		$actor->process();
	} catch (Exception $ex) {
		logException ($ex);
		
		echo $ex.getMessage().'<br/>';
		
	}
	
	function logException ($ex) {

	}
	

	function getController($uri) {
		$path=$uri->getPart();
		switch ($path) {
			case "customer":
				return "customer";
			default:
				throw new InvalidRequestException ("No such page");
		}
		return "Customers";
	}
?>
