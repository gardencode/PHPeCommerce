<?php
require_once("scripts/buildMainHtml.php");

//printing html
$html = head();
$html .= nav();
$html .= content();
print $html;


    if(isset($_SESSION['admin'])){
		session_destroy();
    }
    
    // footer
    $end = footer();
    
    print $end;
    
?>
