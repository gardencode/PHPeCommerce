<?php
include 'lib/abstractView.php';
class CustomersView extends AbstractView {

	public function prepare () {
		$people=$this->getModel()->getPeople();
		$content="<table class='table table-hover table-responsive table-bordered'>\n".
		         "<tr><th>Customer photo</th>
		              <th>First Name</th>
		              <th>Last Name</th>
		              <th>User Name</th>
		              <th>Email</th>
		              <th>Address</th>
		              <th>City</th>
		              <th>Phone</th>
		         	  <th>Action</th>
		         </tr>\n";
		foreach ($people as $person) {
			$name='<tr><td><img src=../images/'.$person->getCustomerImage().'></td><td>'.$person->getFirstName(). '</td><td>'.$person->getLastName().'</td><td>'.$person->getCustomerID().' </td><td>'.
					$person->getEmail().'</td><td>'.$person->getAddress().'</td><td>'.$person->getCity().'</td><td>'.$person->getPhoneNumber();
					//var_dump($person->getCustomerImage());
			$action='&nbsp;<button class="btn btn-large btn-info" type="button"><a href="##site##customer/view/'.$person->getID().'">View</a></button>'.
					'&nbsp;<button class="btn btn-large btn-success" type="button"><a href="##site##customer/edit/'.$person->getID().'">Edit</a></button>'.
					'&nbsp;<button class="btn btn-large btn-danger" type="button"><a href="##site##customer/delete/'.$person->getID().'">Delete</a></button>';
			$content.="<tr><td>$name</td><td>$action</td></tr>\n";
		}
		$content.="</table>\n";
		$content.='<p><a href="##site##customer/new">Add a new person</a></p>';

		$this->setTemplateField('content',$content);
	}
}	
?>