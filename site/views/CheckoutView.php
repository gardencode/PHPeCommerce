<?php

class CheckoutView extends AbstractView {

    public function prepare() {
        //dummy data
        $productName = "Toaster";
        $productPrice = 20.99;

        //todo
        //    if (cart is empty) {
        //        inform user that cart is empty
        //    } else {
        //      foreach item in cart {
        $content = '<table border=1>' .
            '<tr>' .
            '<th>Product</th>' .
            '<th>Price</th>' .
            '</tr>' .
            '<tr>' .
            '<td>' . $productName . '</td>' .
            '<td>' . $productPrice . '</td>' .
            '</tr>' .
            '</table>' .
            '<br>' .
            '<a>Total: ' . $productPrice .
            '<br>';
        //end foreach

        $content .= '<a href="##site##checkout/delivery">Confirm purchase</a>';
        $this->setTemplateField('content',$content);
    }

}