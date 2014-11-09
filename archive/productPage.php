<?php
include "lib/buildMainHtml.php";
include "lib/getProductInfo.php";

echo head().nav().content();

$prod = new Product($_GET['id']);

echo "<h2>".$prod->name."</h2>";
echo "<h2>".$prod->categoryName."</h2>";
echo "<div class='prodThumb'><img src='images/".$prod->imgPath."'  alt='".$prod->name."'/></div>";
echo "<p>$".number_format($prod->price, 2)."</p>";
echo "<button>Add to Cart</button>";
echo "<p>".$prod->description."</p>";

echo footer();
?>