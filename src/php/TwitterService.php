<?php

define ( 'TW_CONSUMER_KEY', 'q9IDyo3flVa7wwMlkYA' );
define ( 'TW_CONSUMER_SECRET', '86FOv455DXrubOMP6X4PpicLBWY2ho3PMuEsf9nWs0' );
define ( 'TW_ACCESS_TOKEN', '2215486428-GogwK1ArKEIRASXGllWeTDGwPGFMiXLg8n6dRXb' );
define ( 'TW_ACCESS_TOKEN_SECRET', 'JlDnkNXIKzBaih60eqpTro8gSWqTO12AkoF5WIow6SAuQ' );

define ('LOG_FILE', 'log.txt');

function logToFile($filename, $msg) { 
	$fd = fopen($filename, "a");  
	$str = "[" . date("Y/m/d h:i:s", mktime()) . "] " . $msg; 
	fwrite($fd, $str . "\n");
	fclose($fd); 
}

function tweet_post($tweet) {
	if (strlen ( $tweet ) > 140)
		return 'Sorry, tweet can
not be posted. Tweet character length excced its limit.'; // check for maximum tweet character 
	require_once ('twitteroauth/twitteroauth.php');
	// add the tweetOAuth Library 
	$hasPost = true; 
	$tweetOauth = new
	TwitterOAuth ( TW_CONSUMER_KEY, TW_CONSUMER_SECRET, TW_ACCESS_TOKEN, TW_ACCESS_TOKEN_SECRET ); // connect with the OAuth
	
	$tweetOauth->oAuthRequest ( 'https://api.twitter.com/1.1/statuses/update.json', 'POST', array (
			'status' => $tweet 
	) ); // request tweet post with the OAuth connection 
	if($tweetOauth->http_code != 200 ) { // Check if has some error 
	$hasPost = false;
	logToFile(LOG_FILE, 'Received errorcode: '.$tweetOauth->http_code);
	} else {
		logToFile(LOG_FILE, 'Everythings fine with received errorcode.');
	}
	return $hasPost;
} 
tweet_post( 'This is my first tweet post from PHP script' ); // call the function -

?>