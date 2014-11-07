<?php
include 'lib/abstractView.php';
class SimpleView extends AbstractView{
	private $content;
	public function __construct() {
		parent::__construct();
		$this->content='';
	}
	
	public function addContent($value) {
		$this->content.=$value;
	}
	public function prepare () {
		parent::prepare();
		$this->setTemplateField('content',$this->content);
	}	
}
?>