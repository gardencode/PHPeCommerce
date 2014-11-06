<?php
@session_start();
require_once("connect.php");

		if(isset($_GET['action']) && $_GET['action'] == "add"){
		$id = intval($_GET['id']);
		if (isset($_SESSION['cart'][$id])){
			$_SESSION['cart'][$id]['quantity']++;
		} else {
		$sql2 = "SELECT * FROM products WHERE id_products=[$id]";
		$query2 = mysql_query($sql2);
		
		if(mysql_num_rows($query2) != 0){
			$row2 = mysql_fetch_array($query2);
			$_SESSION['cart'][$row2['id_products']] = array("quantity" => 1, "price" => $row2['price']);
			
		} else {
			$message = "This product id is invalid";
		}
	}
}

?>
<h2 class="message"><?php if(isset($message)){echo $message;} ?></h2>

<h1>Product page</h1>
<table>
	<tr>
		<th>name</th>
		<th>Description</th>
		<th>Price</th>
		<th>Action</th>
	</tr>
	<?php
		$sql = "SELECT * FROM products ORDER BY name ASC";
		$query = mysql_query($sql) or die(mysql_error());
		
		while($row= mysql_fetch_assoc($query)) {
		?>
		<tr>
			<td><?php echo $row ['name']; ?></td>
			<td><?php echo $row ['description']; ?></td>
			<td><?php echo "$" . $row ['price']; ?></td>
			<td><a href="index.php?page=products&action=add&id=<?php echo $row['id_products']; ?>">Add to Cart</a></td>
		</tr>
	<?php
		}
	?>
	</table>