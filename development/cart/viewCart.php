<?php
@session_start();
require_once("scripts/cartLoad.php");
require_once("connect.php");



$localCart = $_SESSION['cartArray'];
print "<p></p><h3>Cart</h3>";
print "<table border=\"1\">";
print "<tr><th>Product Name</th><th>Type</th><th>Price</th><th>Action</th></tr>";
for($i = 0; $i < count($localCart); $i++){

	displayCart($localCart[$i]);
	
}
	print "</table>";
?>