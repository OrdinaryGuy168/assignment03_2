<?php
	require_once 'logger.php';
	require_once 'db_connection.php';
	
	function checkLogin($email, $pwd){
		$mysqli = createMysqliConnection();
		
		if (!($relativeSelect = $mysqli->prepare("SELECT * FROM relative WHERE email = ? AND password = ?"))) {
			logToFile("Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error);
		}
		/* Prepared statement, stage 2: bind and execute */
		if (!$relativeSelect->bind_param("ss", $email, $pwd)) {
			logToFile("Binding parameters failed: (" . $relativeSelect->errno . ") " . $relativeSelect->error);
		}
		
		if (!$relativeSelect->execute()) {
			logToFile("Execute failed: (" . $relativeSelect->errno . ") " . $relativeSelect->error);
		}
		if (!($res = $relativeSelect->get_result())) {
			logToFile("Getting result set failed: (" . $relativeSelect->errno . ") " . $relativeSelect->error);
		}
		logToFile("Number of rows for relative ".$email." and password ".$pwd.": ".$res->num_rows);
		
		return ($res->num_rows == 1);
	}
	
	function getNameByMail($email){
		$mysqli = createMysqliConnection();
		
		if (!($relativeSelect = $mysqli->prepare("SELECT firstname, surname FROM relative WHERE email = ?"))) {
			logToFile("Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error);
		}
		/* Prepared statement, stage 2: bind and execute */
		if (!$relativeSelect->bind_param("s", $email)) {
			logToFile("Binding parameters failed: (" . $relativeSelect->errno . ") " . $relativeSelect->error);
		}
		
		if (!$relativeSelect->execute()) {
			logToFile("Execute failed: (" . $relativeSelect->errno . ") " . $relativeSelect->error);
		}
		if (!($res = $relativeSelect->get_result())) {
			logToFile("Getting result set failed: (" . $relativeSelect->errno . ") " . $relativeSelect->error);
		}
		$name = $res->fetch_row()[0];
		logToFile("Got relative name: ".$name);
		
		return $name;
	}
	
?>