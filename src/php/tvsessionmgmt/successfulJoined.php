<?php
require_once '../helper/tv_session_db_helper.php';
session_start();
if (!isset($_SESSION['tvsid'])) {
	header("Location: http://localhost/php/tvsessionmgmt/sessionExpired.php");
}
createTvSessionParticipant($_SESSION['tvsid'], $_SESSION['r_email']);
?>
<html>
	<head>
		<title>Success!</title>
	</head>
	<body>
		<p>
			You successfully joined the tv session! <br />
			If you want to leave the session click here: <a href="successfulLeft.php">Leave tv session</a>
			
		</p>
	</body>
</html>