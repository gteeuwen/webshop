<?php
class SessionManager{
	
	public function __construct(){
		session_start();
	}
	
	public function setOrEditSessionVariable($var_name, $var_value){
		$_SESSION[$var_name] = $var_value;
	}
	
	public function getSessionVariable($var_name, $default = null){
		return isset($_SESSION[$var_name]) ? $_SESSION[$var_name] : $default;
	}
	
	public function addToOrCreateSessionArray($array_name, $item_to_add){
		if(empty($_SESSION[$array_name])){
			$_SESSION[$array_name] = array();
		}
		array_push($_SESSION[$array_name], $item_to_add);
	}
	
	public function destroySession(){
		session_destroy();
	}
}
?>