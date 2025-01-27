<?php
	include_once("../scripts/MenuBar.class.php");
	include_once("../scripts/DataBase.class.php");
	
	$menu = new MenuBar();
	$menu->add(new MenuItem("Login", "pages/login.htm", "main"));
	//$menu->add(new MenuItem("Login", "pages/toolbar.php", "toolbar"));
	$base = new DataBase("localhost", "iconco_iconrates", "iconco_ws", "ws0001");
	$rs = $base->executeQuery("select name from categories where owner = ''");
	while ($row = mysql_fetch_array($rs)) {
		$name = $row[0];
		$menu->add(new MenuItem($name, "pages/toolbar.php?name=".$name, "toolbar"));//str_replace(" ", "nbsp", $name)
	}
	$menu->show();
?>
