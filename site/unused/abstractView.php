<?php
include 'lib/menuBar.php';
abstract class AbstractView {
	private $model;
	private $template;
	private $fields;
	private $menuBar;
	
	public function __construct() {
		$this->model=null;
		$this->template=null;
		$this->fields=array();
		$this->menuBar=new Menubar();
	}
	public function getModel() {
		return $this->model;
	}
	public function setModel($model) {
		$this->model=$model;
	}
	public function setTemplate($template) {
		$this->template=$template;
	}
	public function setTemplateField($name,$value){
		$this->fields[$name]=$value;
	}
	public function setTemplateFields($fields) {
		foreach ($fields as $name=>$value) {
			$this->setTemplateField($name, $value);
		}
	}
	public function getMenuBar() {
		return $this->menuBar;
	}
	public function render() {
		$html=file_get_contents($this->template);
		$html=str_replace('##menubar##', $this->menuBar->getHtml(),$html);
		foreach ($this->fields as $name=>$value) {
			$key='##'.$name.'##';
			$html=str_replace($key, $value,$html);
		}	
		print $html;
	}
	//	expect subclass to override
	public function prepare () {
	}
}
?>