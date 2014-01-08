<html>
	<head>
		<title>Session Expired!</title>
	</head>
	<body>
		<p>
			The tv session is expired.
			<?php 
				if (isset($_GET['advice'])){
					echo $_GET['advice'];
				} else {
					echo "Please wait for the next session.";
				}
			?>
			
		</p>
	</body>
</html>

