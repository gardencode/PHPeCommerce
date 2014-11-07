<?php
/*
   A PHP framework for web sites by Mike Lopez
   
   Sample CRUD controller for a list of categories
   ===============================================
   
*/
include 'lib/abstractController.php';
include 'lib/view.php';

class CategoriesController extends AbstractController {

	public function __construct($context) {
		parent::__construct($context);
	}

	protected function getView($isPostback) {
		$db=$this->getDB();
		$sql="select categoryID, name from categories ".
			 "order by name asc";
		$rows=$db->query($sql);
		$rowCount=count($rows);
		if ($rowCount==0) {
			$html='There are no categories';
		} else {
			$html="<table>\n".
		          "<tr><th>Name</th><th>Action</th></tr>\n";
			foreach ($rows as $row) {
				$html.=$this->getRowHtml($row);
			}
			$html.="<table>\n";
		}
		
		$html.='<p><a href="##site##admin/category/new">Add a new category</a></p>';
		
		$view= new View($this->getContext());	
		$view->setModel(null);
		$view->setTemplate('html/masterPage.html');
		$view->setTemplateField('pagename','Categories');
		
		
		$view->addContent($html);
		return $view;
	}
	
	private function getRowHtml($row) {
		$id=$row['categoryID'];
		$name=$row['name'];
		$action='&nbsp;<a href="##site##admin/category/view/'.$id.'">View</a>'.
				'&nbsp;<a href="##site##admin/category/edit/'.$id.'">Edit</a>'.
				'&nbsp;<a href="##site##admin/category/delete/'.$id.'">Delete</a>';
		return "<tr><td>$name</td><td>$action</td></tr>\n";		
	}
}
?>