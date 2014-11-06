<?php

if(@$_GET['add']){

	if(isset($_SESSION['cartArray'])){ } else {
		$_SESSION['cartArray'] = array();
	}
	$cartArray = $_SESSION['cartArray'];
	
	$cart = $_GET['add'];
	array_push($cartArray, $cart);
	
	$_SESSION['cartArray'] = $cartArray;
	
	header("location: cart.php");
}
if(@$_GET['remove']){

	$item = $_GET['remove'];
	deleteItem($item);
	
	header("location: cart.php");
}


//display all the stuff in the cart
function productsDisplay() {
    @session_start();

	//if(isset($_GET['action']) == "add"){
		//$id = $_GET['id'];
	//}

    //easier to deal with as local var
    //$localCart = $_SESSION['cart'];

    //start the table
    print "<table border=\"1\">";
    print "<tr><th>Product Name</th><th>Type</th><th>Price</th><th>Action</th></tr>";

    //for($i = 0; $i < count($localCart); $i++) {

        //getFromDb($localCart[$i],$i);
	getFromDb();

    //}

    //print total & close the table
    print "</table>";
      
    //print $output;
}

function getFromDb(){
require_once ("MySQLDBV2.php");

    $host = 'localhost' ;
    $dbUser ='root';
    $dbPass ='';
    $dbName ='products';

    // create a new database object and connect to server
    $db = new MySQL($host , $dbUser , $dbPass , $dbName );
  
    // select the database
    $db->selectDatabase();

    //construct the SQL statement
    $sql = "select * from products;";
	//"where id_product = '[$input]';";
    // execute the sql
    $result = $db->query($sql);
    

while ($myrow = $result->fetch())
    {
		$id = $myrow['id_products'];
		$description = $myrow['description'];
		$name = $myrow['name'];
		$price = $myrow['price'];

	   $output = "<tr><td>$name</td>";
       $output .= "<td>$description</td>";
	   $output .= "<td>$price</td>";
       $output .= "<td><a href=\"?add=$id\">Add to Cart</a></td>";
       
       print $output;
    }

}

function displayCart($id, $arrayValue){
require_once ("MySQLDBV2.php");

    $host = 'localhost' ;
    $dbUser ='root';
    $dbPass ='';
    $dbName ='products';

    // create a new database object and connect to server
    $db = new MySQL($host , $dbUser , $dbPass , $dbName );
  
    // select the database
    $db->selectDatabase();

    //construct the SQL statement
    $sql = "select * from products where id_products = '$id'";
	$result = $db->query($sql);
    
	while ($myrow = $result->fetch())
    {
		$id = $myrow['id_products'];
		$description = $myrow['description'];
		$name = $myrow['name'];
		$price = $myrow['price'];

		$output = "<tr><td>$name</td>";
		$output .= "<td>$description</td>";
		$output .= "<td>$price</td>";
		$output .= "<td><a href=\"?remove=$arrayValue\">Remove from Cart</a></td>";
		   
	   print $output;
    }
}

function deleteItem($item){
    @session_start();
    
    // setting as local var
    $localCart = $_SESSION['cartArray'];

    // remove from array via key
    unset($localCart[$item]);
    
    // re-index the array
    $localCart = array_values($localCart);

    // set back at session var
    $_SESSION['cartArray'] = $localCart; 
}
?>