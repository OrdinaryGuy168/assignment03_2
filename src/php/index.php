<?php
session_start();
if(!isset($_SESSION['user'])){
	$_SESSION['user'] = "TestUser";
	$_SESSION['tv_show'] = "TV Show";
	$_SESSION['tw_consumer_key'] = 'q9IDyo3flVa7wwMlkYA';
	$_SESSION['tw_consumer_secret'] = '86FOv455DXrubOMP6X4PpicLBWY2ho3PMuEsf9nWs0';
	$_SESSION['tw_access_token'] = '2215486428-GogwK1ArKEIRASXGllWeTDGwPGFMiXLg8n6dRXb';
	$_SESSION['tw_access_token_secret'] = 'JlDnkNXIKzBaih60eqpTro8gSWqTO12AkoF5WIow6SAuQ';
	$_SESSION['notificated'] = false;
}
session_write_close();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="ISO-8859-1">
		<title>Relative Login</title>
	</head>
	<body>
		<a href="session_test.php">Session Test</a>
		<p><?php echo "Hello ".$_SESSION['user'].". You are watching ".$_SESSION['tv_show'].". ".session_id(); ?></p>
		<form action="NotificationScript.php?"<?php echo htmlspecialchars(session_id())?> method="get">
				<button id="twitter-submit-btn">Start tweeting!</button>
		</form>
		<?php if($_SESSION['notificated']){
			echo "notificated";
		} else {
			echo "<span style='color=red'>not notificated</span>";
			}
		?>
	</body>
</html>