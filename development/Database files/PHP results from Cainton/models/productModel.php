<?php

$host="localhost";
$username="root";
$password="";
$db_name="coolshop";
$tbl_name="product";

$link = mysqli_connect($host, $username, $password, $db_name)or die("cannot connect");

class Product {

    public function __construct($categoryId, $name, $description, $image) {
        $this->categoryId = $categoryId;
        $this->name = $name;
        $this->description = $description;
        $this->image = $image;
    }

    public function save($product) {
        global $link;
        mysqli_query($link, "INSERT INTO product (category_id, product_name, product_description, product_image) VALUES ('$product->categoryId', '$product->name', '$product->description', '$product->image')");
    }

    public static function setCategoryId($id, $value) {
        $error = Product::errorInCategoryId($value);
        if ($error !== null) {
            throw new Exception($error);
        }
        global $link;
        mysqli_query($link, "update product set category_id = '$value' where product_id = '$id'");
    }

    public static function setName($id, $value) {
        $error = Product::errorInName($value);
        if ($error !== null) {
            throw new Exception($error);
        }
        global $link;
        mysqli_query($link, "update product set product_name = '$value' where product_id = '$id'");
    }

    public static function setDescription($id, $value) {
        $error = Product::errorInDescription($value);
        if ($error !== null) {
            throw new Exception($error);
        }
        global $link;
        mysqli_query($link, "update product set product_description = '$value' where product_id = '$id'");
    }

    public static function setImage($id, $value) {
        global $link;
        mysqli_query($link, "update product set product_image = '$value' where product_id = '$id'");
    }

    public static function getCategoryId($id) {
        global $link;
        $sql = mysqli_query($link, "select category_id from product where product_id = '$id'");
        $result = mysqli_fetch_row($sql);
        return $result[0];
    }

    public static function getName($id) {
        global $link;
        $sql = mysqli_query($link, "select product_name from product where product_id = '$id'");
        $result = mysqli_fetch_row($sql);
        return $result[0];
    }

    public static function getDescription($id) {
        global $link;
        $sql = mysqli_query($link, "select product_description from product where product_id = '$id'");
        $result = mysqli_fetch_row($sql);
        return $result[0];
    }

    public static function getImage($id) {
        global $link;
        $sql = mysqli_query($link, "select product_image from product where product_id = '$id'");
        $result = mysqli_fetch_row($sql);
        return $result[0];
    }

    public static function deleteProduct($id) {
        global $link;
        mysqli_query($link, "DELETE FROM product WHERE product_id = $id");
    }

    public static function errorInCategoryId($value) {
        if ($value > 6) {
            return "Please enter a valid category id.";
        }
        return null;
    }

    public static function errorInName($value) {
        if (strlen($value) > 50) {
            return "Product names must be 50 characters or less.";
        }
        return null;
    }

    public static function errorInDescription($value) {
        if (strlen($value) > 100) {
            return "Product descriptions must be 100 characters or less.";
        }
        return null;
    }

}

?>