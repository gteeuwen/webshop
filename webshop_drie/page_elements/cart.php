<?php
class Cart{
	private $items;
	private $total_price = 0;
	
	public function __construct($items){
		$this->items = isset($items) ? $items : null;
	}
	
	public function show(){
		echo '<div class="ShoppingCart">';
		echo '<p>You have added the following items to your cart:<br></p>';
		if(isset($this->items)){
			foreach($this->items as $item){
				$this->showItem($item);
				$this->total_price += $item["price"];
			}	
		}		
		$this->showTotalPrice();
		echo '</div>';
	}
	
	protected function showItem($item){
		echo '<div class="ShoppingCartItem">';
		echo '<p>'.str_replace('_', ' ', ucfirst($item["name"])).': €'.number_format($item["price"], 2).'</p>';
		echo '</div>';
	}
	
	protected function showTotalPrice(){
		echo '<div class="ShoppingCartTotalPrice">';
		echo '<p>Total price: €'.number_format($this->total_price, 2).'</p>';
		echo '</div>';
	}
}
?>