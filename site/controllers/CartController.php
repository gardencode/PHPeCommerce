<?php

class CartController extends AbstractController {
    private $myContext;

	public function __construct($context) {
		parent::__construct($context);
        $this->myContext = $context;
	}

	protected function getView($isPostback) {
        $model = new ShoppingCartModel($this->myContext);
		$uri = $this->myContext->getURI();
		$path = $uri->getPart();
        $id = $uri->getRemainingParts();
		switch ($path) {
			case 'add':
                $price = 10.00; //Not sure how to get this without talking to the database, should it be passed from the product page with POST?
                $quantity = 1; //Similar problem to price, shouldn't this be passed from the product page?
				$newItem = new ShoppingCartItem($id, $quantity, $price);
                $model->addItem($newItem);
                header('Location: '.$uri->getSite().'cart');
                break;
			case 'remove':
				$model->removeItemAt($id);
                header('Location: '.$uri->getSite().'cart');
                break;
            case '':
                break;
			default:
				throw new InvalidRequestException ("No such page");
		}
        
        // create output
        $view=new CartView();
        $view->setModel($model);
        $view->setTemplate('html/masterPage.html');
        $view->setTemplateField('pagename','Cart');
	    $view->prepare();
	    return $view;
	}
}	
?>
