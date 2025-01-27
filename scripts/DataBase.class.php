<?php
class DataBase {

	var $cx;
	var $name;

	function DataBase($dns, $name, $user, $pwd) {
		$this->cx = mysql_connect($dns, $user, $pwd);
		if (!$this->cx) {
			echo "No se pudo conectar.";
			exit();
		}
		$this->name = $name;
	}
	
	function setName($name) {
		$this->name = $name;
	}
	
	function execute($query) {
		//insert, update, delete
		mysql_select_db($this->name, $this->cx);
		return mysql_query($query);
	}
	
	function executeQuery($query) {
		//select
		$rs = $this->execute($query);
		if (!$rs) {
			echo "DataBase.executeQuery: No se pudo ejecutar la consulta (".mysql_error().")";
			exit();
		}
		return $rs;
	}
	
	function getObject($query) {
		$rs = $this->executeQuery($query);
		if ($row = mysql_fetch_array($rs)) {
			return $row[0];
		}
		return NULL;
	}
	
	function close() {
		mysql_close($this->cx);
	}

}
?>
