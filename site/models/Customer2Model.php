<?php
/*
	Based on Cainton's model, updated to full CRUD by ML
	Also added validat1on and unit test
	
	This is an alternate version of the customer model
	using a different schema (customers rather than customer) 
	with fields closer to what I think we need
*/
class Customer2Model extends AbstractEntityModel {

	private $name;
	private $address;
	private $email;
	private $phone;

	// standard constructor
	public function __construct(IDatabase $db, $id=null) {
		parent::__construct($db,$id);
	}

	
	// NB constructor with many parameters changed to factory pattern below
	public static function createFromFields(IDatabase $db,$id,$name,$address,$email,$phone) {
		$model = new Customer2Model($db);
		$model->setID($id);
		$model->setName($name);
		$model->setAddress($address);	
		$model->setEmail($email);
		$model->setPhone($phone);
		$model->didChange(false);
		return $model;
	}

	// *** getters ***
	public function getName(){
		return $this->name;
	}
	public function getAddress(){
		return $this->address;
	}
	public function getEmail(){
		return $this->email;
	}
	public function getPhone(){
		return $this->phone;
	}

	public function setName($value){
		$this->assertNoError($this->errorInName($value));
		$this->name = $value;
		$this->didChange();
	}
	public function setAddress($value){
		$this->assertNoError($this->errorInAddress($value));
		$this->address = $value;
		$this->didChange();
	}
	public function setEmail($value){
		$this->assertNoError($this->errorInEmail($value));
		$this->email = $value;
		$this->didChange();
	}
	public function setPhone($value){
		$this->assertNoError($this->errorInPhone($value));
		$this->phone =$value;
		$this->didChange();
	}

	protected function init(){
		$this->name=null;
		$this->address=null;
		$this->email=null;
		$this->phone=null;
	}
	
	protected function loadData($row) {
		$this->name=$row['name'];
		$this->address=$row['address'];
		$this->email=$row['email'];
		$this->phone=$row['phone'];
	}
	
	protected function allRequiredFieldsArePresent() {
		return $this->name !== null &&
		       $this->address !==null;
	}
	protected function getLoadSql($id) {
		return "select name, address, email,  phone ".
			   "from customers where id = $id;";
	}	
	protected function getInsertionSql() {
		$name    = $this->safeSqlString($this->name);
		$address = $this->safeSqlString($this->address);
		$email 	 = $this->safeSqlString($this->email);
		$phone   = $this->safeSqlString($this->phone);
		return  "insert into customers(name, address, email, phone) values (".
				                     "$name,$address,$email,$phone)";
	}
	protected function getUpdateSql() {
		$name    = $this->safeSqlString($this->name);
		$address = $this->safeSqlString($this->address);
		$email 	 = $this->safeSqlString($this->email);
		$phone   = $this->safeSqlString($this->phone);
	
		return "update customers set ".
				"name = $name, ".
				"address = $address, ".
				"email = $email, ".
				"phone = $phone ".
				"where id=".$this->getID();
	}
	
	protected function getDeletionSql() {
		return 'delete from customers where id = '.$this->getID();
	}
	public static function errorInName($value) {
		return self::errorInRequiredField('Customer name',$value,40);	
	}
	public static function errorInAddress($value) {
		return self::errorInRequiredField('Address',$value,200);	
	}	
	public static function errorInEmail($value) {
		return self::errorInOptionalField('Email address',$value,64);	
	}
	public static function errorInPhone($value) {
		return self::errorInOptionalField('Phone number',$value,30);	
	}
	public static function isExistingId($db,$id) {
		return self::checkExistingId($db,$id, 
			'select 1 from customers where id='.$id);
	}	
}
?>