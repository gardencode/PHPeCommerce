<?php

class ProductTest extends UnitTest {
	
	function __construct($context) {
		parent::__construct($context);
	}

	protected function testStaticMethods() {
		$context=$this->getContext();
		$db=$context->getDB();

		// static method tests
		$OKname= str_repeat('x',50);
		$longName= str_repeat('x',51);
		$OKdesc=str_repeat('x',300);
		$longDesc=str_repeat('x',301);
		$OKimage=str_repeat('x',100);
		$longImage=str_repeat('x',101);
		
		$this->assertEqual(ProductModel::errorInName(null),'Product name must be specified','name validation');
		$this->assertEqual(ProductModel::errorInName(''),'Product name must be specified','name  validation');
		$this->assertEqual(ProductModel::errorInName($longName),'Product name must have no more than 50 characters','name validation');
		$this->assertEqual(ProductModel::errorInName($OKname),null,'name validation');
		
		$this->assertEqual(ProductModel::errorInDescription(null),'Description must be specified','description validation');
		$this->assertEqual(ProductModel::errorInDescription(''),'Description must be specified','description  validation');
		$this->assertEqual(ProductModel::errorInDescription($longDesc),'Description must have no more than 300 characters','description validation');
		$this->assertEqual(ProductModel::errorInDescription($OKname),null,'description validation');

		$this->assertEqual(ProductModel::errorInImage($longDesc),'Image must have no more than 100 characters','image validation');
		$this->assertEqual(ProductModel::errorInImage($OKname),null,'Image validation');

		$this->assertEqual(ProductModel::errorInPrice(null),'Price must be specified','price validation');
		$this->assertEqual(ProductModel::errorInPrice(''),'Price must be specified','price  validation');
		$this->assertEqual(ProductModel::errorInPrice('xx'),'Price must be a number in the range 0 to 99999999.99, with no more than 2 decimal places.','price  validation');
		$this->assertEqual(ProductModel::errorInPrice('123.456'),'Price must be a number in the range 0 to 99999999.99, with no more than 2 decimal places.','price  validation decimals');
		$this->assertEqual(ProductModel::errorInPrice('-0.01'),'Price must be a number in the range 0 to 99999999.99, with no more than 2 decimal places.','price  validation low');
		$this->assertEqual(ProductModel::errorInPrice('123.45'),null,'price  validation');

		$this->assertEqual(ProductModel::errorInCategoryID($db,null),'Invalid category ID ()','categoryID validation');
		$this->assertEqual(ProductModel::errorInCategoryID($db,''),'Invalid category ID ()','categoryID  validation');
		$this->assertEqual(ProductModel::errorInCategoryID($db,10),'Invalid category ID (10)','categoryID validation');
		$this->assertEqual(ProductModel::errorInCategoryID($db,1),null,'Category ID validation');
		
		$this->assertFalse(ProductModel::isExistingId($db,null),'ID existence null');
		$this->assertFalse(ProductModel::isExistingId($db,'xx'),'ID existence alpha');
		$this->assertFalse(ProductModel::isExistingId($db,20),'ID existence false');
		$this->assert(ProductModel::isExistingId($db,1 ),'ID existence true');
	}

	protected function setup () {
		$context=$this->getContext();
		$db=$context->getDB();

		$sql = "delete from product";
		$db->execute ($sql);
		
		$sql = "Insert into product (id, categoryId, name, description, price, image)".
		       "values (1,1,'Name of product one','Description of product one',123.45,'image1.jpg');";
		$db->execute ($sql);
		
	}
	protected function testInstanceMethods() {
		$context=$this->getContext();
		$db=$context->getDB();

		$product=new ProductModel($db);
		$this->assertEqual($product->getID(),null,"Default id should be null");
		$this->assertEqual($product->getName(),null,"Default name should be null");
		$this->assertEqual($product->getDescription(),null,"Default description should be null");
		$this->assertEqual($product->getPrice(),null,"Default price should be null");
		$this->assertEqual($product->getCategoryID(),null,"Default category ID should be null");
		$this->assertEqual($product->getImage(),null,"Default image should be null");
		$this->assertFalse($product->hasChanges(),'Default Should be unchanged');

		$product=new ProductModel($db,1);
		$this->assertEqual($product->getID(),'1',"Product 1 id");
		$this->assertEqual($product->getName(),'Name of product one',"Product 1 name");
		$this->assertEqual($product->getDescription(),'Description of product one',"Product 1 description");
		$this->assertEqual($product->getPrice(),'123.45',"Product 1 price");
		$this->assertEqual($product->getCategoryID(),1,"Product 1 categoryID");
		$this->assertEqual($product->getImage(),'image1.jpg',"Peroduct 1 image");
		$this->assertFalse($product->hasChanges(),'product 1 should be unchanged');
		
		$product->setName('Product one (edited)');
		$this->assertEqual($product->getName(),'Product one (edited)',"Product 1 name");
		$this->assert($product->hasChanges(),'Product 1 should be changed');
		$product->setDescription('Description of Product one (edited)');
		$this->assertEqual($product->getDescription(),'Description of Product one (edited)',"Product 1 description");
		$this->assert($product->hasChanges(),'Product 1 should be changed');
		$product->setPrice(234.56);
		$this->assertEqual($product->getPrice(),'234.56',"Product 1 price");
		$this->assert($product->hasChanges(),'Product 1 should be changed');
		$product->setImage('editedImage1.jpg');
		$this->assertEqual($product->getImage(),'editedImage1.jpg',"Product 1 image");
		$this->assert($product->hasChanges(),'Product 1 should be changed');
		
		$cat=new CategoryModel($db);
		$cat->setName('Testing cat');
		$cat->save();
		$catID=$cat->getID();
		$product->setCategoryID($catID);
		$this->assertEqual($product->getCategoryId(),$catID,"Product 1 categoryID");
		$this->assert($product->hasChanges(),'Product 1 should be changed');


		$product->save();
		$this->assertFalse($product->hasChanges(),'Product 1 should be unchanged');
		// verify properties still have their values after save
		$this->assertEqual($product->getID(),1,"Product 1 id");
		$this->assertEqual($product->getName(),'Product one (edited)','Product 1 name');
		$this->assertEqual($product->getDescription(),'Description of Product one (edited)',"Product 1 description");
		$this->assertEqual($product->getPrice(),234.56,"Product 1 price");
		$this->assertEqual($product->getImage(),'editedImage1.jpg',"Product 1 image");
		$this->assertEqual($product->getCategoryId(),$catID,"Product 1 category ID");

		$product=new ProductModel($db);
	
		$this->assertFalse($product->hasChanges(),'Default should be unchanged');
		$this->assertEqual($product->getID(),null,"Default id should be null");
		$product->setDescription('Description of product two');
		$this->assertEqual($product->getDescription(),'Description of product two',"product 2 description");
		$this->assert($product->hasChanges(),'product 2 should be changed');		
		$product->setName('Product two');
		$this->assert($product->hasChanges(),'product 2 should be changed');
		$this->assertEqual($product->getName(),'Product two',"product2 name");
		$product->setPrice(1.23);
		$this->assert($product->hasChanges(),'product 2 should be changed');
		$this->assertEqual($product->getPrice(),1.23,"product 2 price");
		$product->setCategoryID(1);
		$this->assert($product->hasChanges(),'product 2 should be changed');
		$this->assertEqual($product->getCategoryId(),1,"product 2 categoryID");
		$product->setImage('image2.png');
		$this->assert($product->hasChanges(),'product 2 should be changed');
		$this->assertEqual($product->getImage(),'image2.png',"product 2 image");

		$product->save();		

		$this->assertEqual($product->getID(),7,"after insert, id");
		$this->assertFalse($product->hasChanges(),'product 2 ');		
		$this->assertEqual($product->getName(),'Product two',"after insert, name ");
		$this->assertEqual($product->getDescription(),'Description of product two',"after insert, description");
		$this->assertEqual($product->getPrice(),1.23,"after insert, price");
		$this->assertEqual($product->getCategoryId(),1,"after insert, category id");

		//
		$product->setName('name changed');
		$this->assertEqual($product->getName(),'name changed',"product 2 name");
		$this->assert($product->hasChanges(),'product 2 should be changed');		
		$product->setDescription('description changed');
		$this->assertEqual($product->getDescription(),'description changed',"product 2 description");
		$this->assert($product->hasChanges(),'product 2 should be changed');		
		$product->setPrice('3.45');
		$this->assertEqual($product->getPrice(),'3.45',"product 2 price");
		$this->assert($product->hasChanges(),'product 2 should be changed');		
		$product->setcategoryID(1);
		$this->assertEqual($product->getCategoryId(),1,"product 2 categoryID");
		$this->assert($product->hasChanges(),'product 2 should be changed');		
		$product->save();		
		$this->assertEqual($product->getID(),7,"after save, id");
		$this->assertFalse($product->hasChanges(),'product 2 should be unchanged');		
		$this->assertEqual($product->getName(),'name changed',"product 2 name");
		$this->assertEqual($product->getDescription(),'description changed',"product 2 description");
		$this->assertEqual($product->getPrice(),'3.45',"product 2 price");
		$this->assertEqual($product->getCategoryId(),1,"product 2 categoryID");

		$product=new ProductModel($db,7);
		$this->assertEqual($product->getId(),7,"product 2 id");
		$this->assertEqual($product->getName(),'name changed',"product 2 name");
		$this->assertEqual($product->getDescription(),'description changed',"product 2 description");
		$this->assertEqual($product->getPrice(),'3.45',"product 2 price");
		$this->assertEqual($product->getCategoryId(),'1',"product 2 category ID");
		$this->assertFalse($product->hasChanges(),'product 2 should be unchanged');		
			
		$product->delete();
		$this->assertEqual($product->getID(),null,"After delete id should be null");
		$this->assertEqual($product->getName(),null,"After delete  name should be null");
		$this->assertEqual($product->getDescription(),null,"After delete  description should be null");
		$this->assertEqual($product->getPrice(),null,"After delete  price should be null");
		$this->assertEqual($product->getCategoryId(),null,"After delete  category ID should be null");
		$this->assertFalse($product->hasChanges(),'After delete  Should be unchanged');

		$product=new ProductModel($db,1);
		$product->setcategoryID(1);		
		$product->save();
		$cat->delete(); // clean up	
	}
}
?>
	