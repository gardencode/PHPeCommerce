<?php

//   MySQL Database Connection


class MySQL 
{
  var  $host ;
  var  $dbUser ;
  var  $dbPass ;
  var  $dbName ;
  var  $dbConn ;
  var  $dbconnectError ;


  function __construct ( $host , $dbUser , $dbPass , $dbName )
  {
     $this->host   = $host ;
     $this->dbUser = $dbUser ;
     $this->dbPass = $dbPass ;
     $this->dbName = $dbName ;
     $this->connectToServer() ;
   }


  function connectToServer()
  {
       $this->dbConn = @mysql_connect($this->host , $this->dbUser , $this->dbPass )  ;
       if ( !$this->dbConn )
       {
          trigger_error ('could not connect to server' ) ;
          $this->dbconnectError = true ;
       }
       else
       {
			//print "connected to server <br />";
       }
       
  }

function selectDatabase()
{
if (!@mysql_select_db ( $this->dbName , $this->dbConn) )
       {
          trigger_error ('could not select database' ) ;  
          $this->dbconnectError = true ;                     
       }
       else
       {
			//print "$this->dbName  database selected <br />";
       }}
 

function dropDatabase()
{
$sql = "drop database $this->dbName"  ;
        //  execute the sql query
        //print "$sql  <br />";
        if ( $this->query($sql) )
           {
				//print ("the $this->dbName database was dropped<br>") ;
           }
            else
           {
				//print ("the $this->dbName database was not dropped<br>" ) ;
           }
	   
}


function createDatabase()
{
 $sql = "create database $this->dbName"  ;
        //  execute the sql query
        //print "$sql  <br />";
        if ( $this->query($sql) )
           {
				//print ("the $this->dbName database was created<br>") ;
           }
            else
           {
				//print ("the $this->dbName database was not created<br>" ) ;
           }
}	   


   function isError()
   {
      if  ( $this->dbconnectError )
       {
         return true ;
       }
       $error = mysql_error ( $this->dbConn ) ;
       if (empty ($error))
         {
           return false ;
         }
         else
         {
           return true ;   
         }

   }


   function query ( $sql )
   {
     if (!$queryResource = mysql_query ( $sql , $this->dbConn ))
     {
        trigger_error ( 'Query Failed: ' . mysql_error ($this->dbConn ) . ' SQL: ' . $sql ) ;
		return false;
     }
 
     return new MySQLResult( $this, $queryResource ) ; 
   }
}


class MySQLResult 
{
   var $mysql ;
   var $query ;

   function MYSQLResult ( &$mysql , $query )
   {
     $this->mysql = &$mysql ;
     $this->query = $query  ;
   }

    function size()
    {
      return mysql_num_rows($this->query) ;
    }

    function fetch()
    {
       if ( $row = mysql_fetch_array ( $this->query , MYSQL_ASSOC ))
       {

         return $row ;
       }

       else if ( $this->size() > 0 )
       {
         mysql_data_seek ( $this->query , 0 ) ;
         return false ;
       }
       else
       {
         return false ;
       }         

    }
/**
* returns the ID of the last row inserted
* @return  int
*  @access  public
*/

function insertID()
    {
      return mysql_insert_id($this->mysql->dbConn);
    }


   function isError()
    {
      return $this->mysql->isError() ;
    }


}
?>