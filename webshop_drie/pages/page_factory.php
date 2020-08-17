<?php
require_once('pages/home.php');
require_once('pages/about.php');
require_once('pages/contact.php');
require_once('pages/login.php');
require_once('pages/register.php');
require_once('pages/logout.php');
require_once('pages/webshop.php');
require_once('pages/webshop_item.php');
require_once('pages/shopping_cart.php');
require_once('pages/register_succes.php');
require_once('pages/login_succes.php');
require_once('pages/register_error.php');
require_once('pages/login_error.php');
require_once('pages/contact_succes.php');

class PageFactory{
	protected $page_classes;
	
	public function __construct($page_classes){
		$this->page_classes = $page_classes;
	}
	
	public function createPage($page_info){
		if(array_key_exists($page_info["page"], $this->page_classes)){
			return new $this->page_classes[$page_info["page"]]($page_info);
		}else{
			return new Home($page_info);
		}
	}	
}
?>