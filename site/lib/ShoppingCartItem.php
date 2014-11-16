<?php
class ShoppingCartItem {
	private $itemCode;
	private $quantity;
	private $price;
	
	public function __construct($itemCode, $quantity, $price) {
		$this->itemCode =$itemCode;
		$this->quantity =$quantity;
		$this->price =$price;	
	}
	public function getItemCode() {
		return $this->itemCode;
	}
	public function getQuantity() {
		return $this->quantity;
	}
	public function getPrice() {
		return $this->price;
	}
	public function getTotal() {
		return $this->quantity * $this->price;
	}
}
?>