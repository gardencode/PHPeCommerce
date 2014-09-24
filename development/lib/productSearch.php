<?php
include "database.php";

//Returns a list of all categories
function getAllCategories() {
    $db = new Database ("localhost","root","","coolshop");
    return $db->query("SELECT * FROM category");
}

//Returns a list of all products that match the given name and category parameters
function getProducts( $name, $category ) {
    $db = new Database ("localhost","root","","coolshop");
    $allCategories = getAllCategories();
    $catExists = false;
    //Check if the entered category exists
    foreach ($allCategories as $cat) {
        if ($cat['category_name'] == $category) {
            $catExists = true;
        }
    }
    $theQuery = "SELECT * FROM product INNER JOIN category ON product.category_id = category.category_id WHERE product_name LIKE '%".$name."%'";
    if ($catExists) {
        $theQuery = $theQuery." AND category_name = '".$category."'";
    }
    return $db->query($theQuery);
}
?>