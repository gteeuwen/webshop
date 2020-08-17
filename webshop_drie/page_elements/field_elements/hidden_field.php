<?php
class HiddenField{
	protected $value;
	protected $name;
	
	public function __construct($field_info){
		$this->value = $field_info["value"];
		$this->name = $field_info["name"];
	}
	
	public function show(){
		echo '<input type="hidden" name="'.$this->name.'" value="'.$this->value.'">';
	}
	
	public function validate(){
		return true;
	}
}
?>