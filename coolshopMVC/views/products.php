<?php
include '../lib/abstractView.php';
class ProductsView extends AbstractView {

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
            //var_dump($person->getCustomerImage());
            $action='&nbsp;<button class="btn btn-large btn-info" type="button"><a href="##site##product/view/'.$product->getID().'">View</a></button>'.
                '&nbsp;<button class="btn btn-large btn-success" type="button"><a href="##site##product/edit/'.$product->getID().'">Edit</a></button>'.
                '&nbsp;<button class="btn btn-large btn-danger" type="button"><a href="##site##product/delete/'.$product->getID().'">Delete</a></button>';
            $content.="<tr><td>$name</td><td>$action</td></tr>\n";
        }
        $content.="</table>\n";

        $this->setTemplateField('content',$content);
    }
}
?>