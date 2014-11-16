<?php
class CustomerProductsView extends AbstractView {
	private $pageTemplate;
	private $panelTemplate;

    public function prepare() {
		$this->pageTemplate=file_get_contents('html/customerProducts.html');
		$this->panelTemplate=file_get_contents('html/productPanel.html');	
        $products = $this->getModel()->getProducts();
		$productPanels='';
        foreach ($products as $product) {
            $productPanels.=$this->getProductPanel($product);
        }
    	$content=str_replace('##productPanels##',$productPanels,$this->pageTemplate);
        $this->setTemplateField('content',$content);
    }
	private function getProductPanel($product) {
		$panel = $this->panelTemplate;
		$panel=str_replace('##id##',			$product->getId(),$panel);
		$panel=str_replace('##name##',			$product->getName(),$panel);
		$panel=str_replace('##description##',	$product->getDescription(),$panel);
		$panel=str_replace('##price##',			$product->getPrice(),$panel);
		$panel=str_replace('##image##',			$product->getImage(),$panel);	
		return $panel;
	}
}
?>