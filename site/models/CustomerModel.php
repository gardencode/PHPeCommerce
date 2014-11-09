<?php
/*
	Based on Cainton's model, updated to full CRUD by ML

	But no validation or unit test
	
	I've created an alternate version of the customer model
	that has these - see Customer2Model
	
	I've left this model for now to avoid breaking code
*/

class CustomerModel extends AbstractEntityModel {

	private $image;
	private $firstName;
	private $lastName;
	private $userId; // why do we want this?
	private $email;
	private $address;
	private $city;
	private $phoneNumber;

	// standard constructor
	public function __construct(IDatabase $db, $id=null) {
		parent::__construct($db,$id);
	}

	// NB constructor with many parameters changed to factory pattern below
	public static function createFromFields(IDatabase $db,$id,$image,$firstName,$lastName,$userId,$email,$address, $city, $phoneNumber) {
		$model = new CustomerModel($db);
		$model->setID($id);
		$model->setCustImage($image);
		$model->setFirstName($firstName);
		$model->setLastName($lastName);
		$model->setCustomerID($userId);
		$model->setEmail($email);
		$model->setAdress($address);
		$model->setCity($city);
		$model->setPhoneNumber($phoneNumber);
		$model->didChange(false);
		return $model;
	}

	// *** getters ***

	public function getImage(){
		return $this->image;
	}	
	public function getFirstName(){
		return $this->firstName;
	}
	public function getLastName(){
		return $this->lastName;
	}
	//userid??
	public function getEmail(){
		return $this->email;
	}
	public function getAddress(){
		return $this->address;
	}
	public function getCity(){
		return $this->city;
	}
	public function getPhoneNumber(){
		return $this->phoneNumber;
	}

	public function setImage($value){
		$this->image = $value;
		$this->didChange();
	}
	public function setFirstName($value){
		$this->firstName = $value;
		$this->didChange();
	}
	public function setLastName($value){
		$this->lastName = $value;
		$this->didChange();
	}
	public function setEmail($value){
		$this->email = $value;
		$this->didChange();
	}
	public function setAddress($value){
		$this->address = $value;
		$this->didChange();
	}
	public function setCity($value){
		$this->city = $value;
		$this->didChange();
	}
	public function setPhoneNumber($value){
		$this->phoneNumber =$value;
		$this->didChange();
	}

	protected function init(){
		$this->image=null;
		$this->firstName=null;
		$this->lastName=null;
		$this->userId=null;
		$this->email=null;
		$this->address=null;
		$this->city=null;
		$this->phoneNumber=null;
	}
	
	protected function loadData($row) {
		$this->image=$row['image'];
		$this->firstName=$row['firstName'];
		$this->lastName=$row['lastName'];
		$this->userId=$row['userId'];
		$this->email=$row['email'];
		$this->address=$row['address'];
		$this->city=$row['city'];
		$this->phoneNumber=$row['phoneNumber'];
	}
	
	protected function allRequiredFieldsArePresent() {
		return true; // no required fields (apparently)
		// TODO: consider if this should be true - I don;t believe it!
	}
	protected function getLoadSql($id) {
		return "select image, firstName, lastName, userId, email, address, city, phoneNumber ".
			   "from customer where id = $id;";
	}	
	protected function getInsertionSql() {
		$image      = $this->safeSqlString($this->image);
		$firstname  = $this->safeSqlString($this->firstName);
		$lastname   = $this->safeSqlString($this->lastName);
		$userid     = $this->safeSqlNumber($this->userId);
		$email      = $this->safeSqlString($this->email);
		$address    = $this->safeSqlString($this->address);
		$city       = $this->safeSqlString($this->city); 
		$phone      = $this->safeSqlString($this->phoneNumber);
		
		return  "insert into customer(image, firstName, lastName, userId, email, address, city, phoneNumber) values (".
				"$image,$firstname,$lastname,$userid,$email,$address,$city,$phone)";
	
	}
	protected function getUpdateSql() {
		$image      = $this->safeSqlString($this->image);
		$firstname  = $this->safeSqlString($this->firstName);
		$lastname   = $this->safeSqlString($this->lastName);
		$userid     = $this->safeSqlNumber($this->userId);
		$email      = $this->safeSqlString($this->email);
		$address    = $this->safeSqlString($this->address);
		$city       = $this->safeSqlString($this->city); 
		$phone      = $this->safeSqlString($this->phoneNumber);
		
		return "update customer set image ='$image', ".
				"firstName = $firstname, ".
				"lastName = $lastname, ".
				"userId = $userid, ".
				"email = $email, ".
				"address = $address, ".
				"city = $city, ".
				"phoneNumber = $phone ".
				"where id=".$this->getID();
	}
	
	protected function getDeletionSql() {
		return 'delete from customer where id = '.$this->getID();
	}
}
?>