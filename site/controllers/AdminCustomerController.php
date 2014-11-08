<?php

class AdminCustomerController extends AbstractController {

	public function __construct($context) {
		parent::__construct($context);
	}

	protected function getView($isPostback) {
		$uri=$this->getURI();
		$action=$uri->getPart();
		switch ($action) {
			case 'new':
				return $this->handleEdit($isPostback,null);
			case 'edit':
				return $this->handleEdit($isPostback,$uri->getID());	
			case 'view':
				return $this->handleView($isPostback,$uri->getID());	
			case 'delete':
				return $this->handleDelete($isPostback,$uri->getID());	
			default:
				throw new InvalidRequestException ("Invalid action in URI");
		}
	
/*
		$model = new PeopleModel($db);
		$view=new PeopleView();
		$view->setModel($model);
		$view->setTemplate('html/masterPage.html');
		return $view;
*/	
	}
	
	private function handleEdit($postback, $id=null) {
		throw new Exception ("Edit/New not yet implemented");
	}	
	private function handleView($postback, $id) {
		throw new Exception ("View not yet implemented");
	}
	private function handleDelete($postback, $id) {
		throw new Exception ("Delete not yet implemented");
	}

}
?>