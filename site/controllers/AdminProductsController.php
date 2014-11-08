<?php
class AdminProductsController extends AbstractController {

    public function __construct($context) {
        parent::__construct($context);
    }

    protected function getView($isPostback) {
        $db=$this->getDB();
        $model = new ProductsModel($db);
		
        // create output
        $view=new ProductsView();
        $view->setModel($model);
        $view->setTemplate('html/masterPage.html');
        $view->setTemplateField('pagename','Products');
	    $view->prepare();
	    return $view;
    }
}
?>