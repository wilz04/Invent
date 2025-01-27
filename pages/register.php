<?php
	include_once("../scripts/DataBase.class.php");
	session_start();
	
	$email = $_GET['email'];
	$pwd = $_GET['pwd'];
	$name = $_GET['fname'];
	$sname = $_GET['sname'];
	$id = $_GET['id'];
	$phone = $_GET['phone'];

	$base = new DataBase("localhost", "iconco_iconrates", "iconco_ws", "ws0001");
	if ($base->execute("insert into users (name, last_name, pwd, id, email, phone) values ('".$fname."', '".$sname."', '".$pwd."', '".$id."', '".$email."', '".$phone."')")) {
		session_register('email');
		$_SESSION['email'] = $email;
		session_register('pwd');
		$_SESSION['pwd'] = $pwd;
		session_register('name');
		$_SESSION['name'] = $name;
		echo "Bienvenido ".$name."!<br />Has click en alguna de las opciones de men&uacute; para iniciar";
	} else {
		echo "El usuario ya existe!<br /><a onclick=\"prev();\"><b>Volver</b></a>";
	}
	$base->close();
?>