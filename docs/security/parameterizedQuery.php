<?php

//This is an example of how to prevent SQL injection by using a mysqli prepared statement or parameterized query.
//This is included in Mike's framework but it can be difficult to follow so i thought we would benefit from having it spelled out on one page.
//It is also possible to prevent sql injection by escaping harmful characters (not included here)

//Connect to the database first, in ur framework this would already be done.
$mysqli = new mysqli("localhost", "admin", "admin", "coolshop");

//Get user input from a form through post.
//The data is assumed unsafe at this point because extra sql statement can ba tacked on the end of say a name field.
//An example would be someone posting " 'Hayden' ; DELETE FROM customers " which would maliciously remove me from the customer table.
$unsafeVariable = $_POST["user_input"];

//Next we use the mysqli prepare function to prepare the database query without adding user input.
//We specify the table and field, but not the value to be inserted.
$stmt = $mysqli->prepare("INSERT INTO customer (name)) VALUES (?)");

//Next we use the bind_param function to convert the user input to a string.
//The database will now interpret " 'Hayden' ; DELETE FROM customers " as a string, rather than as a name with an extra mysql statement.
//The "s" tells the database that bind_param is sending a string.
$stmt->bind_param("s", $unsafeVariable);

//Execute the statement, sending it to the database.
$stmt->execute();

//Now instead of malicious code being injected into the database, the name field has just been updated with a very suspicious looking name.

?>