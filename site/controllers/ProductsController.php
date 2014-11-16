<?php
class ProductsController extends AbstractController {
    public function __construct($context) {
        parent::__construct($context);
    }
    protected function getView($isPostback) {
        $db=$this->getDB();
        $model = new ProductsModel($db);
        // set Filters here
        $text = "select id, categoryId, name, description, price, image from product";

        $searchTerm = $model->setDescriptionMatch($text);
        $searchTerm->getproducts();

        // create output
        $view=new CustomerProductsView();
        $view->setModel($model);
        $view->setTemplate('html/masterPage.html');
        $view->setTemplateField('pagename','Products');
        $view->prepare();
        return $view;
    }
}
?>