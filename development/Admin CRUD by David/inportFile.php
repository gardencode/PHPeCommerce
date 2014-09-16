<?php

buildSql('database.sql');


function buildSql($filename){
	//Connect using MySQLDB class
    require_once ("MySQLDB.php");
    $host = 'localhost';
    $dbUser ='root';
    $dbPass ='';
    $dbName ='CoolSite';
    
    // create a new database object and connect to server
    $db = new MySQL($host , $dbUser , $dbPass , $dbName );
    
    //  drop the database and then create it again
    $db->dropDatabase();
    $db->createDatabase();

    // select the database
    $db->selectDatabase();
    
   // select the sql file
    $sql_file = $filename;

    // used to store current query
    $sql = '';
    
    // Read in entire file
    $lines = file($sql_file);
    
    // Loop through each line
    foreach ($lines as $line)
    {
    // Skip it if it's a comment
    if (substr($line, 0, 2) == '--' || $line == '')
        continue;

    // Add this line to the current segment
    $sql .= $line;
    
    // If it has a semicolon at the end, it's the end of the query
    if (substr(trim($line), -1, 1) == ';')
    {
        // Perform the query
        mysql_query($sql) or print('Error performing query \'<strong>' . $sql . '\': ' . mysql_error() . '<br /><br />');
        
        // Reset variable to empty
        $sql = '';
    }
    }
     echo "Tables imported successfully";
     }
?>