<?php
class Form{
	protected $fields;
	protected $header;
	
	public function __construct(array $fields, $header){
		$this->fields = $fields;
		$this->header = $header;
	}
	
	public function show(){
		echo '<div class="Form">';
		echo '<h3>'.$this->header.'</h3>';
		echo '<form action="index.php" method="post">';
		foreach($this->fields as $field){
			echo '<div class = "FormField">';
			$field->show();
			echo '</div>';
		}
		echo '<div class="FormSubmitButton">';
		echo '<input type="submit" value="Submit">';
		echo '</div>';
		echo '</form>';
		echo '</div>';
	}
	
	public function validate(){
		$result = true;
		foreach($this->fields as $field){
			if(!$field->validate()){
				$result = false;
			}
		}
		return $result;
	}
}
?>