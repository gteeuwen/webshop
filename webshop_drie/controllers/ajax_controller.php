<?php
require_once('controllers/webshop_controller.php');
require_once('page_elements/text_element.php');
require_once('models/webshop_model.php');
require_once('general/crud.php');
require_once('general/session_manager.php');
require_once('ajax_elements/ajax_factory.php');

class AjaxController{
	
	protected $crud;
	protected $session_manager;
	protected $webshop_controller;	
	protected $webshop_model;
	protected $action;
	protected $element_info = array();
	protected $ajax_element;
	
	public function __construct(){
		$this->crud = new Crud();
		$this->session_manager = new SessionManager();
		$this->webshop_controller = new WebshopController($this->crud);
		$this->webshop_model = new WebshopModel($this->crud, $this->session_manager);
	}

	public function handleRequest(){
		$this->getRequest();
		$this->processRequest();
		$this->showResponse();
	}
	
	public function getRequest($default = null){
		$this->action = isset($_POST["action"]) ? $_POST["action"] : $default;
	}
	
	public function processRequest(){
		switch ($this->action){
			case 'rate':
				$this->handleRating();
				break;
			case 'add_to_cart':
				$this->handleAddToCart();
				break;
		}
	}
	
	protected function handleRating(){
		if(!$this->webshop_controller->checkIfItemRated($_POST["item_id"], $this->session_manager->getSessionVariable('user_name'))){
			$this->webshop_model->updateItemRating(
				$_POST["item_id"], 
				$_POST["rating"], 
				$this->session_manager->getSessionVariable('user_name')
			);
		}
		$this->element_info["rating"] = $this->webshop_model->getItemRating($_POST["item_id"]);
	}
	
	protected function handleAddToCart(){
		$this->webshop_model->updateCart($this->webshop_model->getItem($_POST["item_id"]));
	}
	
	public function showResponse(){
		$ajax_factory = new AjaxFactory();
		$this->ajax_element = $ajax_factory->buildElement($this->action, $this->element_info);
		$this->ajax_element->show();
	}
	
}
?>