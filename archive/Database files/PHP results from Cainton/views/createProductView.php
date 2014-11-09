<?php

$content =
    '<!doctype html><html>'.
    '<body>'.
    '<p>Enter a new product into the database.</p>' .
    '<form action="../controllers/createProductController.php" method="POST">'.
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

