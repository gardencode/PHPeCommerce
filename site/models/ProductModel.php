<?php
/*
	Originally by Cainton
	Updated by ML to ffull CRUD
	added full validation
	created unit test
*/
class ProductModel extends AbstractEntityModel {
	// instance data
	private $categoryId;
    private $name;
    private $description;
    private $price;
    private $image;
    
	// standard constructor
	public function __construct(IDatabase $db, $id=null) {
		parent::__construct($db,$id);
	}

	// NB constructor with many parameters changed to factory pattern below
    public static function createFromFields(IDatabase $db,$productId,$categoryId,$name,$description,$price,$image) {
        $model = new ProductModel ($db);
		$model->setID($productId);
        $model->setCategoryId($categoryId);
        $model->setName($name);
        $model->setDescription($description);
        $model->setPrice($price);
        $model->setImage($image);
        $model->didChange(false);
		return $model; 
    }
	/*	
		Getters of private data
	*/
    public function getCategoryId(){
        return $this->categoryId;
    }
    public function getName(){
        return $this->name;
    }
	public function getDescription(){
        return $this->description;
    }
	public function getPrice(){
        return $this->price;
    }
    public function getImage(){
        return $this->image;
    }
	/*	
		Setters of private data (all have validators)
	*/
    public function setCategoryId($value){
		$this->assertNoError($this->errorInCategoryId($this->getDB(),$value));
        $this->categoryId = $value;
        $this->didChange();
    }
    public function setName($value){
		$this->assertNoError($this->errorInName($value));
        $this->name = $value;
        $this->didChange();
    }
    public function setDescription($value){
		$this->assertNoError($this->errorInDescription($value));
        $this->description = $value;
        $this->didChange();
    }
    public function setPrice($value){
		$this->assertNoError($this->errorInPrice($value));
        $this->price = $value;
        $this->didChange();
    }
    public function setImage($value){
     	$this->assertNoError($this->errorInImage($value));
		$this->image = $value;
        $this->didChange();
    }

	/* 		==============
			must overrides
			==============
	*/

	// 	set default values for instance data 
	// (required fields should be set to null)		
	protected function init() {
		$this->categoryId=null;
		$this->name=null;
		$this->description=null;
		$this->price=null;
		$this->image=null;
	}
	// load instance data from database
	protected function loadData($row) {
		$this->categoryId=$row['categoryId'];
		$this->name=$row['name'];
		$this->description=$row['description'];
		$this->price=$row['price'];
		$this->image=$row['image'];	
	}
	// return false if any required field is null
	protected function allRequiredFieldsArePresent() {
		return $this->categoryId !== null && 
		   	   $this->name !== null && 
			   $this->description !== null && 
			   $this->price !== null;
	}
	// load instance data from database
	protected function getLoadSql($id) {
		return 	"select categoryId, name, description, price, image from product where id = $id";
	}
	// sql to insert instance data into database
	protected function getInsertionSql() {	
		$categoryId=$this->safeSqlNumber($this->categoryId);
		$name=$this->safeSqlString($this->name);
		$description=$this->safeSqlString($this->description);
		$price=$this->safeSqlNumber($this->price);
		$image=$this->safeSqlString($this->image);
		
		return "insert into product(categoryId, name, description, price, image) ".
		       "values ($categoryId, $name, $description, $price, $image)";	
	}	
	// sql to update database record from instance data
	protected function getUpdateSql() {
		$categoryId=$this->safeSqlNumber($this->categoryId);
		$name=$this->safeSqlString($this->name);
		$description=$this->safeSqlString($this->description);
		$price=$this->safeSqlNumber($this->price);
		$image=$this->safeSqlString($this->image);
		
		return "update product set ".
			"categoryId=$categoryId, ".
			"name=$name, ".
			"description=$description, ".
		    "price=$price, ".
			"image=$image ".
			"where id=".$this->getId();
	}
	// sql to delete this instance
	protected function getDeletionSql() {
	     return 'delete from product where id = '.$this->getId();
	}
	/*  ==========================
		Static validation routines
		==========================
	*/
	public static function errorInCategoryId(IDatabase $db, $value) {
		if (CategoryModel::isExistingId($db, $value)) {
			return null;
		}
		return "Invalid category ID ($value)";	
	}	
	public static function errorInName($value) {
		return self::errorInRequiredField('Product name',$value,50);	
	}
	public static function errorInDescription($value) {
		return self::errorInRequiredField('Description',$value,300);	
	}
	public static function errorInPrice($value) {
		return self::errorInRequiredNumericField('Price', $value, 2, 0.00, 99999999.99);	
	}
	public static function errorInImage($value) {
		return self::errorInRequiredField('Image',$value,100);	
	}
	public static function isExistingId($db,$id) {
		return self::checkExistingId($db,$id, 
			'select 1 from product where id='.$id);
	}	
}
?>