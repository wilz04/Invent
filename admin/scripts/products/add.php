<?
	include_once("../../../scripts/DataBase.class.php");
	
	$url = $_FILES['fImg']['name'];
	if ($url != NULL) {
		move_uploaded_file($_FILES['fImg']['tmp_name'], "../../../images/uploads/products/".$url);
	} else {
		$url = "apple.jpg";
	}
	
	$base = new DataBase("localhost", "iconco_iconrates", "iconco_ws", "ws0001");
	$rs = $base->execute("insert into products (id, name, description, price, category, image) values ('".$_POST['tId']."', '".$_POST['tName']."', '".substr($_POST['tDescription'], 0, 50)."', '".$_POST['tPrice']."', '".$_POST['sCategory']."', '".$url."')");
	$e = mysql_affected_rows();
	$base->close();
	
	header("Location: ../../pages/products.php?e=".$e);
?>
