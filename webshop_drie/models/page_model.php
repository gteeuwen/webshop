<?php
class PageModel{
	
	protected $crud;
	protected $page_class_names = [
		"home"=>'Home',
		"about"=>'About',
		"contact"=>'Contact',
		"login"=>'Login',
		"login_succes"=>'LoginSucces',
		"login_error"=>'LoginError',
		"contact_succes"=>'ContactSucces',
		"contact_error"=>'ContactError',
		"register"=>'Register',
		"register_succes"=>'RegisterSucces',
		"register_error"=>'RegisterError',
		"logout"=>'Logout',
		"webshop"=>'Webshop',
		"webshop_item"=>'WebshopItem',
		"cart"=>'ShoppingCart'
	];
	
	public function __construct($crud){
		$this->crud = $crud;
	}
	
	public function getMenuInfo(){
		$query = 'SELECT * FROM pages';
		return $this->crud->select($query); 
	}
	
	public function getPageClassNames(){
		return $this->page_class_names;
	}
}
?>