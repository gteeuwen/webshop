<?php
require_once('page_elements/field_elements/name_field.php');
require_once('page_elements/field_elements/email_field.php');
require_once('page_elements/field_elements/password_field.php');
require_once('page_elements/field_elements/repeated_password_field.php');
require_once('page_elements/field_elements/message_field.php');
require_once('page_elements/field_elements/hidden_field.php');

class FormFieldsModel{
	
	public function getFields($page){
		switch($page){
			case 'contact':
				return $this->getContactFields();
				break;
			case 'login':
				return $this->getLoginFields();
				break;
			case 'register':
				return $this->getRegisterFields();
				break;
		}
	}
	
	public function getLoginFields(){
		return array(
			new EmailField(["value" => $this->setValue('email')]),
			new PasswordField(["value" => $this->setValue('password')]),
			new HiddenField(["value"=>'login', "name"=>'page'])
		);
	}
	
	public function getContactFields(){
		return array(
			new NameField(["value" => $this->setValue('name')]),
			new EmailField(["value" => $this->setValue('email')]),
			new MessageField(["value" => $this->setValue('message')]),
			new HiddenField(["value"=>'contact', "name"=>'page'])
		);
	}
		
	public function getRegisterFields(){
		return array(
			new NameField(["value" => $this->setValue('name')]),
			new EmailField(["value" => $this->setValue('email')]),
			new PasswordField(["value" => $this->setValue('password')]),
			new RepeatedPasswordField(["value" => $this->setValue('repeated_password'), "password"=>$this->setValue('password')]),
			new HiddenField(["value"=>'register', "name"=>'page'])
		);
	}
			
	protected function setValue($field_name, $default = ''){
		return isset($_POST[$field_name]) ? $_POST[$field_name] : $default;
	}
}
		
?>