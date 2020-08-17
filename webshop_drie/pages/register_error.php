<?php
require_once('pages/register.php');

class RegisterError extends Register{

	protected function addPageContent(){
		array_push($this->page_elements, 
			new TextElement('<div class="ErrorMessage"><p>Email is already in use</p></div>'),
			$this->form
		);
	}
	
}
?>