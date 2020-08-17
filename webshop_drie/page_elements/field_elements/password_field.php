<?php
class PasswordField{
	protected $value;
	protected $name = 'password';
	protected $label = 'Password: ';
	protected $error = '';
	
	public function __construct($field_info){
		if(isset($field_info["value"])){
			$this->value = $field_info["value"];
		}else{
			$this->value = '';
		}
	}
	
	public function show(){
		echo '<div class="PasswordField">';
		echo '<label for="'.$this->name.'">'.$this->label.'</label>';
		echo '<div class="FormErrorMessage">'.$this->error.'</div>';
		echo '<input type="password" name="'.$this->name.'" value="'.$this->value.'">';
		echo '</div>';
	}
	
	public function validate(){
		if(!empty($this->value)){
			return true;
		}
		$this->error = 'Please fill out your password.';
		return false;		
	}
}
?>