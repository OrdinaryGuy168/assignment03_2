<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8" />
        <title>Connection between Elderly and Relative </title>
    </head>
<body>


<?PHP
require_once '..\helper\db_connection.php';

$conn = createDBConnection();

$emailrelative = $_POST['emailrelative'];
$emailelderly = $_POST['emailelderly'];
$cr = $_POST['cr'];
//print_r("Elderly: ".$emailelderly . " Relative: ". $emailrelative . " CrWert: ". $cr );

	//prof if the host really exist.
	$insert = "SELECT (email)
	FROM elderly
	WHERE email='$emailelderly'";
	$result = mysql_query($insert);
	$res = mysql_num_rows($result);
	
if($res != 1)
{
   echo "<h2> Error! The Host does not exist!";
}
else
{
	//proof if there is a connection between the to persons
	$insert = "SELECT (emailelderly)
	FROM  elderly_has_relative
	WHERE emailelderly='$emailelderly' AND emailrelative = '$emailrelative'";
	$result = mysql_query($insert);
	$res = mysql_num_rows($result);
	
	if ($cr == 'create')
	{
		//proof if the connection is already there
		$insert = "SELECT (emailelderly)
		FROM  elderly_has_relative
		WHERE emailelderly='$emailelderly' AND emailrelative = '$emailrelative'";
		$result = mysql_query($insert);
		$res = mysql_num_rows($result);
		
		//if there is a connection the number must be 1
		if ($res != 0)
		{
			echo "<h2> Error! There is already a Connection between ". $emailelderly ." and " . $emailrelative ."!";
		}
		
		//otherwise we can create the connection
		else
		{
			$insert = "insert into elderly_has_relative
			(emailelderly, emailrelative)
			VALUES
			('$emailelderly', '$emailrelative' )";
			$result = mysql_query($insert);
			echo "<h2>Successfully Done</h2> Your E-Mail-Address (".$emailrelative.") is successfully conntected to the following host address: ". $emailelderly;
		}
	}
	elseif ($cr == 'delete')
	{	 

		
		//if there is a connection the number must be 1
		if ($res != 1)
		{
			echo "<h2> Error! There is no  Connection to delete beetween ". $emailelderly ." and " . $emailrelative ."!";
		}
		
		//delete the connection
		$insert = "delete FROM elderly_has_relative
		WHERE
		emailelderly = '$emailelderly' AND emailrelative = '$emailrelative'";
		$result = mysql_query($insert);

		echo "<h2>Successfully Done</h2> The Connection between your E-Mail-Address (".$emailrelative.") and the Host-Address (". $emailelderly . ") is successfully deleted.";
	}

} 

?>
</body>
</html>