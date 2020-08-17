<?php
class WebshopModel{
	protected $crud;
	protected $session_manager;
	
	public function __construct($crud, $session_manager){
		$this->crud = $crud;
		$this->session_manager = $session_manager;
	}
	
	public function getShopItems(){
		$query = 'SELECT * FROM webshop_items';
		return $this->crud->select($query,);
	}
	
	public function getItem($item_id){
		$query = 'SELECT * FROM webshop_items WHERE id=:id';
		$parameters = ["id"=>$item_id];
		return $this->crud->select($query, $parameters)[0];
	}
	
	public function getShoppingCartItems(){
		return $this->session_manager->getSessionVariable("shopping_cart");
	}
	
	public function updateCart($item){
		$this->session_manager->addToOrCreateSessionArray("shopping_cart", $item);
	}
	
	public function getItemRating($item_id){
		$query = 'SELECT rating FROM webshop_items WHERE id=:id';
		$parameters = ["id"=>$item_id];
		return $this->crud->select($query, $parameters)[0]["rating"];
	}
	
	public function updateItemRating($item_id, $rating, $user_name){
		$this->crud->startMultipleQueries();
		$old_rating = $this->getItemRating($item_id);
		$nr_of_ratings = $this->getNumberOfRatings($item_id);
		$new_nr_of_ratings = $nr_of_ratings + 1;
		$new_rating = ($old_rating * $nr_of_ratings + $rating)/($new_nr_of_ratings);
		$this->addRating($item_id, $user_name);
		
		$query = 'UPDATE webshop_items SET rating=:rating, nr_of_ratings=:nr_of_ratings WHERE id=:id';
		$parameters = ["rating"=>$new_rating, "nr_of_ratings"=>$new_nr_of_ratings, "id"=>$item_id];
		$result = $this->crud->insert($query, $parameters);
		$this->crud->endMultipleQueries();
		return $result;
	}

	protected function addRating($item_id, $user_name){
		$query = 'INSERT INTO ratings (item_id, user_name) VALUES (:item_id, :user_name)';
		$parameters = ["item_id"=>$item_id, "user_name"=>$user_name];
		return $this->crud->insert($query, $parameters);
	}
	
	protected function getNumberOfRatings($item_id){
		$query = 'SELECT nr_of_ratings FROM webshop_items WHERE id=:id';
		$parameters = ["id"=>$item_id];
		return $this->crud->select($query, $parameters)[0]["nr_of_ratings"];
	}
	
}
?>