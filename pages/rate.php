<?php
	include_once("../scripts/DataBase.class.php");
	session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>Icon Invent - Mi Cotizaci&oacute;n</title>
		<?php
			$prods = $_GET['prods'];
			if ($prods != NULL) {
				$now = date("m/d/y");
				$base = new DataBase("localhost", "iconco_iconrates", "iconco_ws", "ws0001");
				$base->execute("insert into rates (owner, products, date) values ('".$_SESSION['email']."', '".$prods."', '".$now."')");
				$rs = $base->executeQuery("select name, last_name, id, email, phone from users where email = '".$_SESSION['email']."'");
				$row = mysql_fetch_array($rs);
			}/* else {
				$rs = $base->executeQuery("select products from rates where id = '".$_GET['id']."'");
				$row = mysql_fetch_array($rs);
			}*/
		?>
		<script language="JavaScript" type="text/javascript">
			<!--
			function update(index) {
				var tTotal = document.getElementById("tTotal_" + index.toString());
				var tPrice = document.getElementById("tPrice_" + index.toString());
				var total = index*parseInt(tPrice.value);
				tTotal.value = total.toString();
				
				total = 0;
				var tmp;
				for (index=0; tTotal!=null; index++) {
					if (index != 0) {
						tmp = parseInt(tTotal.value);
						total += tmp;
					}
					tTotal = document.getElementById("tTotal_" + index.toString());
				}
				document.fRate.tMaxTotal.value = total.toString();
			}
			
			function up(index) {
				var tQuant = document.getElementById("tQuant_" + index.toString());
				index = parseInt(tQuant.value);
				//if (i < 24)
				index++;
				tQuant.value = index.toString();
				
				update(index);
			}
			
			function down(index) {
				var tQuant = document.getElementById("tQuant_" + index.toString());
				index = parseInt(tQuant.value);
				//if (i > 0)
				i--;
				tQuant.value = index.toString();
				
				update(index);
			}
			-->
		</script>
	</head>
	<link href="../icon.css" type="text/css" rel="stylesheet">
	<body>
		<label><?= $now ?></label>
		<label>Cotizaci&oacute;n</label>
		<center>
			<table width="100%">
				<caption>Destinatario</caption>
				<tr>
					<td>Nombre</td>
					<td><?= $row[0] ?></td>
				</tr>
				<tr>
					<td>Apellido</td>
					<td><?= $row[1] ?></td>
				</tr>
				<tr>
					<td>Id</td>
					<td><?= $row[2] ?></td>
				</tr>
				<tr>
					<td>E-mail</td>
					<td><?= $row[3] ?></td>
				</tr>
				<tr>
					<td>Tel&eacute;fono</td>
					<td><?= $row[4] ?></td>
				</tr>
			</table>
			<form id="fRate" name="fRate" action="rate.php" target="_self" method="POST">
				<table width="100%">
					<caption>Productos</caption>
					<tr>
						<th>Producto</th>
						<th>Cantidad</th>
						<th>Precio Unitario</th>
						<th>Precio Total</th>
					</tr>
					<?php
						$ixs = explode(",", $prods);
						$j = count($ixs);
						for ($i=0; $i<$j; $i++) {
							$rs = $base->executeQuery("select name, price from products where ix = '".$ixs[$i]."'");
							$price = $rs[1];
							echo 
								"<td>".$rs[0]."</td>".
								"<td>".
									"<input class=\"textfield\" type=\"text\" id=\"tQuant_".$i."\" name=\"tQuant_".$i."\" value=\"1\" readonly /></td>".
									"<input class=\"button\" type=\"button\" id=\"bSub_".$i."\" name=\"bSub_".$i."\" value=\"-\" onClick=\"down(".$i.");\" />".
									"<input class=\"button\" type=\"button\" id=\"bSub_".$i."\" name=\"bAdd_".$i."\" value=\"+\" onClick=\"up(".$i.");\" />".
								"<td><input class=\"textfield\" type=\"text\" id=\"tPrice_".$i."\" name=\"tPrice_".$i."\" value=\"".$price."\" readonly /></td>".
								"<td><input class=\"textfield\" type=\"text\" id=\"tTotal_".$i."\" name=\"tTotal_".$i."\" size=\"2\" value=\"".$price."\" /></td>"
							;
						}
						$base->close();
					?>
					<tr>
						<th colspan="2">&nbsp;</th>
						<th>Precio Total:</th>
						<th><input class="textfield" type="text" id="tMaxTotal" name="tMaxTotal" /></th>
					</tr>
				</table>
				<input class="button" type="submit" id="tSave" name="tSave" value="Guardar Cambios" />
			</form>
		</center>
	</body>
</html>
