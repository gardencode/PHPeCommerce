<?php
	include 'lib/interfaces.php';
	include 'lib/uri.php';
	
	$uri=URI::createFromRequest();
	
	echo '<br/>Site is '.$uri->getSite();
	echo '<br/>Full uri is '.$uri->getRawUri();	
	echo '<br/>Pealing off URI parts ...';
	
	do {
		$part=$uri->getPart();
		if ($part!=='') {
			echo '<br/>Found part: '.$part;
		}
	} while ($part!=='');
		
?>
	