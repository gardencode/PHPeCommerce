<?php
/*
   ML framework
*/

class DatabaseException extends Exception {}
class InvalidRequestException extends Exception {}
class ConfigurationException extends Exception {}
class InvalidDataException extends Exception {}
class LoginException extends Exception {}

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