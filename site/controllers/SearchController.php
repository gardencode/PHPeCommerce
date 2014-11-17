<?php

class SearchController extends AbstractController {

	public function __construct($context) {
		parent::__construct($context);
	}

	protected function getView($isPostback) {
		
		$uri = $this->getUri();
		$part = $uri->getPart();
		//Part if blank
		if(is_null($part)){
			echo "Please fill in the search";
		}
		elseif ($part>0) {
			$db=$this->getDB();
        	$model = new ProductsModel($db);
			
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

