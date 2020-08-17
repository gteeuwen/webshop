<?php
require_once('page_elements/form.php');

class ShopLoggedIn extends Shop{
	
	public function showItem($item){
		echo '<div class="Item">';
		$this->showHeader($item);
		$this->showPrice($item);
		$this->showRating($item);
		$this->showDescription($item);
		$this->showRatingArea($item);
		$this->showImage($item);
		$this->showAddToCartButton($item);
		echo '</div>';		
	}
	
	protected function showAddToCartButton($item){
		echo '<div class="AddToCartButton">';
			echo '<button data-gt-item-id="'.$item["id"].'">Add to cart</button>';
		echo '</div>';
	}	
	
	protected function showRatingArea($item){
		echo '<div class="RatingArea">';
			echo '<label for="points">Rating: </label>';
			echo '<input type="range" id="rating_'.$item["id"].'" name="points" min="0" max="10">';
			echo '<button data-gt-item-id="'.$item["id"].'">Rate</button>';
		echo '</div>';
	}
}
?>