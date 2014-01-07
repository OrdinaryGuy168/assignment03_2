<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8" />
        <title>Login</title>
    </head>
<body>

<h2>Login </h2>
<hr>
<form action="menu.php" method="post">
	<table border="0">
	<colgroup>
		<col width="20%">
		<col width="25%">
		<col width="55%">
	</colgroup>
	<tr>
		<td>Username (E-Mail):</td>
		<td><input type="text" name="username" required size ="35" maxlength="45"></td>
	</tr>
	<tr>
		<td>Password:</td>
		<td><input type="password" name="password" required size ="35" maxlength="45"></td>
	</tr>
	<tr>
		<td></td>
		<td>   <p> <input type="radio" name="person" value="elderly"> Elderly     <input type="radio" name="person" value="relative" > Relative </p></td>
	</tr>
	<tr>
		<td><a href ="formular.php">Register as Elderly</a></td>
		<td><a href ="formular_relative.php">Register as Relative</a></td>
	</tr>
	</table>
	<hr>
	<input type="submit" value=" Login ">
	<input type="reset" value=" Reset ">
</form>   


</body>
</html>