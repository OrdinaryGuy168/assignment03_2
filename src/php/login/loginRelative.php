<?php
	require_once '../helper/relative_db_helper.php';
	session_start();
	$email = $_POST['r_email'];
	$password = $_POST['pwd'];
	
	$loginCheck = checkLogin($email, $password);
	
	if($loginCheck){
		$_SESSION['r_email'] = $email;
		$_SESSION['r_name'] = getNameByMail($email);
		header('Location: '.$_SERVER['HTTP_REFERER']);
	}
?>

<html>
<header><title>Login not successful!</title></header>
<body>
	<h3>The login was not successful.</h3>
	<p> Please try again. <br>
	<a href="../tvsessionmgmt/joinTvSession.php">Go back to login page.</a>
	</p>
	
</body>
</html>