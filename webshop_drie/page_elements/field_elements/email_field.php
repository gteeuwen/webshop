<?php
class EmailField{
	private $value;
	private $name = 'email';
	private $label = 'Email: ';
	private $error = '';
	
	public function __construct($field_info){
		if(isset($field_info["value"])){
			$this->value = $field_info["value"];
		}
	}
	
	public function show(){
		echo '<div class="EmailField">';
		echo '<label for="'.$this->name.'">'.$this->label.'</label>';
		echo '<div class="FormErrorMessage">'.$this->error.'</div>';
		echo '<input type="email" name="'.$this->name.'" value="'.$this->value.'">';
		echo '</div>';
	}
	
	public function validate(){
		if(!empty($this->value)){
			if(filter_var($this->value, FILTER_VALIDATE_EMAIL)){
				return true;
			}
			$this->error = 'Email adress not valid.';
			return false;
		}
		$this->error = 'Please fill out your email adress.';
		return false;
	}
}
?>