<?php
require_once('pages/page.php');
require_once('page_elements/menu.php');
require_once('page_elements/form.php');
require_once('page_elements/field_elements/name_field.php');
require_once('page_elements/field_elements/email_field.php');
require_once('page_elements/field_elements/message_field.php');

class Contact extends Page{
	protected $form;
	
	public function __construct($page_info){	
		$this->form = new Form($page_info["fields"], 'Contact');
		$this->menu = new Menu('contact', $page_info["menu_items"], $page_info["login_state"]);
		
	}
	
	protected function addPageContent(){
		array_push($this->page_elements,
			$this->form
		);
	}

}
?>