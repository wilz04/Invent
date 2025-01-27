<?php include_once("../../scripts/DataBase.class.php"); ?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link href="../../icon.css" type="text/css" rel="stylesheet">
	</head>
	<body>
		<center>
			<form id="fUsers" name="fUsers" action="../scripts/users/delete.php" target="_self" method="POST">
				<table width="768">
					<tr>
						<th width="16%" align="left"><input type="checkbox" id="cbAll" name="cbAll" value="all" /></th>
						<th width="16%" align="left">Nombre</th>
						<th width="16%" align="left">Apellido</th>
						<th width="16%" align="left">Id</th>
						<th width="16%" align="left">E-mail</th>
						<th width="*" align="left">Phone</th>
					</tr>
					<?php
						$base = new DataBase("localhost", "iconco_iconrates", "iconco_ws", "ws0001");
						$rs = $base->executeQuery("select ix, name, last_name, id, email, phone from users");
						while ($row = mysql_fetch_array($rs)) {
							$index = $row[0];
							echo "<tr><td><input type=\"checkbox\" id=\"cb".$index."\" name=\"cb".$index."\" value=\"".$index."\" /></td>";
							for ($i=1; $i<=5; $i++) {
								echo "<td>".$row[$i]."</td>";
							}
							echo "</tr>";
						}
						$base->close();
					?>
				</table>
				<br />
				<input class="button" type="submit" name="sDelete" value="Eliminar">
			</form>
		</center>
	</body>
</html>
