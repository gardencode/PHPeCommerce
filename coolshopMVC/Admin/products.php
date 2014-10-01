<?php
include '../lib/context.php';
include '../controllers/productsController.php';

$context=Context::createFromConfigurationFile("website.conf");
$products = new ProductsController($context);
$products->process();

?>
	