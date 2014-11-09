<?php
/*
   A PHP framework for web sites by Mike Lopez
   
   A sample entity model for a product category
   ============================================

   Design features:
   ** Static methods (ErrorIn...) can be used to check fields before creation
   ** anything invalid after creation throws an exception
   ** Creating with an ID loads from the database
   ** after setting data, a save will update the database
   ** delete will remove the category from the database and clear all data
   
   NB if cascade delete is not used, deletion will fail if there are dependent
      entities in the database
*/

class CategoryModel extends AbstractEntityModel {

	/* 		Section one - Private instance data
			===================================	
	*/

	private $name;

	// standard constructor
	public function __construct($db, $id=null) {
		parent::__construct($db,$id);
	}

	/* 		Section two - Getters and setters for private instance data
			===========================================================
			
			Setters validate data before setting and 
			notify changes via didChange()
	*/
	public function getName() {
		return $this->name;
	}
	public function setName($value) {
		$this->assertNoError($this->errorInName($value));
		$this->name=$value;
		$this->didChange();
	}		

	/* 		Section three - Implementation of all must overrides
			====================================================
			
			These modify the generic logic in the abstract model to 
			define the specific logic that applies to categories
	*/

	// 	set default values for instance data 
	// (required fields should be set to null)		
	protected function init() {
		$this->name=null;
	}

	// load instance data from database
	protected function loadData($row) {
		$this->name=$row['name'];
	}

	// return false if any required field is null
	protected function allRequiredFieldsArePresent() {
		return $this->name !== null;
	}
	
	// load instance data from database
	protected function getLoadSql($id) {
		return 	"select name from category where id = $id";
	}
	
	// sql to insert instance data into database
	protected function getInsertionSql() {	
		$name=$this->safeSqlString($this->name);
		return "insert into category(name) values ($name)";	
	}	
	
	// sql to update database record from instance data
	protected function getUpdateSql() {
		$name=$this->safeSqlString($this->name);
		return "update category set name=$name ".
			   "where id=".$this->getId();
	}
	// sql to delete this instance
	protected function getDeletionSql() {
	     return 'delete from category where id = '.$this->getId();
	}
		
	/* 		Section four - Validation functions for all fields
			==================================================
		
			These are all static (shared class level) functions
	*/

	public static function errorInName($value) {
		return self::errorInRequiredField('Category name',$value,40);	
	}
	public static function isExistingId(IDatabase $db,$id) {
		return self::checkExistingId($db,$id, 
			'select 1 from category where id='.$id);
	}	
}