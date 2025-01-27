<?
	include_once("../../../scripts/DataBase.class.php");
	
	$base = new DataBase("localhost", "iconco_iconrates", "iconco_ws", "ws0001");
	$e = "1";
	if ($_POST['cbAll'] == NULL) {
		$max = $base->getObject("select max(ix) from categories");
		for ($ix=0; $ix<=$max; $ix++) {
			if ($_POST['cb'.$ix] != NULL) {
				if ($base->getObject("select name from categories where owner = (select name from categories where ix = '".$ix."')") == NULL) {
					$base->execute("delete from categories where ix = '".$ix."'");
				} else {
					$e = "0";
				}
			}
		}
	} else {
		$rs = $base->executeQuery("delete from categories");
	}
	$base->close();
	
	header("Location: ../../pages/categories.php?e=".$e);
?>
