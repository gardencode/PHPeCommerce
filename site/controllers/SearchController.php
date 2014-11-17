<?php

class SearchController extends AbstractController {

	public function __construct($context) {
		parent::__construct($context);
	}

	protected function getView($isPostback) {
		$db=$this->getDB();
        $model = new ProductsModel($db);
		
		$uri = $this->getUri();
		$part = $uri->getPart();
		//Part if blank
		if(is_null($part)){

		}
		elseif ($part>0) {
			# code...
		}
		else{// create output
			
        $view=new CustomerProductsView();
        $view->setModel($model);
        $view->setTemplate('html/masterPage.html');
        $view->setTemplateField('pagename','Products');
	    $view->prepare();
	    return $view;

		}

		
	}
	
}	

