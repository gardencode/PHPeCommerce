<?php

class CustomerModelTest extends UnitTest {
	
	function __construct($context) {
		parent::__construct($context);
	}

	protected function setup (){
		$context=$this->getContext();
		$db=$context->getDB();

		$sql = "delete from customers";
		$db->execute ($sql);
		
		$sql = "Insert into customers (id, name, address, email, phone)".
		       "values (1,'Name of customer one','Address of customer one','email of customer one','phone of customer one' );";
		$db->execute ($sql);
	}
	protected function testStaticMethods() {
		$context=$this->getContext();
		$db=$context->getDB();

		// static method tests
		$OK40= str_repeat('x',40);
		$long40= str_repeat('x',41);
		$OK200=str_repeat('x',200);
		$long200=str_repeat('x',201);
		$OK30=str_repeat('x',30);
		$long30=str_repeat('x',31);
		$OK64=str_repeat('x',64);
		$long64=str_repeat('x',65);
		
		$this->assertEqual(Customer2Model::errorInName(null),'Customer name must be specified','name validation');
		$this->assertEqual(Customer2Model::errorInName(''),'Customer name must be specified','name  validation');
		$this->assertEqual(Customer2Model::errorInName($long40),'Customer name must have no more than 40 characters','name validation');
		$this->assertEqual(Customer2Model::errorInName($OK40),null,'name validation');

		$this->assertEqual(Customer2Model::errorInAddress(null),'Address must be specified','Address validation');
		$this->assertEqual(Customer2Model::errorInAddress(''),'Address must be specified','Address  validation');
		$this->assertEqual(Customer2Model::errorInAddress($long200),'Address must have no more than 200 characters','Address validation');
		$this->assertEqual(Customer2Model::errorInAddress($OK200),null,'Address validation');
		
		$this->assertEqual(Customer2Model::errorInEmail($long64),'Email address must have no more than 64 characters','Email validation');
		$this->assertEqual(Customer2Model::errorInEmail($OK64),null,'Email validation');
		
		$this->assertEqual(Customer2Model::errorInPhone($long30),'Phone number must have no more than 30 characters','Email validation');
		$this->assertEqual(Customer2Model::errorInPhone($OK30),null,'Email validation');
		
		$this->assertFalse(Customer2Model::isExistingId($db,null),'ID existence null');
		$this->assertFalse(Customer2Model::isExistingId($db,'xx'),'ID existence alpha');
		$this->assertFalse(Customer2Model::isExistingId($db,2),'ID existence false');
		$this->assert(Customer2Model::isExistingId($db,1 ),'ID existence true');
	}

	protected function testInstanceDefaults() {
		$context=$this->getContext();
		$db=$context->getDB();

		$customer=new Customer2Model($db);
		$this->assertEqual($customer->getID(),null,"Default id should be null");
		$this->assertEqual($customer->getName(),null,"Default name should be null");
		$this->assertEqual($customer->getAddress(),null,"Default address should be null");
		$this->assertEqual($customer->getEmail(),null,"Default email address should be null");
		$this->assertEqual($customer->getPhone(),null,"Default phone no should be null");
		$this->assertFalse($customer->hasChanges(),'Default should be unchanged');
	}

	protected function testInstanceMethods() {
		$context=$this->getContext();
		$db=$context->getDB();

		$customer=new Customer2Model($db,1);
		$this->assertEqual($customer->getID(),1,"id customer 1");
		$this->assertEqual($customer->getName(),'Name of customer one',"name customer 1");
		$this->assertEqual($customer->getAddress(),'Address of customer one',"address customer 1");
		$this->assertEqual($customer->getEmail(),'email of customer one',"email address customer 1");
		$this->assertEqual($customer->getPhone(),'phone of customer one',"Phone no customer 1");
		$this->assertFalse($customer->hasChanges(),'After load should be unchanged');
	
		$customer->setName('Updated name of customer one');
		$this->assertEqual($customer->getName(),'Updated name of customer one',"updated name customer 1");
		$this->assert($customer->hasChanges(),'After set should be changed');
		$customer->save();
		$this->assertFalse($customer->hasChanges(),'After save should be unchanged');
	
	    $customer->setAddress('Updated address customer one');
		$this->assertEqual($customer->getAddress(),'Updated address customer one',"updated address customer 1");
		$this->assert($customer->hasChanges(),'After set should be changed');
		$customer->save();
		$this->assertFalse($customer->hasChanges(),'After save should be unchanged');
		
		$customer->setEmail('Updated email of customer one');
		$this->assertEqual($customer->getEmail(),'Updated email of customer one',"updated email customer 1");
		$this->assert($customer->hasChanges(),'After set should be changed');
		$customer->save();
		$this->assertFalse($customer->hasChanges(),'After save should be unchanged');
		
		$customer->setPhone('Updated phone of customer one');
		$this->assertEqual($customer->getPhone(),'Updated phone of customer one',"updated phone customer 1");
		$this->assert($customer->hasChanges(),'After set should be changed');
		$customer->save();
		$this->assertFalse($customer->hasChanges(),'After save should be unchanged');	
	}

	protected function testUpdateLogic() {
		$context=$this->getContext();
		$db=$context->getDB();
		
		$customer=new Customer2Model($db);
		$customer->setName('a');	
	    $customer->setAddress('b');	
		$customer->setEmail('c');
		$customer->setPhone('d');
		$customer->save();
		$id = $customer->getID();
		
		$this->assertEqual($customer->getID(),$id,"id customer 2");
		$this->assertEqual($customer->getName(),'a',"name customer 2");
		$this->assertEqual($customer->getAddress(),'b',"address customer 2");
		$this->assertEqual($customer->getEmail(),'c',"email address customer 2");
		$this->assertEqual($customer->getPhone(),'d',"Phone no customer 2");
		$this->assertFalse($customer->hasChanges(),'After save should be unchanged');
	
		$customer=new Customer2Model($db,$id);
		$this->assertEqual($customer->getID(),$id,"id customer 2");
		$this->assertEqual($customer->getName(),'a',"name customer 2");
		$this->assertEqual($customer->getAddress(),'b',"address customer 2");
		$this->assertEqual($customer->getEmail(),'c',"email address customer 2");
		$this->assertEqual($customer->getPhone(),'d',"Phone no customer 2");
		$this->assertFalse($customer->hasChanges(),'After load should be unchanged');
	}
	
		protected function testDeletionLogic() {
		$context=$this->getContext();
		$db=$context->getDB();
		
		$customer=new Customer2Model($db,1);	
		$this->assertEqual($customer->getID(),1,"id customer 1");
		$this->assertEqual($customer->getName(),'Name of customer one',"name customer 1");
		$this->assertEqual($customer->getAddress(),'Address of customer one',"address customer 1");
		$this->assertEqual($customer->getEmail(),'email of customer one',"email address customer 1");
		$this->assertEqual($customer->getPhone(),'phone of customer one',"Phone no customer 1");
		$this->assertFalse($customer->hasChanges(),'After load should be unchanged');
		$customer->delete();	
	
		$this->assertEqual($customer->getID(),null,"id customer 1");
		$this->assertEqual($customer->getName(),null,"name customer 1");
		$this->assertEqual($customer->getAddress(),null,"address customer 1");
		$this->assertEqual($customer->getEmail(),null,"email address customer 1");
		$this->assertEqual($customer->getPhone(),null,"Phone no customer 1");
		$this->assertFalse($customer->hasChanges(),'After delete should be unchanged');
	}

}
?>
	