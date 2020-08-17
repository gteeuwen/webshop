<?php
require_once('ajax_elements/base_ajax_element.php');
class RatingElement extends BaseAjaxElement{
	
	protected $rating;
	
	public function __construct($element_info){
		$this->rating = $element_info["rating"];
	}
	
	public function show(){
		echo 'Rating: '.number_format($this->rating, 1);
	}
}
?>