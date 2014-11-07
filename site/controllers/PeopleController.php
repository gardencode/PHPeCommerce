<?php
/*
   A PHP framework for web sites by Mike Lopez
   
   Sample CRUD controller for a list of people
   ===========================================
   
*/

class PeopleController extends AbstractController {

	public function __construct($context) {
		parent::__construct($context);
	}

	protected function getView($isPostback) {
		$db=$this->getDB();
		$model = new PeopleModel($db);
		
		// create output
		$view=new PeopleView($this->getContext());
		$view->setModel($model);
		$view->setTemplate('html/masterPage.html');
		$view->setTemplateField('pagename','People');
		return $view;
	}
}
?>