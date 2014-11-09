<?php

include '../models/productModel.php';

if(isset($_POST['edit_row'])) {
    $id = $_POST['id_to_be_edited'];
    $categoryId = Product::getCategoryId($id);
    $name = Product::getName($id);
    $description = Product::getDescription($id);
    $image = Product::getImage($id);
}

$content =
    '<!doctype html><html>'.
    '<body>'.
    '<p>Edit an existing product in the database.</p>' .
    '<form action="../controllers/editProductController.php" method="POST">'.
    '<label>Product id:</label><br/>'.
    '<input type="text" name="product_id" value="' . $id . '" readonly/><br/>'.
    '<label>Category id:</label><br/>'.
    '<input type="text" name="category_id" value="' . $categoryId . '"/><br/>'.
    '<label>Product name:</label><br/>'.
    '<input type="text" name="product_name" value="' . $name . '"/><br/>'.
    '<label>Product description:</label><br/>'.
    '<input type="text" name="product_description" value="' . $description . '"/><br/>'.
    '<label>Product image:</label><br/>'.
    '<input type="text" name="product_image" value="' . $image . '"/><br/>'.
    '<input type="submit" value="Submit"/><br/>'.
    '</form>'.
    '</body>'.
    '</html>';
print $content;

?>