<?php
session_start();
if(isset($_GET['tvsid'])){
	$_SESSION['tvsid'] = $_GET['tvsid'];
	session_commit();
	header('Location: http://localhost/php/joinTvSession.php');
}
?>
<html>
<head><title>Bad link</title></head>
<body>
<p>Ooops, that sould not happen. Seems like this link is broken. We're sorry! Please never try again to open this link.
</p>
</body>
</html>