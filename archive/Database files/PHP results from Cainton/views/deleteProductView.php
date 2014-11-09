<?php

include '../models/productModel.php';

if(isset($_POST['delete_row'])) {
    $id = $_POST['id_to_be_deleted'];
    $name = Product::getName($id);
}

$content =
    '<!doctype html><html>'.
    '<body>'.
    'Are you sure you want to delete ' . $name . '?' .
    '<form action="../controllers/deleteProductController.php" method="POST">'.
    '<input type="hidden" name="id_to_be_deleted" value="' . $id . '" />' .
    '<input type="submit" name="delete_row" value="Yes"/>' .
    '<input type="submit" name="redirect" value="No"/>' .
    '</form>'.
    '</body>'.
    '</html>';
print $content;

?>



