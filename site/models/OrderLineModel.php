<?php

class OrderLineModel extends AbstractEntityModel {

    private $orderId;
    private $productId;
    private $quantity;

    public function __construct($db, $orderLineId = null) {
        parent::__construct($db, $orderLineId);
    }

    public static function createFromFields(IDatabase $db,$orderLineId,$orderId, $productId, $quantity) {
        $model = new OrderLineModel ($db);
        $model->setID($orderLineId);
        $model->setOrderId($orderId);
        $model->setProductId($productId);
        $model->setQuantity($quantity);
        $model->didChange(false);
        return $model;
    }

    public function getOrderId(){
        return $this->orderId;
    }
    public function getProductId(){
        return $this->productId;
    }
    public function getQuantity(){
        return $this->quantity;
    }

    public function setOrderId($value){
        //$this->assertNoError($this->errorInOrderId($value));
        $this->orderId = $value;
        $this->didChange();
    }
    public function setProductId($value){
        //$this->assertNoError($this->errorInProductId($value));
        $this->productId = $value;
        $this->didChange();
    }
    public function setQuantity($value){
        //$this->assertNoError($this->errorInQuantity($value));
        $this->quantity = $value;
        $this->didChange();
    }

    protected function init() {
        $this->orderId=null;
        $this->productId=null;
        $this->quantity=null;
    }

    protected function loadData($row) {
        $this->orderId=$row['orderId'];
        $this->productId=$row['productId'];
        $this->quantity=$row['quantity'];
    }

    protected function allRequiredFieldsArePresent() {
        return $this->orderId !== null &&
        $this->productId !== null &&
        $this->quantity !== null;
    }

    protected function getLoadSql($orderLineId) {
        return 	"select orderId, productId, quantity, from orders where id = $orderLineId";
    }

    protected function getInsertionSql() {
        $orderId = $this->safeSqlNumber($this->orderId);
        $productId = $this->safeSqlNumber($this->productId);
        $quantity = $this->safeSqlNumber($this->quantity);
        return "insert into orderlines(orderId, productId, quantity) ".
        "values ($orderId, $productId, $quantity)";
    }

    protected function getUpdateSql() {
        $orderId = $this->safeSqlNumber($this->orderId);
        $productId = $this->safeSqlNumber($this->productId);
        $quantity = $this->safeSqlNumber($this->quantity);
        return "update orderlines set ".
        "orderId=$orderId, ".
        "productId=$productId, ".
        "quantity=$quantity, ".
        "where id=".$this->getID();
    }

    protected function getDeletionSql() {
        return 'delete from orderlines where id = '.$this->getID();
    }

    //todo
    public static function errorInOrderId($value) {
        return self::errorInRequiredField('Order Id',$value,4);
    }
    //todo
    public static function errorInProductId($value) {
        return self::errorInRequiredField('Product Id',$value,32);
    }
    //todo
    public static function errorInQuantity($value) {
        return self::errorInRequiredField('Quantity',$value,32);
    }
    public static function isExistingId($db,$id) {
        return self::checkExistingId($db,$id,
            'select 1 from product where id='.$id);
    }
}
?>