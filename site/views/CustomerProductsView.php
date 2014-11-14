<?php
class CustomerProductsView extends AbstractView {

    public function prepare() {
        $products = $this->getModel()->getProducts();
        $content="<table class='table table-hover table-responsive table-bordered'>\n".
            "<tr><th>Product Name</th>
                 <th>Product Description</th>
                 <th>Product Price</th>
                 <th>Product Image</th>
                  <th>Action</th>
            </tr>\n";
        foreach ($products as $product) {
            $name='<tr><td>'.$product->getName(). '</td><td>'.$product->getDescription().'</td><td>'.$product->getPrice().' </td><td>'.
                '<img src=./images/'.$product->getImage().'></td>';
            $action='&nbsp;<button class="btn btn-large btn-info" type="button"><a href="##site##cart/add/' . $product->getID() . '">Add to Cart</a></button>';
            $content.="<tr><td>$name</td><td>$action</td></tr>\n";
        }
        $content.="</table>\n";

        $this->setTemplateField('content',$content);
    }
}
?>