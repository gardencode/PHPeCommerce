<?php

class CheckoutFinalView extends AbstractView {

    public function prepare() {
        $content = '<p>Thank you for your order.</p>';
        $this->setTemplateField('content',$content);
    }

}