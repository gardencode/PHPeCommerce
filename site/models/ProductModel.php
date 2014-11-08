<?php

class ProductModel extends AbstractModel {

    private $productId;
    private $categoryId;
    private $name;
    private $description;
    private $price;
    private $image;
    private $changed;

    public function __construct($db, $productId=null, $categoryId=null, $name=null,$description=null, $price=null, $image=null) {
        parent::__construct($db);
        $this->productId = $productId;
        $this->setCategoryId($categoryId);
        $this->setName($name);
        $this->setDescription($description);
        $this->setPrice($price);
        $this->setImage($image);
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
        return $this->name;
    }
    public function setName($value){
        $this->name = $value;
        $this->changed = true;
    }

    public function getDescription(){
        return $this->description;
    }

    public function setDescription($value){
        $this->description = $value;
        $this->changed = true;
    }

    public function getPrice(){
        return $this->price;
    }

    public function setPrice($value){
        $this->price = $value;
        $this->changed = true;
    }

    public function getImage(){
        return $this->image;
    }
    public function setImage($value){
        $this->image = $value;
        $this->changed = true;
    }
    public function hasChanges(){
        return $this->changed;
    }

    public function load($productId){
        $sql = "select id, categoryId, name, description, price, image from product". 
		"Where id = $productId";
        $rows = $this->getDB()->query($sql);
        //Put an If statement here
        $row = $rows[0];
        $this->productId = $productId;
        $this->categoryId = $row['categoryId'];
        $this->name = $row ['name'];
        $this->description = $row ['description'];
        $this->price = $row ['price'];
        $this->image = $row ['image'];
        $this->changed = false;
    }

    public function save(){
        $productId = $this->productId;
        $categoryId  = $this->categoryId;
        $name = $this->name;
        $description = $this->description;
        $price = $this->price ;
        $image = $this->image;

        if($productId === null){
            $sql ="insert into product(categoryId, name, description, price, image) values
			("."'$categoryId','$name','$description','$price','$image')";
		    $this->getDB()->execute($sql);
            $this->id=$this->getDB()->getInsertID();
        }
        else{
            $sql = "update product "." set categoryId ='$categoryId', ".
			        "name = '$name', ".
					"description ='$description', ".
					"price = '$price', ".
					"image = '$image' ".
					"WHERE id = $productId";
            $this->getDB()->execute($sql);
        }
        $this->changed = false;
    }
	
	//
	public function delete () {
		echo "TODO: product model delete function still to be implemented<br/>";
	}
}
?>