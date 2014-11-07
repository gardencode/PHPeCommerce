<?php
include 'lib/view.php';
class LoginView extends View {

	private $form;
	public function __construct($context) {
		parent::__construct($context);
		$this->form=file_get_contents('html/forms/login.html');
	}		
	public function updateForm($name,$value) {
		$key='{{'.$name.'}}';
		$this->form=str_replace($key, $value,$this->form);
	}
	public function prepare () {	
		parent::prepare();
		$this->addContent($this->form);
	}
	// TODO: rework
}
?>