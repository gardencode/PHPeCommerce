<?php
include "lib/database.php";
try {
	$db = new Database ("localhost","root","","");
    $link = mysqli_connect("localhost","root","", "coolshop");
	$sqlList=array(
		'use coolshop;',
		'select * from product;'
	);
	$nRows = $db->executeBatch($sqlList);
	echo "$nRows rows affected by schema creation<br/>";
	echo 'Here are the people:<br/><br/>';
	
	$rows=$db->query("select product_id, category_id, product_name,product_description,product_image from product");

	//var_dump($rows);
	foreach($rows as $row){
        $id = $row['product_id'];

        print $id;
                echo '<form action="views/editProductView.php" method="post">';
				echo '<tr>';
				echo '<td>'.$row['product_id'].'</td>';
				echo '<td>'.$row['category_id'].'</td>';
				echo '<td>'.$row['product_name'].'</td>';
				echo '<td>'.$row['product_description'].'</td>';
				echo '<td>'.$row['product_image'].'</td>';
                echo '<td>' .
                    '<input type="hidden" name="id_to_be_edited" value="' . $id . '" />' .
                    '<input type="submit" name="edit_row" value="Edit"/></form>' .
                    '</td>';
                echo '<td><form action="views/deleteProductView.php" method="post">' .
                     '<input type="hidden" name="id_to_be_deleted" value="' . $id . '" />' .
                     '<input type="submit" name="delete_row" value="Delete"/></form>' .
				     '</td></tr>';
	}
} catch ( Exception $ex) {
	echo 'Exception: '.$ex->getMessage();
}


