<?
	include_once("../../../scripts/DataBase.class.php");
	
	$base = new DataBase("localhost", "iconco_iconrates", "iconco_ws", "ws0001");	
	if ($_POST['cbAll'] == NULL) {
		$max = $base->getObject("select max(ix) from products");
		for ($ix=0; $ix<=$max; $ix++) {
			if ($_POST['cb'.$ix] != NULL) {
				$base->execute("delete from products where ix = '".$ix."'");
			}
		}
	} else {
		$rs = $base->executeQuery("delete from products");
	}
	$base->close();
	
	header("Location: ../../pages/products.php");
?>
