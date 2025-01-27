<?php include_once("../../scripts/DataBase.class.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<script language="JavaScript" type="text/javascript">
			<!--
			function init(e) {
				if (e != "" && e != "1") {
					alert("La categoria ya existe o tiene subcategorias!");
				}
			}
			
			function getCategories_add_php() {
				var htm = "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
				htm += "<html xmlns=\"http://www.w3.org/1999/xhtml\">";
				htm += "<head>";
				htm += "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\" />";
				htm += "<" + "script" + " language=\"JavaScript\" type=\"text/javascript\" src=\"../scripts/util.js\"></" + "script" + ">";
				htm += "<link href=\"../../icon.css\" type=\"text/css\" rel=\"stylesheet\" />";
				htm += "</head>";
				htm += "<body>";
				htm += "<center>";
				htm += "<form id=\"fCategories_add\" name=\"fCategories_add\" action=\"../scripts/categories/add.php\" target=\"_self\" method=\"POST\">";
				htm += "<fieldset><legend>Agregar Categoría</legend>";
				htm += "<br />";
				htm += "<table border=\"0\">";
				htm += "<tr>";
				htm += "<td align=\"right\">*Nombre:&nbsp;</td>";
				htm += "<td align=\"right\"><input class=\"textfield\" type=\"text\" id=\"tName\" name=\"tName\" maxlength=\"16\"></td>";
				htm += "</tr>";
				htm += "<tr>";
				htm += "<td align=\"right\">Perteneciente a:&nbsp;</td>";
				htm += "<td align=\"right\">";
				htm += "<select class=\"textfield\" id=\"sOwner\" name=\"sOwner\">";
				htm += "<option value=\"\">ninguna</option>";
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
				htm += "<td align=\"right\" colspan=\"2\">";
				htm += "<input class=\"button\" type=\"submit\" name=\"sAdd\" value=\"Agregar\" onclick=\"return isFill(new Array(document.fCategories_add.tName));\" />";
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
			<form id="fUsers" name="fUsers" action="../scripts/categories/delete.php" target="_self" method="POST">
				<table width="384">
					<tr>
						<th width="32%" align="left"><input type="checkbox" id="cbAll" name="cbAll" value="all" /></th>
						<th width="32%" align="left">Nombre</th>
						<th width="*" align="left">Categor&iacute;a Due&ntilde;a</th>
					</tr>
					<?php
						$base = new DataBase("localhost", "iconco_iconrates", "iconco_ws", "ws0001");
						$rs = $base->executeQuery("select ix, name, owner from categories");
						while ($row = mysql_fetch_array($rs)) {
							$index = $row[0];
							echo "<tr><td align=\"left\"><input type=\"checkbox\" id=\"cb".$index."\" name=\"cb".$index."\" value=\"".$index."\" /></td>";
							for ($i=1; $i<=2; $i++) {
								echo "<td align=\"left\">".$row[$i]."</td>";
							}
							echo "</tr>";
						}
						$base->close();
					?>
				</table>
				<br />
				<input class="button" type="button" name="bAdd" value="Agregar" onclick="getCategories_add_php();">
				&nbsp;
				<input class="button" type="submit" name="sDelete" value="Eliminar">
			</form>
		</center>
	</body>
</html>
