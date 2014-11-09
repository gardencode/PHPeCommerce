<?php
require_once("scripts/buildMainHtml.php");

//printing html
$html = head();
$html .= nav();
$html .= content();
print $html;

  $output = "<form action=\"adminPost.php\" method=\"get\">";
	$output .= "<h3>Admin Login</h3> <br />";
	$output .= "Username: <input type=\"text\" id=\"newUserName\" name=\"UserID\" /> <br />";
	$output .= "Password: <input type=\"password\" id=\"newPassWord\" name=\"Password\" /> <br />";
	$output .= "<input type=\"submit\" id=\"submit\" value=\"Submit\" /> <br />";

    if(isset($_SESSION['admin'])){
        print "~~~~~~~<a href='adminLogOut.php'>(Admin logout)</a>" . "<br />" . "<br />";
        print "~~~~~~~<a href='adminControl.php'>Admin Control Panel</a>";
    } else {
        // the form to login
        print $output;
    } 
    
    // footer
    $end = footer();
    
    print $end;
    
?>
