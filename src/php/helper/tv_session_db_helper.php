<?php
	require_once 'logger.php';
	
	function createTvSession($user, $tvShow){
		$id = -1;
		$mysqli = createDBConnection();
		/* Prepared statement, stage 1: prepare */
		if (!($stmt = $mysqli->prepare("INSERT INTO sessions_running (user, tv_show) VALUES (?, ?)"))) {
			logToFile("Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error);
			return $id;
		}
		
		/* Prepared statement, stage 2: bind and execute */
		if (!$stmt->bind_param("ss", $user, $tvShow)) {
			logToFile("Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error);
			return $id;
		}
		
		if (!$stmt->execute()) {
			logToFile("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
			return $id;
		}
		
		if (!($selectId = $mysqli->prepare("SELECT tv_session_id FROM sessions_running WHERE user = ? AND tv_show = ?"))) {
			logToFile("Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error);
			return $id;
		}
		/* Prepared statement, stage 2: bind and execute */
		if (!$selectId->bind_param("ss", $user, $tvShow)) {
			logToFile("Binding parameters failed: (" . $selectId->errno . ") " . $selectId->error);
			return $id;
		}
		
		if (!$selectId->execute()) {
			logToFile("Execute failed: (" . $selectId->errno . ") " . $selectId->error);
			return $id;
		}
		if (!($res = $selectId->get_result())) {
			logToFile("Getting result set failed: (" . $selectId->errno . ") " . $selectId->error);
			return $id;
		}
		$id = $res->fetch_row()[0];
		logToFile("Id is: ".$id);
		$stmt->close();
		
		return $id;
	}
	
	function createTvSessionParticipant($tv_session_id, $r_name){
		$mysqli = createDBConnection();
		/* Prepared statement, stage 1: prepare */
		if (!($stmt = $mysqli->prepare("INSERT INTO session_participants (tv_session_id, relative) VALUES (?, ?)"))) {
			logToFile("Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error);
		}
	
		/* Prepared statement, stage 2: bind and execute */
		if (!$stmt->bind_param("ii", $tv_session_id, $r_name)) {
			logToFile("Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error);
		}
	
		if (!$stmt->execute()) {
			logToFile("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
		}
	
		logToFile("Session participation created. (".$tv_session_id.", ".$r_name.")");
	}
	
	function isSessionRunning($tv_session_id){
		$mysqli = createDBConnection();
		
		if (!($sessionSelect = $mysqli->prepare("SELECT tv_session_id FROM sessions_running WHERE tv_session_id = ?"))) {
			logToFile("Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error);
		}
		/* Prepared statement, stage 2: bind and execute */
		if (!$sessionSelect->bind_param("i", $tv_session_id)) {
			logToFile("Binding parameters failed: (" . $sessionSelect->errno . ") " . $sessionSelect->error);
		}
		
		if (!$sessionSelect->execute()) {
			logToFile("Execute failed: (" . $sessionSelect->errno . ") " . $sessionSelect->error);
		}
		if (!($res = $sessionSelect->get_result())) {
			logToFile("Getting result set failed: (" . $sessionSelect->errno . ") " . $sessionSelect->error);
		}
		logToFile("Number of rows for session_id ".$tv_session_id.": ".$res->num_rows);
		
		return ($res->num_rows != 0);
	}
	
	function getUserByTvSession($tv_session_id){
		if (!isSessionRunning($tv_session_id)) {
			return false;
		}
		$mysqli = createDBConnection();
		
		if (!($userSelect = $mysqli->prepare("SELECT user FROM sessions_running WHERE tv_session_id = ?"))) {
			logToFile("Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error);
			return false;		
		}
		/* Prepared statement, stage 2: bind and execute */
		if (!$userSelect->bind_param("i", $tv_session_id)) {
			logToFile("Binding parameters failed: (" . $userSelect->errno . ") " . $userSelect->error);
			return false;
		}
		
		if (!$userSelect->execute()) {
			logToFile("Execute failed: (" . $userSelect->errno . ") " . $userSelect->error);
			return false;
		}
		if (!($res = $userSelect->get_result())) {
			logToFile("Getting result set failed: (" . $userSelect->errno . ") " . $userSelect->error);
			return false;
		}
		if ($res->num_rows < 1) {
			return false;
		}
		$user = $res->fetch_row()[0];
		logToFile("Found user ".$user);
		
		return $user;
	}
	
	function getTvShowByTvSession($tv_session_id){
		if (!isSessionRunning($tv_session_id)) {
			return false;
		}
		$mysqli = createDBConnection();
	
		if (!($tvShowSelect = $mysqli->prepare("SELECT tv_show FROM sessions_running WHERE tv_session_id = ?"))) {
			logToFile("Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error);
			return false;
		}
		/* Prepared statement, stage 2: bind and execute */
		if (!$tvShowSelect->bind_param("i", $tv_session_id)) {
			logToFile("Binding parameters failed: (" . $tvShowSelect->errno . ") " . $tvShowSelect->error);
			return false;
		}
	
		if (!$tvShowSelect->execute()) {
			logToFile("Execute failed: (" . $tvShowSelect->errno . ") " . $tvShowSelect->error);
			return false;
		}
		if (!($res = $tvShowSelect->get_result())) {
			logToFile("Getting result set failed: (" . $tvShowSelect->errno . ") " . $tvShowSelect->error);
			return false;
		}
		if ($res->num_rows < 1) {
			return false;
		}
		$tv_show = $res->fetch_row()[0];
		logToFile("TV show found: ".$tv_show);
	
		return $tv_show;
	}
	
	function createDBConnection(){
		$mysqli = new mysqli("localhost", "root", "", "sme");
		if ($mysqli->connect_errno) {
			logToFile("Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error);
		}
		logToFile($mysqli->host_info . "\n");
		return $mysqli;
	}
?>