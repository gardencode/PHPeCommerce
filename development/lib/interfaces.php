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

?>