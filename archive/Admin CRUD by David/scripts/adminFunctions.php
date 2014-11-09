<?php
function addCustomer(){
    session_start();
    
    
$output = "<form action=\"newCategory.php\" method=\"post\" >" . "<br />";
$output .= "New Category Name: <input type=\"text\" name=\"CategoryName\" />" . "<br />";
$output .= "<input type=\"submit\" name=\"submit\" value=\"Submit\" />"; 

    if(isset($_SESSION['lastAdded'])){
        $output .= $_SESSION['lastAdded'];
    }
    
$output .= "</form>";

print $output;
}

function upload() {

    // the upload form
    $upload = "<form action=\"file_upload.php\" method=\"post\" enctype=\"multipart/form-data\">";
	$upload .= "Upload Photo: <input type=\"file\" name=\"photo\" size=\"25\" />";
	$upload .= "<input type=\"submit\" name=\"submit\" value=\"Submit\" />";
    $upload .= "</form>";

    print $upload;

}

function newCustomer(){
	//form
    $output = "<form action=\"newCustomer.php\" method=\"post\" >" . "<br />";
    $output .= "CustomerName: <input type=\"text\" name=\"CustomerName\" />" . "<br />";
	$output .= "FirstName: <input type=\"text\" name=\"FirstName\" />" . "<br />";
	$output .= "LastName: <input type=\"text\" name=\"LastName\" />" . "<br />";
	$output .= "UserID: <input type=\"text\" name=\"UserID\" />" . "<br />";
	$output .= "Password: <input type=\"text\" name=\"Password\" />" . "<br />";
	$output .= "Email: <input type=\"text\" name=\"Email\" />" . "<br />";
	$output .= "Address: <input type=\"text\" name=\"Address\" />" . "<br />";
	$output .= "City: <input type=\"text\" name=\"City\" />" . "<br />";
	$output .= "Phonenumber: <input type=\"text\" name=\"Phonenumber\" />" . "<br />";
	$output .= "<input type=\"submit\" name=\"submit\" value=\"Submit\" />";
    $output .= "</form>";

    print $output;
        
}

function productTypesCount(){

    require_once ("MySQLDB.php");

    $host = 'localhost' ;
    $dbUser ='root';
    $dbPass ='';
    $dbName ='LemonPc';
	// create a new database object and connect to server
    $db = new MySQL($host , $dbUser , $dbPass , $dbName );

    // select the database
    $db->selectDatabase();

    //construct the SQL statement
    $sql = "select distinct ProductType from Products;";
	
    // execute the sql
    $result = $db->query($sql);
    
    // fetch the results and put them into an array
    while ($myrow = $result->fetch())
    {
        $types[] = $myrow['ProductType'];
    }
    
    // return array
    return $types;
    
}

function newCategoryName($CategoryName) {
    
    // checks if the input is null & displays what was last added.
    if($CategoryName == 'null') {
        $_SESSION['lastAdded'] = " Please type something";
    } else {
        $_SESSION['lastAdded'] = " Category: '" . $CategoryName . "' recently added." . "<br />";
    }
}

function newCustomerError($input) {
session_start();
    // error handling
    if($input == 'FirstName'){
        $_SESSION['productError'] = "Please enter a new name";
    }
    
    if($input == 'LatName'){
        $_SESSION['productError'] = "Please enter a last name";
    }
    
    if($input == 'UserId'){
        $_SESSION['productError'] = "please write a new ID";
    }
    
    if($input == 'Password'){
        $_SESSION['productError'] = "please enter a new password";
    } else {
        unset($_SESSION['productError']);
    }
	 if($input == 'Email'){
        $_SESSION['productError'] = "please enter an email address";
    } else {
        unset($_SESSION['productError']);
    }
	 if($input == 'Address'){
        $_SESSION['productError'] = "please enter an address";
    } else {
        unset($_SESSION['productError']);
    }
	 if($input == 'City'){
        $_SESSION['productError'] = "please selecta city";
    } else {
        unset($_SESSION['productError']);
    }
	 if($input == 'PhoneNumber'){
        $_SESSION['productError'] = "please enter a contact number";
    } else {
        unset($_SESSION['productError']);
    }

}
?>