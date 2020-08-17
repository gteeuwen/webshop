<?php
require_once('general/crud.php');
require_once('general/session_manager.php');

require_once('models/page_model.php');
require_once('models/user_model.php');
require_once('models/webshop_model.php');
require_once('models/form_fields_model.php');

require_once('controllers/validator.php');
require_once('controllers/user_controller.php');

require_once('pages/page_factory.php');



class PageController{
	protected $crud;
	protected $session_manager;
	protected $page_model;
	protected $user_model;
	protected $webshop_model;
	protected $user_controller;
	protected $page = array();
	protected $page_info;

	
	public function __construct(){
		$this->crud = new Crud();
		$this->session_manager = new SessionManager();
		$this->page_model = new PageModel($this->crud);
		$this->user_model = new UserModel($this->crud, $this->session_manager);
	}
	
	public function handleRequest(){
		$this->getRequest();
		$this->processUpdate();
		$this->showResponse();
	}
	
	protected function getRequest(){
        if (POSTED){
            if (array_key_exists('page', $_POST)){
				$this->page_info["page"] = $_POST['page'];
            }
        }else{
            if (array_key_exists('page', $_GET)){
                $this->page_info["page"] = $_GET['page'];
            }else{
				$this->page_info["page"] = 'home';
			}
        }
	}
	
	protected function processUpdate(){
		if(POSTED){
			$this->handlePostRequest();
		}else{
			$this->handleGetRequest();
		}
	}

	protected function handlePostRequest(){
		$this->user_controller = new UserController($this->crud, $this->session_manager);
		$form_fields_model = new FormFieldsModel();
		$this->page_info["fields"] = $form_fields_model->getFields($this->page_info["page"]);
		$validator = new Validator($this->page_info["fields"]);
		if($validator->validate()){
			switch($this->page_info["page"]){
				case 'contact':
					$this->page_info["page"] = 'contact_succes';
					break;
				case 'login':
					if($this->user_controller->checkIfCorrectLogin()){
						$this->user_model->setLoginState('logged in');
						$this->user_model->setUserName($this->user_model->getUserNameByEmail($_POST));
						$this->page_info["page"] = 'login_succes';
					}
					else{
						$this->page_info["page"] = 'login_error';
					}
					break;
				case 'register':
					if($this->user_controller->checkIfEmailAvailable()){
						$this->user_model->setLoginState('logged in');
						$this->user_model->setUserName($_POST["name"]);
						$this->user_model->storeNewUser($_POST);
						$this->page_info["page"] = 'register_succes';
					}
					else{
						$this->page_info["page"] = 'register_error';
					}
					break;
			}
		}
	}
	
	protected function handleGetRequest(){
		$form_fields_model = new FormFieldsModel();
		$this->page_info["fields"] = $form_fields_model->getFields($this->page_info["page"]);
		$this->webshop_model = new WebshopModel($this->crud, $this->session_manager);
		
		switch($this->page_info["page"]){
			case 'logout':
				$this->handleLogout();
				break;
			case 'shop':
				$this->handleShop();
				break;
		}
	}
	
	protected function handleLogout(){
		$this->user_model->setLoginState('logged out');
		$this->session_manager->destroySession();
	}
	
	protected function handleShop(){
		if(isset($_GET["item_id"])){
			$this->page_info["page"] = 'webshop_item';
		}
		else{
			$this->page_info["page"] = 'webshop';
		}		
	}
	
	
	protected function assignPageInfo(){
		switch($this->page_info["page"]){
			case 'webshop':
				$this->page_info["items"] = $this->webshop_model->getShopItems();
				break;
			case 'webshop_item':
				$this->page_info["item"] = $this->webshop_model->getItem($_GET["item_id"]);
				break;
			case 'cart':
				$this->page_info["items"] = $this->session_manager->getSessionVariable('shopping_cart');
				break;
		}
	}
	
	protected function showResponse(){
			$this->assignPageInfo();
			$this->page_info["menu_items"] = $this->page_model->getMenuInfo();
			$this->page_info["login_state"] = $this->user_model->getLoginState();
			$page_factory = new PageFactory($this->page_model->getPageClassNames());
			$this->page = $page_factory->createPage($this->page_info);
			$this->page->buildPage();
			$this->page->show();
	}
	
}
?>