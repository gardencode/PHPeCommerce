<?php
require_once("scripts/buildMainHtml.php");

//print the index.php main html
	$html = head();
	$html .= nav();
	$html .= content();
	//main content on html page prints
	$html .= "<h2> Random part of the website</h>";
	//$end = randomProduct();
	print $html;
	
	//footer
	//end .= footer();
	//print $end;

?>