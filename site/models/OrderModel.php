<?php

class OrderModel extends AbstractEntityModel {

    private $streetNumber;
    private $streetName;
    private $city;
    private $postCode;
    private $orderDate;
    private $dateSent;
    private $trackingNumber;

    public function __construct($db, $orderId = null) {
        parent::__construct($db, $orderId);
    }

    public static function createFromFields(IDatabase $db,$orderId,$streetNumber,$streetName,$city,$postCode, $orderDate, $dateSent, $trackingNumber) {
        $model = new OrderModel ($db);
        $model->setID($orderId);
        $model->setStreetNumber($streetNumber);
        $model->setStreetName($streetName);
        $model->setcity($city);
        $model->setPostCode($postCode);
        $model->setOrderDate($orderDate);
        $model->setDateSent($dateSent);
        $model->setTrackingNumber($trackingNumber);
        $model->didChange(false);
        return $model;
    }

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
    public function getOrderDate(){
        return $this->orderDate;
    }
    public function getDateSent(){
        return $this->dateSent;
    }
    public function getTrackingNumber(){
        return $this->trackingNumber;
    }

    public function setStreetNumber($value){
        $this->assertNoError($this->errorInStreetNumber($value));
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
    public function setOrderDate($value){
      //  $this->assertNoError($this->errorInOrderDate($value));
        $this->orderDate = $value;
        $this->didChange();
    }
    public function setDateSent($value){
      //  $this->assertNoError($this->errorInDateSent($value));
        $this->dateSent = $value;
        $this->didChange();
    }
    public function setTrackingNumber($value){
        $this->assertNoError($this->errorInTrackingNumber($value));
        $this->totalPrice = $value;
        $this->didChange();
    }

    protected function init() {
        $this->streetNumber=null;
        $this->streetName=null;
        $this->city=null;
        $this->postCode=null;
        $this->orderDate=null;
        $this->dateSent=null;
        $this->trackingNumber=null;
    }

    protected function loadData($row) {
        $this->streetNumber=$row['streetNumber'];
        $this->streetName=$row['streetName'];
        $this->city=$row['city'];
        $this->postCode=$row['postCode'];
        $this->orderDate=$row['orderDate'];
        $this->dateSent=$row['dateSent'];
        $this->trackingNumber=$row['trackingNumber'];
    }

    protected function allRequiredFieldsArePresent() {
        return $this->streetNumber !== null &&
        $this->streetName !== null &&
        $this->city !== null &&
        $this->postCode !== null;
    }

    protected function getLoadSql($orderId) {
        return 	"select streetNumber, streetName, city, postCode, orderDate, dateSent, trackingNumber, from orders where id = $orderId";
    }

    protected function getInsertionSql() {
        $streetNumber = $this->safeSqlNumber($this->streetNumber);
        $streetName = $this->safeSqlString($this->streetName);
        $city = $this->safeSqlString($this->city);
        $postCode = $this->safeSqlString($this->postCode);
        $dateSent = $this->safeSqlDate($this->dateSent);
        $trackingNumber = $this->safeSqlNumber($this->trackingNumber);
        return "insert into orders(streetNumber, streetName, city, postCode, orderDate, dateSent, trackingNumber) ".
        "values ($streetNumber, $streetName, $city, $postCode, CURDATE(), $dateSent, $trackingNumber)";
    }

    protected function getUpdateSql() {
        $streetNumber = $this->safeSqlNumber($this->streetNumber);
        $streetName = $this->safeSqlString($this->streetName);
        $city = $this->safeSqlString($this->city);
        $postCode = $this->safeSqlString($this->postCode);
        $orderDate = $this->safeSqlDate($this->orderDate);
        $dateSent = $this->safeSqlDate($this->dateSent);
        $trackingNumber = $this->safeSqlNumber($this->trackingNumber);
        return "update orders set ".
        "streetNumber=$streetNumber, ".
        "streetName=$streetName, ".
        "city=$city, ".
        "postCode=$postCode, ".
        "orderDate=$orderDate, ".
        "dateSent=$dateSent, ".
        "trackingNumber=$trackingNumber, ".
        "where id=".$this->getID();
    }

    protected function getDeletionSql() {
        return 'delete from orders where id = '.$this->getId();
    }

    public static function errorInStreetNumber($value) {
        return self::errorInRequiredField('Street Number',$value,4);
    }
    public static function errorInStreetName($value) {
        return self::errorInRequiredField('Street Name',$value,32);
    }
    public static function errorInCity($value) {
        return self::errorInRequiredField('City',$value,32);
    }
    public static function errorInPostCode($value) {
        return self::errorInRequiredField('Post Code',$value,4);
    }
    //todo
    public static function errorInOrderDate($value) {
        return self::errorInRequiredField('Order Date',$value,4);
    }
    //todo
    public static function errorInDateSent($value) {
        return self::errorInRequiredField('Date Sent',$value,4);
    }
    public static function errorInTrackingNumber($value) {
        return self::errorInRequiredField('Tracking Number',$value,20);
    }

    public static function isExistingId($db,$id) {
        return self::checkExistingId($db,$id,
            'select 1 from product where id='.$id);
    }
}
?>