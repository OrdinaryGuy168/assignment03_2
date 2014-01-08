<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8" />
        <title>Connection between Elderly and Relative </title>
    </head>
<body>


<?PHP
require_once '../helper/db_connection.php';

$conn = createDBConnection();

$emailrelative = $_POST['emailrelative'];
$emailelderly = $_POST['emailelderly'];

//print_r("Elderly: ".$emailelderly . " Relative: ". $emailrelative );

$insert = "SELECT (email)
FROM elderly
WHERE email='$emailelderly'";
$result = mysql_query($insert);
$res = mysql_num_rows($result);

if($res != 1)
   {
   echo "<h2> Error! die Person existiert nicht!";
   }
else
   {
	$insert = "insert into elderly_has_relative
	(emailelderly, emailrelative)
	VALUES
	('$emailelderly', '$emailrelative' )";
	$result = mysql_query($insert);
   echo "<h2>Successfully Done</h2> Your E-Mail-Address (".$emailrelative.") is successfully conntected to the following address: ". $emailelderly;
   }
?>
 

</body>
</html>