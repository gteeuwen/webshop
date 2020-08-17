<?php
require_once('pages/page.php');
require_once('page_elements/menu.php');
require_once('page_elements/cart.php');

class ShoppingCart extends Page{
	protected $cart;
	
	public function __construct($page_info){
		$this->menu = new Menu('cart', $page_info["menu_items"], $page_info["login_state"]);
		$this->cart = new Cart($page_info["items"]);
	}
	
	protected function addPageContent(){
		array_push($this->page_elements,
			$this->cart
		);
	}
}
?>