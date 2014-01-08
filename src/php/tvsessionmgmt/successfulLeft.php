<?php
require_once '../helper/tv_session_db_helper.php';
session_start();
if (!isset($_SESSION['tvsid'])) {
	header('Location: http://localhost/php/tvsessionmgmt/sessionExpired.php');
}
deleteTvSessionParticipant($_SESSION['tvsid'], $_SESSION['r_email']);
session_destroy();
?>
<html>
	<head>
		<title>Success!</title>
	</head>
	<body>
		<p>
			You successfully left the tv session!
			
		</p>
	</body>
</html>