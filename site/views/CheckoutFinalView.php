<?php
class CheckoutFinalView extends AbstractView {
    public function prepare() {
        $content = '<p>Thank you for your order.</p>';
        $content .= '<a href="##site##">Return</a>';
        $this->setTemplateField('content',$content);
    }
}