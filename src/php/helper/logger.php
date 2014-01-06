<?php

function logToFile($msg) {
	$fd = fopen("log.txt", "a");
	$str = "[" . date("Y/m/d h:i:s", mktime()) . "] " . $msg;
	fwrite($fd, $str . "\n");
	fclose($fd);
}
?>