<?php
	session_start();
	$user = $_POST['r_name'];
	//$password = $_POST['password'];
	
	// ToDo: Check in DB
	$loginCheck = true;
	
	if($loginCheck){
		$_SESSION['r_name'] = $_POST['r_name'];
		header('Location: http://localhost/joinTvSession.php');
	}
?>

<html>
<header><title>Login not successful!</title></header>
<body>
	<h3>The login was not successful.</h3>
	<p> Please try again. <br>
	<a href="../joinTvSession.php">Go back to login page.</a>
	</p>
	
</body>
</html>