<?php
	session_start();
	if (isset($_SESSION['r_name'])) {
		unset($_SESSION['r_name']);
	}
	header("Location: ".$_SERVER['HTTP_REFERER']);
?>