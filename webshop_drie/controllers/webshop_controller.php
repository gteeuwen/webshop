<?php
class WebshopController{
		
		protected $crud;
		
		public function __construct($crud){
			$this->crud = $crud;
		}
		
		public function checkIfItemRated($item_id, $user_name){
			$query = 'SELECT * FROM ratings WHERE item_id=:item_id AND user_name=:user_name';
			$parameters = ["item_id"=>$item_id, "user_name"=>$user_name];
			if($this->crud->select($query, $parameters) == false){
				return false;
			}
			return true;
		}
		
}
?>