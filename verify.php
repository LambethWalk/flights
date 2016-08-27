<?php

require_once('is_connected.php');

$ssid = $_GET ['ssid'];
$pass = $_GET ['pass'];

$message = '';
$url = '';

//required in sudoers:
//www-data ALL=(ALL) NOPASSWD: /var/www/html/scripts/scan_ssid.sh, /bin/cp /tmp/wifidata /etc/wpa_supplicant/wpa_supplicant.conf, /sbin/wpa_cli


//make a wpa_supplicant.conf file (replace the whole file, no checks if SSID exists)
$wpa_conf = 'ctrl_interface=DIR=/var/run/wpa_supplicant GROUP=netdev
update_config=1

network={
	ssid="' . $ssid . '"
	psk="' . $pass . '"
}';

//save to temp
exec ( "echo '$wpa_conf' > /tmp/wifidata", $return );
exec('echo $(date) " | verify.php line 26 | wpa temp returned " $return >> log');
//copy from temp to actual location
exec( 'sudo cp /tmp/wifidata /etc/wpa_supplicant/wpa_supplicant.conf',$output, $returnval);
exec('echo $(date) " | verify.php line 29 | wpa save returned " $return >> log');
//var_dump($output);
//exit();

if ($returnval != 0) {
	$message = 'Could not update wifi configuration file. Please try again.';
	$url = '/ssid.php';
}

// reload config
system ( 'sudo wpa_cli reconfigure', $returnval );
exec('echo $(date) " | verify.php line 40 | wpa_cli reconfigure  returned " $return >> log');

// restart interface
exec('sudo ifdown wlan0');
exec('echo $(date) " | verify.php line 44 | ifdown returned " $return >> log');
exec('sleep 2');
exec('sudo ifup wlan0'); 
exec('sleep 10');
exec('echo $(date) " | verify.php line 48 | ifup returned " $return >> log');

// check web connection
if (is_connected('www.google.com')) {
	if (is_connected('www.flightradar24.com')){
		header('Location: http://localhost/geo.php');
	}else{
		$message = 'Could not connect to www.flightradar24.com. Try to open manually or come back later.';
		$url = 'https://www.flightradar24.com/51.48,-0.12/12';
	}
}else{ 
	$message = 'Could not connect to the internet. Try your password again.';
	$url = '/ssid.php';
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title></title>
<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<div>
<p><?= $message ?></p>
<button id="submit" onclick="window.location.href='<?= $url ?>'">Continue</button>
</div>
</body>
