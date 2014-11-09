<?php

	session_start();
	require_once("connect.php");
	if(isset($_GET['page'])) {
	//gets variable from another page
		$pages = array("products","cart");
		if(in_array($_GET['page'],$pages)) {
			$page = $_GET['page'];
		} else {
			$page= "products";
		}
	} else {
		$page = "products";
	}


?>
<html>
	<head>
		<link rel="stylesheet" href="reset.css">
		<link rel="stylesheet" href="style.css">
		<title>Shopping cart</title>
	</head>
	<body>
		<div id="container">
			<div id="main"><?php require($page . ".php"); ?></div>
			<div id="sidebar"><h1>Cart</h1>
<?php
	if(isset($_SESSION['cart'])) {
		$sql = "SELECT * FROM products WHERE id_products IN (";
		foreach($_SESSION['cart'] as $id => $value){
			$sql .= $id . ",";
		}
		$sql = substr($sql,0,-1) . ") ORDER BY id_products ASC";
		$query = mysql_query($sql);
	while($row = mysql_fetch_array($query)){
	
	echo "<p>" + $row['name'] + "</p>"; 
	// echo " x " . $_SESSION['cart'][$row['id_products']]['quantity'];

	//} else {
	//	echo "<p>Your Cart is Empty. <br />Please add some products</p>";
	//}
		//echo "<a href='index.php?page=cart'>Go to Cart</a>";
	}
	}
?>
	</div>
		</div>
	</body>
</html>
