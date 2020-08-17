<?php
class Shop{
	protected $items;
	
	public function __construct(array $items){
		$this->items = $items;
	}
	
	public function show(){
		echo '<div class="Webshop">';
		foreach($this->items as $item){
			$this->showItem($item);
		}
		echo '</div>';
	}
		
	public function showItem($item){
		echo '<div class="Item">';
		$this->showHeader($item);
		$this->showPrice($item);
		$this->showRating($item);
		$this->showDescription($item);
		$this->showImage($item);
		echo '</div>';
	}
	
	protected function showHeader($item){
		echo '<div class="ItemHeader">';
		echo '<h3><a href="index.php?page=shop&amp;item_id='.$item["id"].'">'.str_replace('_', ' ', ucfirst($item["name"])).'</a></h3>';
		echo '</div>';
	}
	
	protected function showPrice($item){
		echo '<div class="ItemPrice">';
		echo '<p>Price: €'.number_format($item["price"], 2).'</p>';
		echo '</div>';
	}
	
	protected function showRating($item){
		echo '<div class="ItemRating">';
		echo '<p id="item_rating_'.$item["id"].'">Rating: '.number_format($item["rating"], 1).'</p>';
		echo '</div>';
	}
	
	protected function showDescription($item){
		echo '<div class="ItemDescription">';
		echo '<p>'.$item["description"].'</p>';
		echo '</div>';
	}
	
	protected function showImage($item){
		echo '<div class="ItemImage">';
		echo '<img src="'.$item["image_dir"].'">';
		echo '</div>';
	}
}
?>