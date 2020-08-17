<?php
require_once('ajax_elements/rating_element.php');
require_once('ajax_elements/base_ajax_element.php');

class AjaxFactory{
	public function buildElement($action, $element_info){
		switch ($action){
			case 'rate':
				$element = new RatingElement($element_info);
				break;
			default:
				$element = new BaseAjaxElement();
				break;
		}
		return $element;
	}
}
?>