<?php

require_once("logger.php");

function is_connected($host)
{

$fp = fsockopen("www.google.com", 80, $errno, $errstr, 30);
if (!$fp) {
   writeLog ($errstr, $errno);
   return FALSE;
   }else{
   writeLog("connected");
   return TRUE;
}

/*
	if (strlen($host) < 5) {throw new Exception('Domain not passed to is_connected');}

	// Local DNS might redirect to a friendly page which also returns 200,
	// so compare the resolved IP to a non-existent domain.
	$ip1 = gethostbyname('idontexist.tld');
	$ip2 = gethostbyname($host);

	if ($ip1 == $ip2){
		writeLog("is_connected: ", "Router returned 200");
		return FALSE;
	}

	// Open socket to site
	$connected = @fsockopen($host, 80);

	if ($connected){
       		$is_conn = TRUE;
        	fclose($connected);
	}else{
       		 $is_conn = FALSE;
	}
	writeLog("is connected: ", $is_conn);
	return $is_conn;
*/
}

