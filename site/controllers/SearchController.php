<?php

class SearchController extends AbstractController {

	public function __construct($context) {
		parent::__construct($context);
	}

	protected function getView($isPostback) {
		
		if($isPostback){

			return createProductsView();

		} else{

			return createSearchFormView();
		}

		}

		private function createSearchFormView(){

			// return a view that displays a form that will
			// 1) post back to this controller (##site##/search)
			// 2) have an input field named "term"
			// 3) have a dropdown list for categories with a name of "category",
		}	

		}

		private function createProductsView(){
			$db = $this->getDB();
			$model = new ProductsModel($db);


			$item = $this->getInput('term');
			if($term!==null){
				$model->setNameOrDescription($term);
			}

			$category = $this->getInput('category');
			if($category!==null && $category>0){
				$model->setCategoryFilter($category);
			}

			$view = new CustomerProductsView();
			$view->setModel($model);
			$view->setTemplate('html/masterPage.html');
			$view->setTemplateField('pagename','Products');
			$view->prepare();
			return $view;

		}

		
	}
	
}	

