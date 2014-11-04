<?php
/*
   ML framework
*/

class DatabaseException extends Exception {}

interface IDatabase {
    function query($sql);
    function execute($sql);
	function executeBatch($list);
	function getInsertID();
	function close();
}

interface IUri {
	function getSite();
	function getPart();
	function getID();
}

interface IContext {
	function getDB();
	function getURI();
	function getConfig();
}

?>