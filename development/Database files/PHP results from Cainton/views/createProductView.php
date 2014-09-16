<?php
/**
 * Created by PhpStorm.
 * User: Hayden
 * Date: 9/16/14
 * Time: 7:47 PM
 */

$content =
    '<!doctype html><html>'.
    '<body>'.
    '<form action="../models/createProductModel.php" method="POST">'.
    '<label>Category id:</label><br/>'.
    '<input type="text" name="category_id"/><br/>'.
    '<label>Product name:</label><br/>'.
    '<input type="text" name="product_name"/><br/>'.
    '<label>Product description:</label><br/>'.
    '<input type="text" name="product_description"/><br/>'.
    '<label>Product image:</label><br/>'.
    '<input type="text" name="product_image"/><br/>'.
    '<input type="submit" value="Submit"/><br/>'.
    '</form>'.
    '</body>'.
    '</html>';
print $content;

?>

