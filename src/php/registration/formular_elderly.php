<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8" />
<title>Register Elderly</title>
</head>
<body>

<?PHP
require_once '../helper/db_connection.php';

$sendung = isset ( $_POST ["sendung"] ) ? $_POST ["sendung"] : "";

// Register Form
$formular = "<h2>Elderly Registration </h2>
<hr>
<form action='formular_elderly.php' method='post'>
	<table border='0'>
	<colgroup>
		<col width='5%'>
		<col width='40%'>
		<col width='55%'>
	</colgroup>
	<tr>
		<td>First Name:</td>
		<td><input type='text' name='firstname' size='45' required maxlength='45'></td>
	</tr>
	<tr>
		<td>Surname:</td>
		<td><input type='text' name='surname' size='45' required maxlength='45'></td>
	</tr>
	<tr>
		<td>E-Mail:</td>
		<td><input type='email' name='email' size='45' required maxlength='45'></td>
	</tr>
	<tr>
		<td>Password:</td>
		<td><input type='password' name='pwd' required maxlength='10'></td>
	</tr>
	<tr>
		<td>Password Confirm:</td>
		<td><input type='password' name='pwd2' required maxlength='10'></td>
	</tr>
	<tr>
		<td>Publication:</td>
		<td><input type='checkbox' name='boolemail' value='1'> E-Mail<br><input type='checkbox' name='booltwitter' value='1'> Twitter </td>
	</tr>
	</table>
	<hr>
	<input type='submit' value=' Register '>
	<input type='reset' value=' Reset '>
</form>";

if(isset($_POST['pwd'])){
	if (($_POST ['pwd']) != ($_POST ['pwd2'])) {
		echo "<script type='text/javascript'>alert('Passwords are not similar!')</script>" . $formular;
	} else {
		// Validate if post is executed
		if ($_SERVER ["REQUEST_METHOD"] == "POST" && $_POST ['pwd'] == $_POST ['pwd2']) {
			$conn = createDBConnection ();
			
			$email = $_POST ['email'];
			$firstname = $_POST ['firstname'];
			$surname = $_POST ['surname'];
			$password = $_POST ['pwd'];
			$boolemail = 0;
			if (isset ( $_POST ['boolemail'] )) {
				$boolemail = 1;
			}
			$booltwitter = 0;
			if (isset ( $_POST ['booltwitter'] )) {
				$booltwitter = 1;
			}
			
			$insert = "INSERT INTO elderly
		(email, password, firstname, surname, boolemail, booltwitter)
		VALUES
		('$email','$password', '$firstname' , '$surname', '$boolemail', '$booltwitter')";
			$eintragen = mysql_query ( $insert, $conn );
			
			// Validation
			if (mysql_errno ( $conn ) == 1062) {
				echo "<script type='text/javascript'>alert('User already exists!')</script>" . $formular;
			} else {
				echo "<h2> Successful Registration</h2><hr>Thank You $_POST[firstname] $_POST[surname] for Registering at Our Service!";
			}
		} else {
			// Initial Formular
			echo $formular;
		}
	}
} else {
echo $formular;
}

?>

</body>
</html>
