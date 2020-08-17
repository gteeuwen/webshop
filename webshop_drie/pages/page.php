<?php
require_once('page_elements/html_start.php');
require_once('page_elements/html_end.php');
require_once('page_elements/footer.php');

abstract class Page{
	protected $page_elements = array();
	protected $menu;
	
	public function buildPage(){
		$this->addStartElements();
		$this->addPageContent();
		$this->addEndElements();
	}
	
	protected function addStartElements(){
		array_push($this->page_elements,
			new HtmlStart(),
			$this->menu
		);
	}
	
	protected function addEndElements(){
		array_push($this->page_elements,
			new Footer(),
			new HtmlEnd()
		);
	}	
	
	protected function addPageContent(){}
	
	public function show(){
		foreach($this->page_elements as $page_element){
			$page_element->show();
		}
	}
}
?>