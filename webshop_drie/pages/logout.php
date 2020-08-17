<?php
require_once('pages/page.php');
require_once('page_elements/menu.php');
require_once('page_elements/text_element.php');

class Logout extends Page{
	protected $text_content = '<p>You have logged out succesfully!</p>';
	
	public function __construct($page_info){
		$this->menu = new Menu('logout', $page_info["menu_items"], $page_info["login_state"]);
	}

	protected function addPageContent(){
		array_push($this->page_elements,
			new TextElement($this->text_content)
		);
	}
}
?>