<?php
class UserModel{
	protected $crud;
	protected $session_manager;
	
	public function __construct($crud, $session_manager){
		$this->crud = $crud;
		$this->session_manager = $session_manager;
	}
	
	public function getLoginState(){
		$state = $this->session_manager->getSessionVariable('login state');
		if(isset($state)){
			return $state;
		}
		return 'logged out';
	}
	
	public function setLoginState($login_state){
		$this->session_manager->setOrEditSessionVariable('login state', $login_state);
	}
	
	public function setUserName($user_name){
		$this->session_manager->setOrEditSessionVariable('user_name', $user_name);
	}
	
	public function storeNewUser($user_info){
		$query = 'INSERT INTO users (name, email, password) VALUES (:name, :email, :password)';
		$parameters = ["name"=>$user_info["name"], 'email'=>$user_info["email"], 'password'=>$user_info["password"]];
		return $this->crud->insert($query, $parameters);
	}
	
	public function getUserNameByEmail($user_info){
		$query = 'SELECT name FROM users WHERE email=:email';
		$parameters = ['email'=>$user_info["email"]];
		$result = $this->crud->select($query, $parameters)[0]["name"];
		return $result;
	}

}
?>