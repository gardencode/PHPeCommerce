<?php

include '../models/productModel.php';

$id = $_POST['product_id'];
$categoryId = $_POST['category_id'];
$name = $_POST['product_name'];
$description = $_POST['product_description'];
$image = $_POST['product_image'];

Product::setCategoryId($id, $categoryId);
Product::setName($id, $name);
Product::setDescription($id, $description);
Product::setImage($id, $image);

header("Location: ..")


?>