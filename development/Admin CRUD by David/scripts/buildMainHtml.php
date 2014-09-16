<?php
    session_start();
    
function head(){
    $head = "<!DOCTYPE HTML >";
    $head .= "<html>";
    $head .= "<head>";
    $head .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"Css\styleSheet.css\" />";
    $head .= "<title>Cool Site</title>";
    $head .= "</head>";
    
    if(isset($_SESSION['FirstName'])) {
        $head .= "<body bgcolor='$colour'>";
    } else {
        $head .= "<body>";
    }
    
    return $head;
}

function nav(){
    $nav = "</div>";
    $nav .= "<h1>Cool Site</h1>";

    $nav .= "<ul class=\"nav\">";
    $nav .= "<li><a href=\"index.php\">Home</a></li>";
    $nav .= "<li><a href=\"login.php\">Login</a></li>";
    $nav .= "<li><a href=\"products.php\">Products</a></li>";

    if(isset($_SESSION['FirstName'])) {
        $nav .= "<li><a href=\"cart.php\">Cart</a></li>";
    }

    $nav .= "<li><a href=\"account.php\">Account</a></li>";
    
    if(isset($_SESSION['FirstName'])) {
    // do nothing
    } else {
    $nav .= "<li><a href=\"register.php\">Register</a></li>";
    } 
    
    $nav .= "<li><a href=\"help.php\">Help</a></li>";
    $nav .= "</ul>";

    $nav .= "<br />";

    $nav .= "<ul class=\"nav\">";
    $nav .= "<li><a href=\"importFile.php\">Build/Load DB</a></li>";
    $nav .= "<li><a href=\"load.php\">View Tables</a></li>";
    $nav .= "<a href=\"adminLogin.php\">Admin</a>";
    $nav .= "</ul>";
    
    return $nav;
}

function content(){
    $content = "<div class=\"Content\">";
    
    return $content;
}

function footer(){
    $footer = "</div>";
    $footer .= "</body>";
    $footer .= "</html>";
    
    return $footer;
}
?>