<?php
require_once('pages/page.php');
require_once('page_elements/menu.php');
require_once('page_elements/shop.php');
require_once('page_elements/shop_logged_in.php');


class Webshop extends Page{
	protected $shop;
	
	public function __construct($page_info){
		if($page_info["login_state"] == 'logged in'){
			$this->shop = new ShopLoggedIn($page_info["items"]);
		}
		else{
			$this->shop = new Shop($page_info["items"]);
		}
		$this->menu = new Menu('shop', $page_info["menu_items"], $page_info["login_state"]);
	}
	
	protected function addPageContent(){
		array_push($this->page_elements,
			$this->shop
		);
	}
}
?>