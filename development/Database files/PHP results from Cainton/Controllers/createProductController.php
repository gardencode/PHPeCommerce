<?php

include '../models/productModel.php';

$categoryId = $_POST['category_id'];
$name = $_POST['product_name'];
$description = $_POST['product_description'];
$image = $_POST['product_image'];

$product = new Product($categoryId, $name, $description, $image);
$product->save($product);
header("Location: ..")


?>