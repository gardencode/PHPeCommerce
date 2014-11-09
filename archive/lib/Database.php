<?php
/*
    Database Connection Class using mysqli
*/

include "lib/interfaces.php";
class Database implements IDatabase
{
	private  $conn ;
	
	function __construct ($host , $user , $password , $database ) {
		$cn = new mysqli($host, $user, $password, $database);
		
		if ($cn->connect_errno) {
			throw new DatabaseException(
				'Failed to connect to MySQL: ('. 
				$cn->connect_errno. ') '. 
				$cn->connect_error);
		}
		$this->conn=$cn;
	}

    function query ( $sql ) {
		$result=$this->conn->query($sql);
		
		if (!$result) {
			throw new DatabaseException (
				'Query failed: ' . $this->conn->error.
				', SQL: ' . $sql );
		}
		$rows=array();
		while($row = $result->fetch_assoc()){
			$rows[]=$row;
		}
		return $rows;
    }
   
    function execute ( $sql ){
		$result=$this->conn->query ($sql);
		if (!$result) {
			throw new DatabaseException (
				'Execute failed: ' . $this->conn->error.
				', SQL: ' . $sql );
		}
		return $this->conn->affected_rows;
	}
	
	function executeBatch ($list){
		$count=0;
		foreach ($list as $sql) {
			$count+=$this->execute($sql);
		}
		return $count;
	}
	
	function getInsertID() {
		return $this->conn->insert_id;
	}
	
	function close(){
		$this->conn->close();
	}
	
}
