<?php
class Menu{
	private $current_page;
	private $menu_items;
	private $login_state;
	
	public function __construct($current_page, $menu_items, $login_state){
		$this->current_page = $current_page;
		$this->menu_items = $menu_items;
		$this->login_state = $login_state;
	}
	
	public function show(){
		echo '<div class="Menu"><ul>';
		foreach($this->menu_items as $menu_item){
			if(($menu_item["page"] == $this->current_page) && ($menu_item[$this->login_state])){
				$this->showCurrentPageMenuItem($menu_item);
			}
			else if($menu_item[$this->login_state]){
				$this->showMenuItem($menu_item);
			}
		}
		echo '</ul></div>';
	}
	
	protected function showCurrentPageMenuItem($menu_item){
		echo '<div class="MenuItemSpan">';
		echo '<li><span>'.$menu_item["page"].'</span></li>';
		echo '</div>';
	}
	
	protected function showMenuItem($menu_item){
		echo '<div class="MenuItemA">';
		echo '<li><a href="index.php?page='.$menu_item["page"].'">'.$menu_item["page"].'</a></li>';
		echo '</div>';
	}
}
?>