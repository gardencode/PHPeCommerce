<?php
include 'lib/abstractView.php';

class PublicView extends AbstractView {

	public function __construct() {
		parent::__construct();
	}
	public function prepare () {
		$menu=$this->getMenuBar();
		$menu->setMenuItem('a', '##site##', 'Home') ;
		$menu->setMenuItem('b', '##site##login', 'Log in') ;	
	}
}
?>