<?php
class MessageField{
	protected $value;
	protected $name = 'message';
	protected $label = 'Message: ';
	protected $error = '';
	
	public function __construct($field_info){
		if(isset($field_info["value"])){
			$this->value = $field_info["value"];
		}else{
			$this->value = '';
		}
	}
	
	public function show(){
		echo '<div class="MessageField">';
		echo '<label for="'.$this->name.'">'.$this->label.'</label><br>';
		echo '<div class="FormErrorMessage">'.$this->error.'</div>';
		echo '<textarea name="'.$this->name.'" rows="10" cols="30" value="'.$this->value.'" placeholder="Typ hier uw tekst."></textarea>';
		echo '</div>';
	}
	
	public function validate(){
		if(!empty($this->value)){
			return true;
		}
		$this->error = 'Please leave a message.';
		return false;				
	}
}
?>