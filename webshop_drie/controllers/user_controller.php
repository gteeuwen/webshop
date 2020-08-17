<?php
require_once('models/user_model.php');

class UserController{
	protected $crud;
	protected $session_manager;
	
	public function __construct($crud, $session_manager){
		$this->crud = $crud;
		$this->session_manager = $session_manager;
	}
	
	public function checkIfCorrectLogin(){
		$query = 'SELECT * FROM users WHERE email=:email AND password=:password' ;
		$parameters = ["email"=>$_POST["email"], "password"=>$_POST["password"]];
		if($this->crud->select($query, $parameters)){
			return true;
		}
		return false;
	}
	
	public function checkIfPasswordMatch(){
		return (!empty($_POST["password"]) && !empty($_POST["repeated_password"])) && ($_POST["password"] == $_POST["repeated_password"]);
	}
	
	public function checkIfEmailAvailable(){
		$query = 'SELECT * FROM users WHERE email=:email';
		$parameters = ["email"=>$_POST["email"]];
		if($this->crud->select($query, $parameters) == false){
			return true;
		}
		return false;
	}
}
?>