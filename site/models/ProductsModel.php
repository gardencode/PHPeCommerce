<?php
class ProductsModel extends AbstractModel {

    private $products;

    public function __construct($db) {
        parent::__construct($db);
        $this->products = array();
        $this->load();
    }

    private function load() {
        $sql = "select id, categoryId, name, description, price, image from product;";
        $rows = $this->getDB()->query($sql);
        foreach ($rows as $row){
            $productId = $row['id'];
            $categoryId = $row['categoryId'];
            $productName = $row ['name'];
            $productDescription = $row ['description'];
            $productPrice = $row ['price'];
            $productImage = $row ['image'];
            $product = ProductModel::createFromFields($this->getDB(),$productId,$categoryId,$productName,$productDescription,$productPrice,$productImage);
            $this->products[]=$product;
        }
    }

    public function getProducts() {
        return $this->products;
    }
}
?>