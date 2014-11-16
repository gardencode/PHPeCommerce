<?php

class SearchController extends AbstractController {

	public function __construct($context) {
		parent::__construct($context);
	}

	protected function getView($isPostback) {
        echo '<h1>This page is not yet implemented</h1><br/><br/>';
//		$uri = $this->getUri();
//		$part = $uri->getPart();
	}
	/*1) if part is blank, ask the user to complete a search form. On post-back, 
	carry out the search as below

	2) if the part is a non-negative integer, treat it as a category ID 
	and set the category ID filter. If this is followed by a blank part you're done, 
	otherwise, set the match filter to the search term

	3) if the part is the word 'all', get the next part and use it as the match filter.*/

}	

