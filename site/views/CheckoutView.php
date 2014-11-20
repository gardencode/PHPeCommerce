<?php
class CheckoutView extends AbstractView {

    public function prepare() {

        $quantity = $this->getModel()->getCount();
        $items = array();
        for ($i = 0; $i < $quantity; $i++) {
            array_push($items, $this->getModel()->getItemAt($i));
        }
        if (count($items) == 0) {
            $content = "<p>No items to check out.</p>";
        } else {
            $content= '<table border=1>' .
                '<tr>' .
                '<th>Item Code</th>' .
                '<th>Quantity</th>' .
                '<th>Price</th>' .
                '<th>Total</th>' .
                '</tr>';
            foreach ($items as $item) {
                $content .= '<tr><td>'. $item->getItemCode() . '</td><td>'.$item->getQuantity().' </td><td>$'.$item->getPrice().' </td><td>$'.$item->getTotal().' </td></tr>';
            }
            $content .= '</table>';
            $content .= '<p>Total price: $' . $this->getModel()->getTotalPrice() . '</p>';
            $content .= '<a href="##site##checkout/delivery">Confirm purchase</a>';
        }
        $this->setTemplateField('content',$content);
    }
}