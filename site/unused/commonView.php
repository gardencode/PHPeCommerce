<?php
include 'lib/View.php';
class CommonView extends View{
	
	private $subviewTemplate;
	private $subviewFields;
	
	public function __construct() {
		parent::__construct();
		$this->subviewTemplate=null;
		$this->subviewFields=array();
	}

	public function setSubviewTemplate($template) {
		$this->subviewTemplate=$template;
	}
	
	public function setSubviewField($field,$value) {
		$this->subviewFields[$field]=$value;
	}
		
	public function prepare () {
		parent::prepare();
		// Read subview	
		$html=file_get_contents($this->subviewTemplate);
		foreach ($this->subviewFields as $name=>$value) {
			$key='##'.$name.'##';
			$html=str_replace($key, $value,$html);
		}	
		$this->setTemplateField('content',$html);
	}	
}
?>