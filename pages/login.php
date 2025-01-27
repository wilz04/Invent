<?php
	include_once("../scripts/DataBase.class.php");
	session_start();
	
	$email = $_GET['email'];
	$pwd = $_GET['pwd'];
	
	$base = new DataBase("localhost", "iconco_iconrates", "iconco_ws", "ws0001");
	$rs = $base->executeQuery("select name from users where email = '".$email."' and pwd = '".$pwd."'");
	$row = mysql_fetch_array($rs);
	$name = $row[0];
	if ($name == NULL) {
		echo "El usuario no existe, si deseas registrarte has <a onclick=\"loadURL('pages/register.htm');\"><b>click aqu&iacute;!</b></a>";
	} else {
		session_register('email');
		$_SESSION['email'] = $email;
		session_register('pwd');
		$_SESSION['pwd'] = $pwd;
		session_register('name');
		$_SESSION['name'] = $name;
		echo "Bienvenido ".$name."!<br />Has click en alguna de las opciones de men&uacute; para iniciar";
	}
	$base->close();
?>
