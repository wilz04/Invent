<?php
	include_once("../scripts/MenuBar.class.php");
	include_once("../scripts/DataBase.class.php");
	
	function fillMenu($menu, $base) {
		$rs = $base->executeQuery("select name from categories where owner = '".$menu->getLabel()."'");
		$row = mysql_fetch_array($rs);
		if ($row[0] != NULL) {
			$i = 0;
			do {
				$name = $row[0];
				$tmp = fillMenu(new Menu(str_replace(" ", "", $name)."_menu", $name, $menu->get_x()+55, $menu->get_y()+((++$i)*17), $menu->getId()), $base);
				$rs_nd = $base->executeQuery("select ix, name from products where category = '".$name."'");
				while ($row = mysql_fetch_array($rs_nd)) {
					$tmp->add(new MenuItem($row[1], "pages/product.php?ix=".$row[0], "main"));
				}
				$menu->add($tmp);
			} while ($row = mysql_fetch_array($rs));
		}
		return $menu;
	}
	
	$name = $_GET['name'];
	$toolBar = new MenuBar(VER);
	if ($name != NULL) {
		$base = new DataBase("localhost", "iconco_iconrates", "iconco_ws", "ws0001");
		$rs = $base->executeQuery("select name from categories where owner = '".$name."'");
		$i = 0;
		while ($row = mysql_fetch_array($rs)) {
			$tmp = $row[0];
			$toolBar->add(fillMenu(new Menu(str_replace(" ", "", $tmp)."_menu", $tmp, 120, 100+$i*20), $base));
			$i++;
		}
		$rs = $base->executeQuery("select ix, name from products where category = '".$name."'");
		while ($row = mysql_fetch_array($rs)) {
			$toolBar->add(new MenuItem($row[1], "pages/product.php?ix=".$row[0], "main"));
		}
		$base->close();
	}
	$toolBar->show();
?>
