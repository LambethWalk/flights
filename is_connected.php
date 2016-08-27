<?php
function is_connected($host)
{

//$host = 'www.google.com';

	if (strlen($host) < 5) {throw new Exception('Domain not passed to is_connected');}

	// Local DNS might redirect to a friendly page which also returns 200,
	// so compare the resolved IP to a non-existent domain.
	$ip1 = gethostbyname('idontexist.tld');
	$ip2 = gethostbyname($host);

	if ($ip1 == $ip2){
		exec('echo $(date) " | is_connected.php line 15 | Router returned 200"  >> log');
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
	exec('echo $(date) " | is_connected.php line 28 | Connected=" $is_conn >> log');
	return $is_conn;
}

