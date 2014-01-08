<?php
	function createDBConnection(){
		$conn = mysql_connect ("localhost", "root", "");
		mysql_select_db("sme");
		if (!$conn) {
			die('Connection Error: ' . mysql_error());
		}
		return $conn;
	}
	
	function createMysqliConnection(){
		$mysqli = new mysqli("localhost", "root", "", "sme");
		if ($mysqli->connect_errno) {
			logToFile("Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error);
		}
		logToFile($mysqli->host_info . "\n");
		return $mysqli;
	}
?>