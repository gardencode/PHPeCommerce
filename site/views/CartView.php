<?php
class CartView extends AbstractView {

    public function prepare() {
        $quantity = $this->getModel()->getCount();
        $items = array();
        for ($i = 0; $i < $quantity; $i++) {
            array_push($items, $this->getModel()->getItemAt($i));
        }
        if (count($items) == 0) {
            $content = "<p>Your shopping cart is empty</p>";
        } else {
            $content="<table class='table table-hover table-responsive table-bordered'>\n".
                "<tr><th>Product ID</th>
                    <th>Product Price</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th>Action</th>
                </tr>\n";
            foreach ($items as $item) {
                $name='<tr><td>'.$item->getItemCode(). '</td><td>'.$item->getPrice().' </td><td>'.$item->getQuantity().'</td><td>'.$item->getTotal().'</td>';
                $action='&nbsp;<button class="btn btn-large btn-info" type="button"><a href="##site##cart/remove/'.array_search($item, $items).'">Remove this item</a></button>';
                $content.="<tr><td>$name</td><td>$action</td></tr>\n";
            }
            $content.='</table> &nbsp;<button class="btn btn-large btn-info" type="button"><a href="##site##checkout">Go to checkout</a></button>';
        }
        
        $this->setTemplateField('content',$content);
    }
}
?>