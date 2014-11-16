<?php

class OrderModel extends AbstractEntityModel {
    // instance data
    private $streetNumber;
    private $streetName;
    private $city;
    private $postCode;
    private $totalPrice;
    // standard constructor
    public function __construct($db, $orderId = null) {
        parent::__construct($db, $orderId);
    }
    // NB constructor with many parameters changed to factory pattern below
    public static function createFromFields(IDatabase $db,$orderId,$streetNumber,$streetName,$city,$postCode, $totalPrice) {
        $model = new OrderModel ($db);
        $model->setID($orderId);
        $model->setStreetNumber($streetNumber);
        $model->setStreetName($streetName);
        $model->setcity($city);
        $model->setPostCode($postCode);
        $model->setTotalPrice($totalPrice);
        $model->didChange(false);
        return $model;
    }
    /*
        Getters of private data
    */
    public function getStreetNumber(){
        return $this->streetNumber;
    }
    public function getStreetName(){
        return $this->streetName;
    }
    public function getCity(){
        return $this->city;
    }
    public function getPostCode(){
        return $this->postCode;
    }
    public function getTotalPrice(){
        return $this->totalPrice;
    }
    /*
        Setters of private data (all have validators)
    */
    public function setStreetNumber($value){
        $this->assertNoError($this->errorInStreetNumber($this->getDB(),$value));
        $this->streetNumber = $value;
        $this->didChange();
    }
    public function setStreetName($value){
        $this->assertNoError($this->errorInStreetName($value));
        $this->streetName = $value;
        $this->didChange();
    }
    public function setCity($value){
        $this->assertNoError($this->errorInCity($value));
        $this->city = $value;
        $this->didChange();
    }
    public function setPostCode($value){
        $this->assertNoError($this->errorInPostCode($value));
        $this->postCode = $value;
        $this->didChange();
    }
    public function setTotalPrice($value){
        $this->assertNoError($this->errorInTotalPrice($value));
        $this->totalPrice = $value;
        $this->didChange();
    }
    /* 		==============
            must overrides
            ==============
    */
    // 	set default values for instance data
    // (required fields should be set to null)
    protected function init() {
        $this->streetNumber=null;
        $this->streetName=null;
        $this->city=null;
        $this->postCode=null;
        $this->totalPrice=null;
    }
    // load instance data from database
    protected function loadData($row) {
        $this->streetNumber=$row['streetNumber'];
        $this->streetName=$row['streetName'];
        $this->city=$row['city'];
        $this->postCode=$row['postCode'];
        $this->totalPrice=$row['totalPrice'];
    }
    // return false if any required field is null
    protected function allRequiredFieldsArePresent() {
        return $this->streetNumber !== null &&
        $this->streetName !== null &&
        $this->city !== null &&
        $this->postCode !== null &&
        $this->totalPrice !== null;
    }
    // load instance data from database
    protected function getLoadSql($orderId) {
        return 	"select streetNumber, streetName, city, postCode, totalPrice, from orders where id = $orderId";
    }
    // sql to insert instance data into database
    protected function getInsertionSql() {
        $streetNumber = $this->safeSqlNumber($this->streetNumber);
        $streetName = $this->safeSqlString($this->streetName);
        $city = $this->safeSqlString($this->city);
        $postCode = $this->safeSqlString($this->postCode);
        $totalPrice = $this->safeSqlNumber($this->totalPrice);
        return "insert into orders(streetNumber, streetName, city, postCode, totalPrice) ".
        "values ($streetNumber, $streetName, $city, $postCode, $totalPrice)";
    }
    // sql to update database record from instance data
    protected function getUpdateSql() {
        $streetNumber = $this->safeSqlNumber($this->streetNumber);
        $streetName = $this->safeSqlString($this->streetName);
        $city = $this->safeSqlString($this->city);
        $postCode = $this->safeSqlString($this->postCode);
        $totalPrice = $this->safeSqlNumber($this->totalPrice);
        return "update orders set ".
        "streetNumber=$streetNumber, ".
        "streetName=$streetName, ".
        "city=$city, ".
        "postCode=$postCode, ".
        "totalPrice=$totalPrice, ".
        "where id=".$this->getId();
    }
    // sql to delete this instance
    protected function getDeletionSql() {
        return 'delete from orders where id = '.$this->getId();
    }
    /*
        Static validation routines
    */
    public static function errorInStreetNumber($value) {
        return self::errorInRequiredField('Street Number',$value,32);
    }
    public static function errorInStreetName($value) {
        return self::errorInRequiredField('Street Name',$value,32);
    }
    public static function errorInCity($value) {
        return self::errorInRequiredField('City',$value,32);
    }
    public static function errorInPostCode($value) {
        return self::errorInRequiredField('Post Code',$value,32);
    }
    public static function errorInTotalPrice($value) {
        return self::errorInRequiredNumericField('Total Price', $value, 2, 0.00, 99999999.99);
    }
    public static function isExistingId($db,$id) {
        return self::checkExistingId($db,$id,
            'select 1 from product where id='.$id);
    }
}
?>