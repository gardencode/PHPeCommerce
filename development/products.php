<?php
include "lib/buildMainHtml.php";
include "lib/getProductInfo.php";

echo head().nav().content();

//Set up the data
$db = new Database ("localhost","root","","coolshop");
$allProducts = $db->query("SELECT * FROM product");

//Get and display all products on the page
foreach ($allProducts as $product) {
    $prodId = $product['product_id'];
    $prod = new Product($prodId);
    echo "<a href='productPage.php?id=".$prodId."'><div class='listItem'><img src='images/".$prod->imgPath."'/><p>".$prod->name."</p></div></a>";
}

echo footer();
?>