<?php

class CheckoutController extends AbstractController {
    public function __construct($context) {
        parent::__construct($context);
    }
    protected function getView($isPostback) {
        $context = $this->getContext();
        $uri=$context->getURI();
        $path=$uri->getPart();
        switch ($path) {
            case '':
                $model = new ShoppingCartModel($context);
                $view = new CheckoutView();
                $view->setModel($model);
                $view->setTemplate('html/masterPage.html');
                $view->setTemplateField('pagename','Checkout');
                return $view;
            case 'delivery':
                $view = new CheckoutDeliveryView();
                $view->setTemplate('html/masterPage.html');
                $view->setTemplateField('pagename','Checkout - Delivery');
                return $view;
            case 'final':
                if ($isPostback) {
                    $streetNumber=$this->getInput('street_number');
                    $streetName=$this->getInput('street_name');
                    $city=$this->getInput('city');
                    $postCode=$this->getInput('post_code');
                    $cart = new ShoppingCartModel($context);
                    $totalPrice = $cart->getTotalPrice();
                    $db=$this->getDB();
                    $order = new OrderModel($db);
                    $order->setStreetNumber($streetNumber);
                    $order->setStreetName($streetName);
                    $order->setCity($city);
                    $order->setPostCode($postCode);
                    $order->setTotalPrice($totalPrice);
                    $order->save();
                    //foreach product in cart
                    //do above to create an orderline
                    //todo
                    $cart->delete();
                }
                $view = new CheckoutFinalView();
                $view->setTemplate('html/masterPage.html');
                $view->setTemplateField('pagename','Checkout - Final');
                return $view;
            default:
                throw new InvalidRequestException ('No such page');
        }
    }
}
?>