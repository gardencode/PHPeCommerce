<?php
	include 'lib/context.php';
	include 'controllers/customerController.php';
	
	$context= Context::createFromConfigurationFile("website.conf");
	$people = new CustomerController($context);
	$people = getController($context->getURI());
	//var_dump($people);
	$people->process();
	
?>
	