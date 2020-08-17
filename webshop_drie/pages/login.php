<?php
require_once('pages/page.php');
require_once('page_elements/menu.php');
require_once('page_elements/form.php');
require_once('page_elements/field_elements/password_field.php');
require_once('page_elements/field_elements/email_field.php');

class Login extends Page{
	protected $form;
	protected $error;
	
	public function __construct($page_info){
		$this->form = new Form($page_info["fields"], 'Login');
		$this->menu = new Menu('login', $page_info["menu_items"], $page_info["login_state"]);
	}
	
	public function setError($error){
		$this->error = $error;
	}
	
	protected function addPageContent(){
		if(isset($this->error)){
			array_push($this->page_elements, new TextElement('<div class="ErrorMessage">'.$this->error.'</div>'));
		}
		array_push($this->page_elements, 
		$this->form
		);
	}

}
?>