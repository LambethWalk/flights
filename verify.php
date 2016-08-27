<?php

require_once('is_connected.php');
require_once("logger.php");

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
exec ( "echo '$wpa_conf' > /tmp/wifidata", $output, $ret );
writeLog(__LINE__, $output, "wpa temp " . $ret);

//copy from temp to actual location
exec("sudo cp /tmp/wifidata /etc/wpa_supplicant/wpa_supplicant.conf", $output, $ret);
writeLog(__LINE__, $output, "wpa write " . $ret);

//var_dump($output);
//exit();

// reload config
exec("sudo wpa_cli reconfigure", $output, $ret);
writeLog(__LINE__, $output, " wpa reconfig " . $ret);

/*
// restart interface
exec("sudo ifdown wlan0", $output, $ret);
writeLog(__LINE__, $output, "ifdown " . $ret);
exec("sleep 2");
exec("sudo ifup wlan0", $output, $ret); 
writeLog(__LINE__, $output, "ifup " . $ret);
*/

exec("sleep 10");

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
