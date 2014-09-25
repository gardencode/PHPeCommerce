<?php
include 'lib/abstractModel.php';
include 'models/person.php';

class CustomerModel extends AbstractModel {

	private $people;
	
	public function __construct($db) {
		parent::__construct($db);
		$this->people=array();
		$this->load();
	}
	
	private function load() {
		$sql="select CustomerImg, FirstName, LastName, UserId, Email, Address, City, PhoneNumber from Customer ".
			 "order by FirstName asc, LastName asc";
		$rows=$this->getDB()->query($sql);
		foreach ($rows as $row){
			$image        = $row['CustomerImg'];          
		    $firstName    = $row ['FirstName'];       
		    $lastName     = $row ['LastName'];       
		    $userId       = $row ['UserId'];     
		    $email        = $row ['Email'];       
		    $address      = $row ['Address'];         
		    $city         = $row ['City'];   
		    $phoneNumber  = $row ['PhoneNumber'];
			$person = new PersonModel($this->getDB(),$image,$firstName,$lastName,$userId,$email,$address,$city,$phoneNumber);
			$this->people[]=$person;
		}
	}
	
	public function getPeople() {
		return $this->people;
	}
}
?>