<?php

class SearchController extends AbstractController {

	public function __construct($context) {
		parent::__construct($context);
	}

	protected function getView($isPostback) {
		$db=$this->getDB();
		$model = new CustomersModel($db);
		
		
		$view=new CustomersView();
		$view->setModel($model);
		$view->setTemplate('html/masterPage.html');
		$view->setTemplateField('pagename','People');
		$view->prepare();
		return $view;
	}
}	
?>
