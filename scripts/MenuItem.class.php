<?php
class MenuItem {
	
	var $label;
	var $href;
	var $target;
	
	function MenuItem($label="", $href="", $target="") {
		$this->label = $label;
		$this->href = $href;
		$this->target = $target;
	}
	
	function addLi() {
		$this->label = "<li>".$this->label."</li>";
	}
	
	function isEmpty() {
		return $this->label == "" && $this->href == "" && $this->target == "";
	}
	
	function getCaption() {
		//return "<td><a href='".$this->href."' target='".$this->target."'>".$this->label."</a></td>";
		$me = "<td>";
		if (!$this->isEmpty()) {
			$me .= "<a onClick=\"getURL('".$this->href."', '".$this->target."');\" style=\"cursor:default;\">".$this->label."</a>";
		}
		$me .= "</td>";
		return $me;
	}
	
	function toString() {
		return "";
	}
	
}
?>
