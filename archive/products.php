<?php
include "lib/buildMainHtml.php";
include "lib/getProductInfo.php";

echo head().nav().content();

//Set the filter options if none have been submitted
if (!isset($_POST['catFilter'])) {
    $_POST['catFilter'] = "All Categories";
    $_POST['nameFilter'] = "";
}

//Set up the data
$allProducts = getProducts($_POST['nameFilter'], $_POST['catFilter']);
$allCategories = getAllCategories();

echo "<form action='products.php' method='POST'>";
//Create the search box
echo "<label>Search:</label><input type='text' name='nameFilter'/>";
//Create the category filter box
echo "<select name='catFilter'><option>All Categories</option>";
foreach ($allCategories as $category) {
    echo "<option>".$category['category_name']."</option>";
}
echo "</select><input type='submit' value='Search' /></form>";

//Create a heading
echo "<h2>Products ";
if ($_POST['nameFilter'] != "") {
    echo "matching \"".$_POST['nameFilter']."\" ";
}
echo "in ".$_POST['catFilter'].":</h2>";

//Get and display the products on the page
foreach ($allProducts as $product) {
<<<<<<< HEAD
    $prodId = $product['product_id'];
    $prod = new Product($prodId);
    echo "<a href='productPage.php?id=".$prodId."'><div class='listItem'><img src='images/'".$prod->imgPath."'/><p>".$prod->name."</p></div></a>";
=======
    $prod = new Product($product['product_id']);
    echo "<a href='productPage.php?id=".$prod->id."'><div class='listItem'><img src='images/".$prod->imgPath."'/><p>".$prod->name."</p></div></a>";
>>>>>>> Glen
}

echo footer();
?>