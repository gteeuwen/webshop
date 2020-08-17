<?php
require_once('pages/page.php');
require_once('page_elements/menu.php');
require_once('page_elements/item.php');

class WebshopItem extends Page{
	protected $item;
	
	public function __construct($page_info){
		$this->menu = new Menu('shop', $page_info["menu_items"], $page_info["login_state"]);
		$this->item = new Item($page_info["item"]);
	}
	
	protected function addPageContent(){
		array_push($this->page_elements,
			$this->item
		);
	}
}
?>