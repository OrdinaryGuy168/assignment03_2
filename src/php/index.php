<?php
require_once 'helper/tv_session_db_helper.php';
session_start();
if(!isset($_SESSION['user'])){
	$_SESSION['user'] = "Grandma Gerda";
	$_SESSION['tv_show'] = "Wheel of Fortune";
	$_SESSION['tw_consumer_key'] = 'q9IDyo3flVa7wwMlkYA';
	$_SESSION['tw_consumer_secret'] = '86FOv455DXrubOMP6X4PpicLBWY2ho3PMuEsf9nWs0';
	$_SESSION['tw_access_token'] = '2215486428-GogwK1ArKEIRASXGllWeTDGwPGFMiXLg8n6dRXb';
	$_SESSION['tw_access_token_secret'] = 'JlDnkNXIKzBaih60eqpTro8gSWqTO12AkoF5WIow6SAuQ';
	$_SESSION['notificated'] = false;
}
$_SESSION['tv_session_id'] = createTvSession($_SESSION['user'], $_SESSION['tv_show']);
session_write_close();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="ISO-8859-1">
		<title>Main Page</title>
	</head>
	<body>
		<p><?php echo "Hello ".$_SESSION['user'].". You are watching ".$_SESSION['tv_show'].". ".session_id(); ?></p>
		<p><?php echo "The id for this tv_session is: ".$_SESSION['tv_session_id']; ?></p>
		<form action="twitter/generateTweet.php?"<?php echo htmlspecialchars(session_id())?> method="get">
				<button id="twitter-submit-btn">Start tweeting!</button>
		</form>
		<?php if(!$_SESSION['notificated']){
			echo "not ";
		}
			echo "notificated";
		?>
	</body>
</html>