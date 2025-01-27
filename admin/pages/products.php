<?php include_once("../../scripts/DataBase.class.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<script language="JavaScript" type="text/javascript" src="../scripts/util.js"></script>
		<script language="JavaScript" type="text/javascript">
			<!--
			function init(e) {
				if (e != "" && e != "1") {
					alert("El Producto ya existe");
				}
			}
			
			function getProducts() {
				var htm = "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
				htm += "<html xmlns=\"http://www.w3.org/1999/xhtml\">";
				htm += "<head>";
				htm += "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\" />";
				htm += "<" + "script" + " language=\"JavaScript\" type=\"text/javascript\" src=\"../scripts/util.js\"></" + "script" + ">";
				htm += "<link href=\"../../icon.css\" type=\"text/css\" rel=\"stylesheet\">";
				htm += "</head>";
				htm += "<body>";
				htm += "<center>";
				htm += "<form id=\"fProducts_add\" name=\"fProducts_add\" enctype=\"multipart/form-data\" action=\"../scripts/products/add.php\" target=\"_self\" method=\"POST\">";
				htm += "<fieldset><legend>Agregar Producto</legend>";
				htm += "<br />";
				htm += "<table border=\"0\">";
				htm += "<tr>";
				htm += "<td align=\"right\">*Id:&nbsp;</td>";
				htm += "<td align=\"left\"><input class=\"textfield\" type=\"text\" id=\"tId\" name=\"tId\" maxlength=\"16\" /></td>";
				htm += "</tr>";
				htm += "<tr>";
				htm += "<td align=\"right\">*Nombre:&nbsp;</td>";
				htm += "<td align=\"left\"><input class=\"textfield\" type=\"text\" id=\"tName\" name=\"tName\" maxlength=\"16\" /></td>";
				htm += "</tr>";
				htm += "<tr>";
				htm += "<td align=\"right\">Categor&iacute;a:&nbsp;</td>";
				htm += "<td align=\"left\">";
				htm += "<select class=\"textfield\" id=\"sCategory\" name=\"sCategory\">";
				<?php
				$base = new DataBase("localhost", "iconco_iconrates", "iconco_ws", "ws0001");
				$rs = $base->executeQuery("select name from categories");
				while ($row = mysql_fetch_array($rs)) {
					$name = $row[0];
					echo "htm += \""."<option value=\\\"".$name."\\\">".$name."</option>\";";
				}
				$base->close();
				?>
  			htm += "</select>";
				htm += "</td>";
				htm += "</tr>";
				htm += "<tr>";
				htm += "<td align=\"right\">*Precio:&nbsp;</td>";
				htm += "<td align=\"left\"><input class=\"textfield\" type=\"text\" id=\"tPrice\" name=\"tPrice\" maxlength=\"16\" /></td>";
				htm += "</tr>";
				htm += "<tr>";
				htm += "<td align=\"right\">Imagen:&nbsp;</td>";
				htm += "<td align=\"left\"><input class=\"textfield\" type=\"file\" id=\"fImg\" name=\"fImg\" /></td>";
				htm += "</tr>";
				htm += "<tr>";
				htm += "<td align=\"right\" valign=\"top\">Descripci&oacute;n:&nbsp;</td>";
				htm += "<td align=\"left\"><textarea class=\"textfield\" id=\"tDescription\" name=\"tDescription\" cols=\"19\" rows=\"5\"></textarea></td>";
				htm += "</tr>";
				htm += "<tr>";
				htm += "<td align=\"right\">&nbsp;</td>";
				htm += "<td align=\"left\">";
				htm += "<input class=\"button\" type=\"submit\" name=\"sAdd\" value=\"Agregar\" onclick=\"return (isFill(new Array(document.fProducts_add.tId, document.fProducts_add.tName, document.fProducts_add.tPrice)) && isMaxLength(document.fProducts_add.tDescription, 50));\" />";
				htm += "</td>";
				htm += "</tr>";
				htm += "</table>";
				htm += "</fieldset>";
				htm += "</form>";
				htm += "</center>";
				htm += "</body>";
				htm += "</html>";
				document.write(htm);
			}
			-->
		</script>
	<link href="../../icon.css" type="text/css" rel="stylesheet">
	</head>
	<body onload="init('<?= $_GET['e'] ?>');">
		<center>
			<form id="fUsers" name="fUsers" action="../scripts/products/delete.php" target="_self" method="POST">
				<table width="640">
					<tr>
						<th width="20%" align="left"><input type="checkbox" id="cbAll" name="cbAll" value="all" /></th>
						<th width="20%" align="left">Id</th>
						<th width="20%" align="left">Nombre</th>
						<th width="20%" align="left">Categor&iacute;a</th>
						<th width="*" align="left">Precio</th>
					</tr>
					<?php
						$base = new DataBase("localhost", "iconco_iconrates", "iconco_ws", "ws0001");
						$rs = $base->executeQuery("select ix, id, name, category, price from products");
						while ($row = mysql_fetch_array($rs)) {
							$index = $row[0];
							echo "<tr><td align=\"left\"><input type=\"checkbox\" id=\"cb".$index."\" name=\"cb".$index."\" value=\"".$index."\" /></td>";
							for ($i=1; $i<=4; $i++) {
								echo "<td align=\"left\">".$row[$i]."</td>";
							}
							echo "</tr>";
						}
						$base->close();
					?>
				</table>
				<br />
				<input class="button" type="button" name="bAdd" value="Agregar" onclick="getProducts();" />
				&nbsp;
				<input class="button" type="submit" name="sDelete" value="Eliminar" />
			</form>
		</center>
	</body>
</html>

