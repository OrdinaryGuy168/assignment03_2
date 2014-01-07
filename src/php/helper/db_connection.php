<?php
	function createDBConnection(){
		$conn = mysql_connect ("localhost", "sme", "sme");
		mysql_select_db("sme");
		if (!$conn) {
			die('Connection Error: ' . mysql_error());
		}
		return $conn;
	}
?>