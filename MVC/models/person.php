<?php

class PersonModel extends AbstractModel {

	private $id;
	private $image;
	private $firstName;
	private $lastName;
	private $userId;
	private $email;
	private $address;
	private $city;
	private $phoneNumber;
	private $changed;

	
	public function __construct($db, $id=null, $image=null, $firstName=null,$lastName=null, $userId=null, $email=null, $address=null, $city=null, $phoneNumber=null) {
		parent::__construct($db);
		$this->id=$id;
		$this->setCustImage($image);
		$this->setFirstName($firstName);
		$this->setLastName($lastName);
		$this->setCustomerID($userId);
		$this->setEmail($email);
		$this->setAdress($address);
		$this->setCity($city);
		$this->setPhoneNumber($phoneNumber);
		$this->changed=false;
	}
	
	public function getID() {
		return $this->id;
	}
	public function getCustomerImage(){
		return $this->image;
	}

	public function setCustImage($value){
		$this->image = $value;
		$this->changed = true;
	}

	public function getFirstName(){
		return $this->firstName;
	}
	public function setFirstName($value){
		$this->firstName = $value;
		$this->changed = true;
	}

	public function getLastName(){
		return $this->lastName;
	}

	public function setLastName($value){
		$this->lastName = $value;
		$this->changed = true;
	}

	public function getCustomerID(){
		return $this->userId;
	}

	public function setCustomerID($value){
		$this->userId = $value;
		$this->changed = true;
	}

	public function getEmail(){
		return $this->email;
	}
	public function setEmail($value){
		$this->email = $value;
		$this->changed = true;
	}
	public function getAddress(){
		return $this->address;
	}
	public function setAdress($value){
		$this->address = $value;
		$this->changed = true;
	}
	public function getCity(){
		return $this->city;
	}

	public function setCity($value){
		$this->city = $value;
		$this->changed = true;
	}

	public function getPhoneNumber(){
		return $this->phoneNumber;
	}
	public function setPhoneNumber($value){
		$this->phoneNumber =$value;
		$this->changed = true;
	}

	public function hasChanges(){
		$this->changede;
	}

	public function load($id){
		$sql = "select CustomerImg, FirstName, LastName, UserId, Email, Address, City, PhoneNumber from Customer". "Where CustNum = $id";
		$rows = $this->getDB()->query($sql);
		//Put an If statement here
		$rows = $row[0];
		$this->image        = $row['CustomerImg'];          
		$this->firstName    = $row ['FirstName'];       
		$this->lastName     = $row ['LastName'];       
		$this->userId       = $row ['UserId'];     
		$this->email        = $row ['Email'];       
		$this->address      = $row ['Address'];         
		$this->city         = $row ['City'];   
		$this->phoneNumber  = $row ['PhoneNumber'];
		$this->id           = $id; 
		$this->changed      = false;
	}

	public function save(){
		$id         = $this->id;
		$image      = $this->image;
		$firstname  = $this->firstName;
		$lastname   = $this->lastName;
		$userid     = $this->userId ;
		$email      = $this->email;
		$address    = $this->address ;
		$city       = $this->city ; 
		$phone      = $this->phoneNumber;
		
		if($id === null){
			$sql ="insert into Customer(CustomerImg, FirstName, LastName, UserId, Email, Address, City, PhoneNumber) values
			("."'$image','$firstname','$lastname','$userid','$email','$address','$city','$phone')";
			$this->getDB()->execute($sql);
			$this->id=getDB()->insertID();	
		}
		else{
			$sql = "update Customer "." set CustomerImg ='$image', "." FirstName = '$firstname', "." LastName ='$lastname', "."
					UserId = '$userid', "." Email = '$email', "." Address = '$address', "." City =$city, "." PhoneNumber ='$phone' "."
					WHERE CustNum = $id";
					$this->getDB()->execute($sql);
		}
		$this->changed = false;		
	}

}
?>