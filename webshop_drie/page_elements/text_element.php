<?php
class TextElement{
	private $content;
	
	public function __construct($content){
		$this->content = $content;
	}
	
	public function show(){
		echo '<div class="TextElement">';
		echo $this->content;
		echo '</div>';
	}
}
?>