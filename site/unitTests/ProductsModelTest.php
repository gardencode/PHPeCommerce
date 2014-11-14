<?php

class ProductsModelTest extends UnitTest {
	
	function __construct($context) {
		parent::__construct($context);
	}

	protected function setup () {
		$context=$this->getContext();
		$db=$context->getDB();

		$sql = "delete from product";
		$db->execute ($sql);
	
		$batch=array();
		$batch[] = "Insert into product (categoryId, name, description, price, image)".
		           "values (1,'Name aaa','desc',1.00,'x');";
		$batch[] = "Insert into product (categoryId, name, description, price, image)".
		           "values (1,'Name bbb','desc',2.00,'x');";
		$batch[] = "Insert into product (categoryId, name, description, price, image)".
		           "values (1,'Name bbb','desc',3.00,'x');";
		$batch[] = "Insert into product (categoryId, name, description, price, image)".
		           "values (1,'Name ddd','desc',1.00,'x');";
		$batch[] = "Insert into product (categoryId, name, description, price, image)".
		           "values (1,'Name aaa','desc',2.00,'x');";
		$batch[] = "Insert into product (categoryId, name, description, price, image)".
		           "values (1,'Name bbb','desc',3.00,'x');";
		$batch[] = "Insert into product (categoryId, name, description, price, image)".
		           "values (2,'Name ccc','desc',1.00,'x');";
		$batch[] = "Insert into product (categoryId, name, description, price, image)".
		           "values (2,'Name ddd','desc',2.00,'x');";
		$batch[] = "Insert into product (categoryId, name, description, price, image)".
		           "values (2,'Name aaa','desc',3.00,'x');";
			   
		$db->executeBatch ($batch);
		
	}
	
	protected function testUnfiltered() {
		$context=$this->getContext();
		$db=$context->getDB();

		$model = new ProductsModel($db);
		$products = $model->getProducts();
		$this->assertEqual(count($products),9,"full list");
		$product1 = $products[0];
		$this->assertEqual($product1->getName(),'Name aaa',"name 1");
		$product2 = $products[1];
		$this->assertEqual($product2->getName(),'Name aaa',"name 2");
		$product3 = $products[2];
		$this->assertEqual($product3->getName(),'Name aaa',"name 3");
		$product4 = $products[3];
		$this->assertEqual($product4->getName(),'Name bbb',"name 4");
		$product5 = $products[4];
		$this->assertEqual($product5->getName(),'Name bbb',"name 5");
		$product6 = $products[5];
		$this->assertEqual($product6->getName(),'Name bbb',"name 6");
		$product7 = $products[6];
		$this->assertEqual($product7->getName(),'Name ccc',"name 7");
		$product8 = $products[7];
		$this->assertEqual($product8->getName(),'Name ddd',"name 8");
		$product9 = $products[8];
		$this->assertEqual($product9->getName(),'Name ddd',"name 9 ");		
	}
	
		protected function testIndividualFilters() {
		$context=$this->getContext();
		$db=$context->getDB();

		// category filter
		$model = new ProductsModel($db);
		$model->setCategoryFilter (1);
		$products = $model->getProducts();
		$this->assertEqual(count($products),6,"Category 1");
		$model->setCategoryFilter (2);
		$products = $model->getProducts();
		$this->assertEqual(count($products),0,"Category 1 and 2");
		$model = new ProductsModel($db);
		$model->setCategoryFilter (2);
		$products = $model->getProducts();
		$this->assertEqual(count($products),3,"Category 2");
		
		// name match
		$model = new ProductsModel($db);
		$model->setNameMatch ('aaa');
		$products = $model->getProducts();
		$this->assertEqual(count($products),3,"Name aaa");
		$model->setNameMatch ('bbb');
		$products = $model->getProducts();
		$this->assertEqual(count($products),0,"name aaa and bbb");
		$model = new ProductsModel($db);
		$model->setNameMatch ('bbb');
		$products = $model->getProducts();
		$this->assertEqual(count($products),3,"Name bbb");
		
	
		// Price range
		$model = new ProductsModel($db);
		$model->setPriceRange (1,3);
		$products = $model->getProducts();
		$this->assertEqual(count($products),9,"Prices 1 to 3");
		$model->setPriceRange (2,3);
		$products = $model->getProducts();
		$this->assertEqual(count($products),6,"Prices 1 to 3 and 2 to 3");
		$model->setPriceRange (1,1);
		$products = $model->getProducts();
		$this->assertEqual(count($products),0,"Prices 1 to 1 and 2 to 3");
		
	
		$model = new ProductsModel($db);
		$model->setPriceRange (2,3);
		$products = $model->getProducts();
		$this->assertEqual(count($products),6,"Prices 2 to 3");
	
		$model = new ProductsModel($db);
		$model->setPriceRange (null,2);
		$products = $model->getProducts();
		$this->assertEqual(count($products),6,"Prices up to 2");
	
		$model = new ProductsModel($db);
		$model->setPriceRange (2,null);
		$products = $model->getProducts();
		$this->assertEqual(count($products),6,"Prices 2 or more");
	
		$model = new ProductsModel($db);
		$model->setPriceRange (3,null);
		$products = $model->getProducts();
		$this->assertEqual(count($products),3,"Prices 3 or more");
	
		$model = new ProductsModel($db);
		$model->setPriceRange (null,1 );
		$products = $model->getProducts();
		$this->assertEqual(count($products),3,"Prices 1 or less");
		
		
		// limit
		$model = new ProductsModel($db);
		$model->setLimit (6);
		$products = $model->getProducts();
		$this->assertEqual(count($products),6,"Limit 6");
		$model->setLimit (6,5);
		$products = $model->getProducts();
		$this->assertEqual(count($products),4,"Limit 6, starting at 5");
	}

	protected function testCombinations() {
		$context=$this->getContext();
		$db=$context->getDB();

		$model = new ProductsModel($db);
		$model->setCategoryFilter (1);
		$products = $model->getProducts();
		$this->assertEqual(count($products),6,"Category 1");
		$model->setNameMatch ('aaa');
		$products = $model->getProducts();
		$this->assertEqual(count($products),2,"Category 1 and aaa");
		$model->setPriceRange (2);
		$products = $model->getProducts();
		$this->assertEqual(count($products),1,"Category 1 and aaa and 2 or more");		
	}	
}
?>
	