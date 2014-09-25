<?php

include 'lib/abstractController.php';
include 'models/customers.php';
include 'views/customers.php';

class CustomerController extends AbstractController {

	public function __construct($context) {
		parent::__construct($context);
	}

	protected function getView($isPostback) {
		$db=$this->getDB();
		$model = new CustomerModel($db);
		
		// create output
		$view=new CustomerView();
		$view->setModel($model);
		$view->setTemplate('html/masterPage.html');
		$view->setTemplateField('pagename','People');
		$view->prepare();
		return $view;
	}
}
?>