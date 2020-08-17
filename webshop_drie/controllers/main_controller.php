<?php
require_once('controllers/page_controller.php');
require_once('controllers/ajax_controller.php');

class MainController{
	protected $is_ajax;
	protected $controller;
	
	public function __construct(){
		$this->is_ajax = $this->getServerVar("HTTP_X_REQUESTED_WITH") == "XMLHttpRequest"; 
	}
	
	public function runPage(){
		if($this->is_ajax){
			$this->controller = new AjaxController();
		}else{
			$this->controller = new PageController();
		}
		$this->controller->handleRequest();
	}
	
	protected function getServerVar($name, $default="<strong>NOT SET</strong>")
    {
            return isset($_SERVER[$name])? $_SERVER[$name] : $default;
    } 
}
?>