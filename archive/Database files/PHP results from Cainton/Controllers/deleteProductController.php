<?php

include '../models/productModel.php';

if(isset($_POST['delete_row'])) {
    $id = $_POST['id_to_be_deleted'];
    Product::deleteProduct($id);
    header("Location: ..");
}

if(isset($_POST['redirect'])) {
    header("Location: ..");
}

?>