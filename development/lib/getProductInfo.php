<?php
include "lib/database.php";

//Class for product info (A product ID should be entered when created)
class Product {
    public $id;
    public $name;
    public $price;
    public $categoryId;
    public $categoryName;
    public $description;
    public $imgPath;
    
    public function __construct( $id ) {
        $db = new Database ("localhost","root","","coolshop");
        //Get the Product and Category info based on the given product ID
        $myQuery = $db->query("SELECT * FROM product INNER JOIN category ON product.category_id = category.category_id WHERE product_id = ".$id)[0];
        //Set the product's attributes
        $this->id = $myQuery["product_id"];
        $this->name = $myQuery["product_name"];
        $this->price = 0;
        $this->categoryId = $myQuery["category_id"];
        $this->categoryName = $myQuery["category_name"];
        $this->description = $myQuery["product_description"];
        $this->imgPath = $myQuery["product_image"];
    }
}
?>