<?php
include_once("Menu.class.php");
include_once("MenuItem.class.php");

define("HOR", 0);
define("VER", 1);

class MenuBar {
	
	var $items;
	var $style;
	
	function MenuBar($style=HOR) {
		$this->items = array(new MenuItem());
		$this->style = $style;
	}
	
	function add($item) {
		if ($this->items[0]->isEmpty()) {
			$this->items[0] = $item;
		} else {
			$this->items[count($this->items)] = $item;
		}
	}
	
	function show() {
		$me = "<table cellspacing=\"14\">";
		$j = count($this->items);
		for ($i=0; $i<$j; $i++) {
			if ($i==0 || $this->style==VER)
				$me .= "<tr>";
			$me .= $this->items[$i]->getCaption();
			if ($i==$j-1 || $this->style==VER)
				$me .= "</tr>";
		}
		$me .= "</table>";
		for ($i=0; $i<$j; $i++) {
			$me .= $this->items[$i]->toString();
		}
		echo $me;
	}
	
}
?>
