<?php
require_once("Scripts/buildMainHtml.php");
require_once("Scripts/adminFunctions.php");

// checks if user is an admin, if not redirect them out
if(@$_SESSION['admin'] != 'True'){
    header("location: adminLogin.php"); Exit;
}

    // print the html
    $html = head();

    $html .= "<ul class=\"nav\">";
    $html .= "<li><a href=\"?updateCustomers\">Update Customers</a></li>";
	$html .= "<li><a href=\"?deleteCustomers\">Delete Customers</a></li>";
	$html .= "<li><a href=\"?newCustomers\">New Customers</a></li>";
    $html .= "<li><a href=\"?upload\">Upload Images</a></li>";
    
    $html .= "</ul>";
    $html .= "<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />";
    
    $html .= content();
    print $html; 

    if(isset($_GET['load'])){
        $output = "First Name: " . $_SESSION['FirstName'] . "<br />";
        $output .= "Last Name: " .$_SESSION["LastName"] . "<br />";
        $output .= "Email: " . $_SESSION["email"] . "<br />";   
        print $output;
    }
    
    if(isset($_GET['updateCustomers'])){
        updateCustomers();
    }
    
    if(isset($_GET['upload'])){
        upload();
    }
    
    if(isset($_GET['deleteCustomers'])){
        deleteCustomers();
    }
	
	if(isset($_GET['newCustomers'])){
        newCustomer();
    }
    
    // footer
    $end = footer();
    
    print $end;   
?>