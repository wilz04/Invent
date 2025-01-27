<?
	include_once("../../../scripts/DataBase.class.php");
	
	$base = new DataBase("localhost", "iconco_iconrates", "iconco_ws", "ws0001");
	$rs = $base->execute("insert into categories (name, owner) values ('".$_POST['tName']."', '".$_POST['sOwner']."')");
	$e = mysql_affected_rows();
	$base->close();
	
	header("Location: ../../pages/categories.php?e=".$e);
?>
