<?php
/**
 * Created by PhpStorm.
 * User: Hayden
 * Date: 9/16/14
 * Time: 10:07 PM
 */

$host="localhost"; // Host name
$username="root"; // Mysql username
$password=""; // Mysql password
$db_name="coolshop"; // Database name
$tbl_name="product"; // Table name

// Connect to server and select database.
$link = mysqli_connect($host, $username, $password, $db_name)or die("cannot connect");

// Get values from form
$categoryId = $_POST['category_id'];
$name = $_POST['product_name'];
$description = $_POST['product_description'];
$image = $_POST['product_image'];

// Insert data into mysql
$sql = mysqli_query($link, "INSERT INTO $tbl_name (category_id, product_name, product_description, product_image) VALUES ('$categoryId', '$name', '$description', '$image')");

// if successfully insert data into database, displays message "Successful".
if($sql){
    header("Location: ..");
} else {
    printf("Error: %s\n", mysqli_error($link));
}

?>