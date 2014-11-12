<?php
class SearchView extends AbstractView {

    public function prepare() {
        $products = $this->getModel()->getProducts();
        $content="<table class='table table-hover table-responsive table-bordered'>\n".
            "<tr><th>Category Id</th>
                 <th>Product Name</th>
                 <th>Product Description</th>
                 <th>Product Price</th>
                 <th>Product Image</th>
                  <th>Action</th>
            </tr>\n";
        foreach ($products as $product) {
            $name='<tr><td>'. $product->getCategoryId(). '</td><td>'.$product->getName(). '</td><td>'.$product->getDescription().'</td><td>'.$product->getPrice().' </td><td>'.
                '<img src=../images/'.$product->getImage().'></td>';
        }
        $content.="</table>\n";

        $this->setTemplateField('content',$content);
    }
}
?>
