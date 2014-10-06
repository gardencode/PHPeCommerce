<?php
include '../lib/abstractModel.php';
include '../models/product.php';

class ProductsModel extends AbstractModel {

    private $products;

    public function __construct($db) {
        parent::__construct($db);
        $this->products = array();
        $this->load();
    }

    private function load() {
        $sql = "select product_id, category_id, product_name, product_description, product_price, product_image from product";
        $rows = $this->getDB()->query($sql);
        foreach ($rows as $row){
            $productId = $row['product_id'];
            $categoryId = $row['category_id'];
            $productName = $row ['product_name'];
            $productDescription = $row ['product_description'];
            $productPrice = $row ['product_price'];
            $productImage = $row ['product_image'];
            $product = new ProductModel($this->getDB(),$productId,$categoryId,$productName,$productDescription,$productPrice,$productImage);
            $this->products[]=$product;

        }
    }

    public function getProducts() {
        return $this->products;
    }
}
?>