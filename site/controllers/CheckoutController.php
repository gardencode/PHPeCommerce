<?php

class CheckoutController extends AbstractController {
    public function __construct($context) {
        parent::__construct($context);
    }
    protected function getView($isPostback) {
        $context = $this->getContext();
        $uri=$context->getURI();
        $path=$uri->getPart();
        $model = new ShoppingCartModel($context);
        switch ($path) {
            case '':
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
                    $db=$this->getDB();
                    $order = new OrderModel($db);
                    $order->setStreetNumber($streetNumber);
                    $order->setStreetName($streetName);
                    $order->setCity($city);
                    $order->setPostCode($postCode);
                    $order->save();

                    $quantity = $model->getCount();
                    $items = array();
                    for ($i = 0; $i < $quantity; $i++) {
                        array_push($items, $model->getItemAt($i));
                    }
                    foreach ($items as $item) {
                        $orderline = new OrderLineModel($db);
                        $orderline->setOrderId($order->getID());
                        $orderline->setProductId($item->getItemCode());
                        $orderline->setQuantity($item->getQuantity());
                        $orderline->save();
                    }

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