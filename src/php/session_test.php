<?php
session_start();
echo "Content of session-variable: </br>";
foreach ($_SESSION as $value){
	echo $value;
}
?>