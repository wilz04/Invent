<?php
	include_once("../scripts/DataBase.class.php");
	
	session_start();
	
	$ix = $_GET['ix'];
	
	$base = new DataBase("localhost", "iconco_iconrates", "iconco_ws", "ws0001");
	$rs = $base->executeQuery("select * from products where ix = '".$ix."'");
	$row = mysql_fetch_array($rs);
?>
<table>
	<caption align="left"><?= $row[5] ?></caption>
	<tr>
		<th><img src="images/uploads/products/<?= $row[6] ?>"></th>
		<th class="form">
			<blockquote>
				<p><?= $row[2] ?></p>
			</blockquote>
		</th>
	</tr>
	<tr>
		<td class="form" colspan="2" align="center">
			<center>
				<blockquote>
					<p align="center">
						<?php
							$description = $row[3];
							if ($description != "") {
								echo "Descripci&oacute;n:<br />".$description;
							} else {
								echo "&nbsp;";
							}
						?>
					</p>
				</blockquote>
			</center>
		</td>
	</tr>
	<?php
		if (isset($_SESSION['email'])) {
			?>
				<tr>
					<td align="left">
						<input type="checkbox" id="cbAdd" name="cbAdd" value="1" onClick="editRate(<?= $ix ?>, this.checked);" />
						<label>&nbsp;Agregar a mi cotizaci&oacute;n</label>
					</td>
					<td align="right">Precio:&nbsp;<?= $row[4] ?></td>
				</tr>
				<tr>
					<td colspan="2" align="center">
						<input class="button" type="button" id="bShow" name="bShow" value="Ver y Guardar mi cotizaci&oacute;n" onClick="showRate();" />
					</td>
				</tr>
			<?php
		}
	?>
</table>
