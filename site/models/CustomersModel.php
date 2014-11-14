<?php

class CustomersModel extends AbstractModel {

	private $people;
	
	public function __construct($db) {
		parent::__construct($db);
		$this->people=array();
		$this->load();
	}
	
	private function load() {
		$sql="select id, image, firstName, lastName, userId, email, address, city, phoneNumber from customer ".
			 "order by LastName asc, FirstName asc";
		$rows=$this->getDB()->query($sql);
		foreach ($rows as $row){
			$id           = $row['id'];
			$image        = $row['image'];          
		    $firstName    = $row['firstName'];       
		    $lastName     = $row['lastName'];       
		    $userId       = $row['userId'];     
		    $email        = $row['email'];       
		    $address      = $row['address'];         
		    $city         = $row['city'];   
		    $phoneNumber  = $row['phoneNumber'];
			$person = new CustomerModel($this->getDB(),$id,$image,$firstName,$lastName,$userId,$email,$address,$city,$phoneNumber);
			$this->people[]=$person;
		}
	}
	public function getPeople() {
		return $this->people;
	}
}
?>