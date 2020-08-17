<?php
require_once('pages/login.php');

class LoginError extends Login{

	protected function addPageContent(){
		array_push($this->page_elements, 
			new TextElement('<div class="ErrorMessage"><p>Email and password do not match.</p></div>'),
			$this->form
		);
	}
	
}
?>