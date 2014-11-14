<?php
/*
   A PHP framework for web sites by Mike Lopez
   
   Sample CRUD controller for a list of categories
   ===============================================
   
*/

class AdminCategoriesController extends AbstractController {

	public function __construct($context) {
		parent::__construct($context);
	}
	protected function getView($isPostback) {
		$db=$this->getDB();
		$sql="select id, name from category order by name asc";
		$rows=$db->query($sql);
		if (count($rows)==0) {
			$html='<p>There are no categories</p>';
		} else {
			$table = new TableView($rows);
			$table->setColumn('name','Category name');
			$table->setColumn('action','Action',
				'&nbsp;<a href="##site##admin/category/view/<<id>>">View</a>'.
				'&nbsp;<a href="##site##admin/category/edit/<<id>>">Edit</a>'.
				'&nbsp;<a href="##site##admin/category/delete/<<id>>">Delete</a>');
			$html=$table->getHtml();
		}	
		$html.='<p><a href="##site##admin/category/new">Add a new category</a></p>';
		
		$view= new View($this->getContext());	
		$view->setModel(null);
		$view->setTemplate('html/masterPage.html');
		$view->setTemplateField('pagename','Categories');
		$view->addContent($html);
		return $view;
	}
}
?>