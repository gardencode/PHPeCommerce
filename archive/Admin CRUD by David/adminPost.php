<?php
session_start();

require_once ("MySQLDB.php");

    $host = 'localhost' ;
    $dbUser ='root';
    $dbPass ='';
    $dbName ='Coolsite';

    // create a new database object and connect to server01
    $db = new MySQL($host , $dbUser , $dbPass , $dbName );
  
    // select the database
    $db->selectDatabase();

    // mysql_real_escape_string($userName) 
    // Use to make secure

	// grab the form variables from the global array
	$userName = $_GET['UserID'];
	$passWord = $_GET['Password'];

    // looking in the db for the given username & password
	$sql = "select UserId, AdminId, Password from Administrator where UserId = '$userName' and Password = '$passWord';" ;
	//  execute the sql query
	$result = $db->query($sql);
    
    // setting the found username & password to vars
    while ($myrow = $result->fetch()) {
    
        $DbuserName = $myrow['UserId'];
        $DbpassWord = $myrow['Password'];
        $DbCustNum = $myrow['AdminId'];
    
    }
    

	if(isset($DbuserName)){
		if ($userName = $DbuserName) {
			if ($passWord = $DbpassWord) {
				$_SESSION['admin'] = "True";
				header("location: adminControl.php"); Exit;
			} 
		}
	} else {
        header("location: index.php"); Exit;
    }
?>