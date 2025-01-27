<?php
include_once("MenuItem.class.php");

class Menu {
	
	var $id;
	var $label;
	var $_x;
	var $_y;
	var $width;
	var $color;
	var $owner;
	var $items;
	
	function Menu($id, $label="", $_x, $_y, $owner="", $width=100, $color="#F0F0F0") {
		$this->id = $id;
		$this->label = $label;
		$this->_x = $_x;
		$this->_y = $_y;
		$this->width = $width;
		$this->color = $color;
		$this->owner = $owner;
		$this->items = array(new MenuItem());
	}
	
	function getId() {
		return $this->id;
	}
	
	function get_x() {
		return $this->_x;
	}
	
	function get_y() {
		return $this->_y;
	}
	
	function add($item) {
		if ($this->items[0]->isEmpty()) {
			$this->items[0] = $item;
		} else {
			$this->items[count($this->items)] = $item;
		}
	}
	
	function getLabel() {
		return $this->label;
	}
	
	function getCaption() {
		return "<td><a ".$this->onMouseOver()." style=\"cursor:default;\">".$this->label."</a></td>";
	}
	
	function isEmpty() {
		return $this->id == "" && $this->label == "";
	}
	
	function toString() {
		if ($this->items[0]->isEmpty()) {
			return "";
		} else {
			$me = "<div id=\"".$this->id."\" ".$this->onMouseOver()." ".$this->onMouseOut()." style=\"left:".$this->_x."px; position:absolute; top:".$this->_y."px; visibility:hidden;\"><table width=\"".$this->width."\" bgcolor=\"".$this->color."\">";
			$j = count($this->items);
			for ($i=0; $i<$j; $i++) {
				$me .= "<tr>".$this->items[$i]->getCaption()."</tr>";
			}
			$me .= "</table></div>";
			for ($i=0; $i<$j; $i++) {
				$me .= $this->items[$i]->toString();
			}
			return $me;
		}
	}
	
	function onMouseOver() {
		if ($this->items[0]->isEmpty()) {
			return "";
		} else {
			return "onMouseOver=\"show('".$this->id."', '".$this->owner."');\"";
		}
	}
	
	function onMouseOut() {
		if ($this->items[0]->isEmpty()) {
			return "";
		} else {
			return "onMouseOut=\"hide('".$this->id."');\"";
		}
	}
	
}
?>
