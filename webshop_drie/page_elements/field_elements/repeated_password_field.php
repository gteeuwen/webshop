<?php
class RepeatedPasswordField extends PasswordField{
	
	protected $password;
	protected $name = 'repeated_password';
	protected $label = 'Repeat password: ';
	protected $error = '';
	
	public function __construct($field_info){
		parent::__construct($field_info);
		if(isset($field_info["password"])){
			$this->password = $field_info["password"];
		}
	}
	
	public function validate(){
		if(!empty($this->value)){
			if($this->value == $this->password){
				return true;
			}
			$this->error = 'Passwords do not match';
			return false;
		}
		$this->error = 'Please fill out your password again.';
		return false;				
	}
	
}
?>