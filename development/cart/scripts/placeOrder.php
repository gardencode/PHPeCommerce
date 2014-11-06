<?php
session_start();
require_once ("MySQLDB.php");

// check if anything is in the cart
if(empty($_SESSION['cart'])){
    header("location: ..\cart.php");
}

    //easier to deal with as local var
    $localCart = $_SESSION['cart'];
    
    
    for($i = 0; $i < count($localCart); $i++) {

        order($localCart[$i]);

    }
    
function order($input){
    $host = 'localhost' ;
    $dbUser ='root';
    $dbPass ='';
    $dbName ='LemonPc';

    // create a new database object and connect to server
    $db = new MySQL($host , $dbUser , $dbPass , $dbName );
  
    // select the database
    $db->selectDatabase();

    // finding the items in the db
    $sql = "select * from Products where ProductNum = '$input';";
    
    // execute the sql
    $result = $db->query($sql);

    while ($myrow = $result->fetch())
    {
       $ProductNum = $myrow['ProductNum'];
       $ProductType = $myrow['ProductType'];
       $ProductName = $myrow['ProductName'];
       $ProductPrice = $myrow['ProductPrice'];
       $ProductImage = $myrow['ProductImage'];
       $ProductExtraInfo = $myrow['ProductExtraInfo'];
    }
    
    // findout who is ordering
    $userId = $_SESSION['UserID'];
    $totalPrice = $ProductPrice;
    $quantity = 1;
    
    //construct the SQL statement
    $sql = "insert into Orders values(null, $userId, $totalPrice, $ProductNum, '$ProductType', '$ProductExtraInfo', NOW(), $quantity);";

    //  execute the sql query
    $result = $db->query($sql) ;
    if ( $result == true )
    {
        print "Your order has been placed" . "<br />";
        print "<a href=\"../account.php\">Go Back</a>";
        
        $_SESSION['cart'] = array();

    } else {
        print "Error";
    }
}
















?>