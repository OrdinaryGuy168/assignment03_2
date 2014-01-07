<?php 
require_once 'helper/tv_session_db_helper.php';
session_start();
if(!isset($_SESSION['tvsid'])){
	header('Location: http://localhost/php/twitter/twitterRedirect.php');	
}
	$tv_session_id = $_SESSION['tvsid'];
	$elderly = getUserByTvSession($tv_session_id);
	$tv_show = getTvShowByTvSession($tv_session_id);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Relative Login</title>
</head>
<body>
<?php 
	if(!isSessionRunning($tv_session_id)){ // break if elderly stopped the tv session already
		echo "Unfortunately the TV-Session is not running any more. Please try another time.";
	}elseif(!isset($_SESSION['r_name'])){ // relative is not logged in yet
		echo "Hello. To join the TV Session please login below: </br>";	
		echo "<form action='login/loginRelative.php' method='post'>
				Name: <input type='text' name='r_name' /><br>
				<button>Login</button>
			</form>";
	} else { // everything is fine and the user is logged in
		$relative = $_SESSION['r_name'];
		echo "<h2>Welcome ".$relative."!</h2>";
		echo "<p>".$elderly." is watching ".$tv_show."</br>";
		echo "To join click here: <a href='successfulJoined.php'>join</a>";
		
	}
?>

</body>
</html>