<?php
class Validator{
	protected $fields;
	
	public function __construct($fields){
		$this->fields = $fields;
	}
	
	public function validate(){
		$validate = true;
		foreach($this->fields as $field){
			if(!$field->validate()){
				$validate = false;
			}
		}
		return $validate;
	}
	
}
?>