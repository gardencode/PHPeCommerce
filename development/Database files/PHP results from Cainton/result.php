<?php
include "lib/database.php";
try {
	$db = new Database ("localhost","root","","");
	$sqlList=array(
		'use coolshop;',
		'select * from product;'
	);
	$nRows = $db->executeBatch($sqlList);
	echo "$nRows rows affected by schema creation<br/>";
	echo 'Here are the people:<br/><br/>';
	
	$rows=$db->query("select product_id, product_name,product_description,product_image from product order by product_name");
	//var_dump($rows);
	foreach($rows as $row){
				echo '<tr>';
				echo '<td>'.$row['product_id'].'</td>';
				echo'<td>'.$row['product_name'].'</td>';
				echo '<td>'.$row['product_description'].'</td>';
				echo '<td>'.$row['product_image'].'</td>';
				echo '<td>$nbsp;</td>';
				echo '</tr>';
	}
} catch ( Exception $ex) {
	echo 'Exception: '.$ex->getMessage();
}


