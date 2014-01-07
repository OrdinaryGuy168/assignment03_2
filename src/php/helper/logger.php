<?php

function logToFile($msg) {
	$fd = fopen($_SERVER['DOCUMENT_ROOT']."/../logs/log.txt", "a");
	$str = "[" . date("Y/m/d h:i:s", mktime()) . "] " . $msg;
	fwrite($fd, $str . "\n");
	fclose($fd);
}
?>