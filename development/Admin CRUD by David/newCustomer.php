<?php
require_once ("MySQLDB.php");

    $host = 'localhost' ;
    $dbUser ='root';
    $dbPass ='';
    $dbName ='Coolsite';

    // create a new database object and connect to server01
    $db = new MySQL($host , $dbUser , $dbPass , $dbName );
  
    // select the database
    $db->selectDatabase();

	// grab the form variables from the global array
	if(isset($_POST['FirstName'])){
		$FirstName = $_POST['FirstName'];
		$LastName = $_POST['LastName'];
		$UserID = $_POST['UserID'];
		$Password = $_POST['Password'];
		$Email = $_POST['Email'];
		$Address = $_POST['Address'];
		$City = $_POST['City'];
		$Phonenumber = $_POST['Phonenumber'];
	}


	$sql = "INSERT INTO Customer Values(null, '$FirstName', '$LastName','$UserID', 
		'$Password', '$Email','$Address', '$City', '$Phonenumber'); ";

	//  execute the sql query
	$result = $db->query($sql);
    

	if($result == True){
	/*	$output = "FirstName = $FirstName</br>";
		$output .= "LastName = $LastName</br>";
		$output .= "UserID = $UserID</br>";
		$output .= "Password = $Password</br>";
		$output .= "Email = $Email</br>";
		$output .= "Address = $Address</br>";
		$output .= "City = $City</br>";
		$output .= "Phonenumber = $Phonenumber</br>";
		print $output;
	*/
		header("location: updateCustomers.php");
	} else {
		print "You did something wrong, you suck!";
	}






?>