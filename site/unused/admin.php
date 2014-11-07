<?php
include 'lib/abstractView.php';

class AdminView extends AbstractView {

	public function __construct() {
		parent::__construct();
	}
	public function prepare () {
		$menu=$this->getMenuBar();
		$menu->setMenuItem('a', '##site##logout', 'Log out') ;
		$menu->setMenuItem('b', '##site##admin/categories', 'Categories') ;
		$menu->setMenuItem('c', '##site##admin/people', 'People') ;
	}
}
?>