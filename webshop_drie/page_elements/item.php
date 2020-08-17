<?php
class Item{
	private $name;
	private $price;
	private $description;
	private $image_dir;
	
	public function __construct($item_info){
		$this->name = $item_info["name"];
		$this->price = $item_info["price"];
		$this->description = $item_info["description"];
		$this->image_dir = $item_info["image_dir"];
	}
	
	public function show(){
		echo '<div class="Item">';
		$this->showHeader();
		$this->showPrice();
		$this->showDescription();
		$this->showImage();
		echo '</div>';
	}
	
	protected function showHeader(){
		echo '<div class="ItemHeader">';
		echo '<h3>'.str_replace('_', ' ', ucfirst($this->name)).'</h3>';
		echo '</div>';
	}
	
	protected function showPrice(){
		echo '<div class="ItemPrice">';
		echo '<p>Price: €'.number_format($this->price, 2).'</p>';
		echo '</div>';
	}
	
	protected function showDescription(){
		echo '<div class="ItemDescription">';
		echo '<p>'.$this->description.'</p>';
		echo '</div>';
	}
	
	protected function showImage(){
		echo '<div class="ItemImage">';
		echo '<img src="'.$this->image_dir.'">';
		echo '</div>';
	}
}
?>