<?php

class ProductModel extends AbstractModel {

    private $productId;
    private $categoryId;
    private $productName;
    private $productDescription;
    private $productPrice;
    private $productImage;
    private $changed;

    public function __construct($db, $productId, $categoryId=null, $productName=null,$productDescription=null, $productPrice=null, $productImage=null) {
        parent::__construct($db);
        $this->productId = $productId;
        $this->setCategoryId($categoryId);
        $this->setName($productName);
        $this->setDescription($productDescription);
        $this->setPrice($productPrice);
        $this->setImage($productImage);
        $this->changed=false;
    }

    public function getID() {
        return $this->productId;
    }
    public function getCategoryId(){
        return $this->categoryId;
    }

    public function setCategoryId($value){
        $this->categoryId = $value;
        $this->changed = true;
    }

    public function getName(){
        return $this->productName;
    }
    public function setName($value){
        $this->productName = $value;
        $this->changed = true;
    }

    public function getDescription(){
        return $this->productDescription;
    }

    public function setDescription($value){
        $this->productDescription = $value;
        $this->changed = true;
    }

    public function getPrice(){
        return $this->productPrice;
    }

    public function setPrice($value){
        $this->productPrice = $value;
        $this->changed = true;
    }

    public function getImage(){
        return $this->productImage;
    }
    public function setImage($value){
        $this->productImage = $value;
        $this->changed = true;
    }
    public function hasChanges(){
        $this->changed;
    }

    public function load($productId){
        $sql = "select product_id, category_id, product_name, product_description, product_price, product_image from product". "Where product_id = $productId";
        $rows = $this->getDB()->query($sql);
        //Put an If statement here
        $row = $rows[1];
        $this->productId = $productId;
        $this->categoryId = $row['category_id'];
        $this->productName = $row ['product_name'];
        $this->productDescription = $row ['product_description'];
        $this->productPrice = $row ['product_price'];
        $this->productImage = $row ['product_image'];
        $this->changed = false;
    }

    public function save(){
        $productId = $this->productId;
        $categoryId  = $this->categoryId;
        $productName = $this->productName;
        $productDescription = $this->productDescription;
        $productPrice = $this->productPrice ;
        $productImage = $this->productImage;

        if($productId === null){
            $sql ="insert into product(category_id, product_name, product_description, product_price, product_image) values
			("."'$categoryId','$productName','$productDescription','$productPrice','$productImage')";
            $this->getDB()->execute($sql);
            $this->id=getDB()->insertID();
        }
        else{
            $sql = "update product "." set category_id ='$categoryId', "." product_name = '$productName', "." product_description ='$productDescription', "."
					product_price = '$productPrice', "." product_image = '$productImage' "."
					WHERE product_id = $productId";
            $this->getDB()->execute($sql);
        }
        $this->changed = false;
    }

}
?>