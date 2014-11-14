<?php

class CheckoutDeliveryView extends AbstractView {

    public function prepare() {
        $content = '<p>Please enter your delivery address information.</p>' .
                    '<form action="##site##checkout/final" method="POST">' .
                    '<a>Street number</a>' .
                    '<br>' .
                    '<input type="text" name="street_number" />' .
                    '<br>' .
                    '<a>Street name</a>' .
                    '<br>' .
                    '<input type="text" name="street_name" />' .
                    '<br>' .
                    '<a>City</a>' .
                    '<br>' .
                    '<input type="text" name="city" />' .
                    '<br>' .
                    '<a>Post code</a>' .
                    '<br>' .
                    '<input type="text" name="post_code" />' .
                    '<br>' .
                    '<input type="submit" value="Submit" />' .
                    '</form>';
        $this->setTemplateField('content',$content);
    }

}