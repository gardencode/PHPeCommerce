<?php
/*
   A PHP framework for web sites by Mike Lopez
   
   Sample CRUD controller for a product category
   =============================================

   The following URI patterns are handled by this controller: 
   
   /admin/category/new         	create a new category
   /admin/category/edit/nn		edit category nn
   /admin/category/delete/nn	delete category nn
   /admin/category/view/nn      view category nn
   
   (nn is the category ID)
   
   Note that most of the logic is in the parent CRUD controller
   Here, We're just implementing the category specific stuff
*/

class AdminCategoryController extends CrudController {

	public function __construct(IContext $context) {
		parent::__construct($context);
	}
	protected function getPagename(){
		return 'Categories';
	}
	// the following methods are the must-overrides in the Crud controller
	protected function getTemplateForNew () {
		return 'html/forms/adminCategoryNew.html';
	}
	protected function getTemplateForEdit () {
		return 'html/forms/adminCategoryEdit.html';
	}
	protected function getTemplateForDelete () {
		return 'html/forms/adminCategoryDelete.html';
	}
	protected function getTemplateForView () {
		return 'html/forms/adminCategoryView.html';
	}
	protected function createModel($id) {
		return new CategoryModel($this->getDB(),$id);
	}
	protected function getModelData($model) {
		$this->setField('name', $model->getName());
	}
	protected function getFormData() {
		$name=$this->getInput('name');
		$this->setField('name', $name);
		$error=CategoryModel::errorInName($name);
		if ($error!==null) {
			$this->setError ('name',$error);
		}
	}
	protected function updateModel($model) {
		$name=$this->getField('name');	
		$model->setName($name);
		$model->save();
		$this->redirectTo('admin/categories',"Category '$name' has been saved");
	}
	protected function deleteModel($model) {
		$name=$model->getName();
		$model->delete();
		$this->redirectTo('admin/categories',"Category '$name' has been deleted");
	}	
}
?>