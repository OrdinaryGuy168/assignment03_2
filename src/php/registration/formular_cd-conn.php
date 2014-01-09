<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8" />
        <title>Create / Delete a Connection to a Host</title>
    </head>
<body>

<h2>Create / Delete a Connection to a Host</h2>
<hr>
<form action="formular_relative-conn.php" method="post">
	<table border="0">
	<colgroup>
		<col width='5%'>
		<col width='40%'>
		<col width='55%'>
	</colgroup>
	<tr>
		<td>Host (E-Mail):</td>
		<td><input type="text" name="emailelderly" required size ="35" maxlength="45"></td>
	</tr>
	<tr>
		<td>Relative (E-Mail):</td>
		<td><input type="text" name="emailrelative" required size ="35" maxlength="45"></td>
	</tr>
	<tr>
		<td></td>
		<td>   <p> <input type="radio" name="cr" value="create" checked> Connect Myself to the Host <br>     <input type="radio" name="cr" value="delete" > Delete Myself from the Host </p></td>
	</tr>
	</table>
	<hr>
	<input type="submit" value=" Connect ">
	<input type="reset" value=" Reset ">
</form>   


</body>
</html>