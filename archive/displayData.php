<?php
include "lib/database.php";
try {
	$db = new Database ("localhost","root","","");
	$sqlList=array(
		'drop database if exists playDatabase;',
		'create database playDatabase',
		'use playDatabase;',
		'create table people (
			personID int not null auto_increment,
			givenName varchar(40),
			familyName varchar(40),
			primary key (personID)
			);',
		"insert into people (givenName, familyName) values ('Mike','Lopez');",
		"insert into people (givenName, familyName) values ('Mike','Lance');",
		"insert into people (givenName, familyName) values ('Amit','Sarkar');",
		"insert into people (givenName, familyName) values ('Rob','Oliver');",
		"insert into people (givenName, familyName) values ('Luofeng','Xu');"
		);
	
	$nRows = $db->executeBatch($sqlList);
	echo "$nRows rows affected by schema creation<br/>";
	echo 'Here are the people:<br/><br/>';
	
	$rows=$db->query("select givenName, familyName from people order by familyName");
	//var_dump($rows);
	foreach ($rows as $row) {
		$givenName=$row['givenName'];
		$familyName=$row['familyName'];
		
		echo "$givenName $familyName<br/>";
	}
} catch ( Exception $ex) {
	echo 'Exception: '.$ex->getMessage();
}


