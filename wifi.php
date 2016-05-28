<?php

require_once('is_connected.php');

// get available network and write to file
//exec ( 'iwlist wlan0 scan | grep SSID | cut -d\" -f2 > networks.txt', $output, $return_var );

// read file into array
$lines = file ( 'networks.txt' );

// no query string variables so this is the first step: make SSID control 
if (count($_GET) < 1){
		foreach ( $lines as $line ) {
			$control .= '<option value="' . rtrim($line) . '">' . $line . '</option>';
		}
		$control = '<select name="ssid">' . $control . '</select>';			
		$label = "Select a wireless network";
// SSID only passed, so make password control
} elseif (count($_GET) == 1) {
		$control = '<input type="text" name="pass"/>';
		$control .= '<input type="hidden" name="ssid" value="' . $_GET["ssid"] . '"/>';
		$label = "Enter password for the network " . $_GET["ssid"];
		//TODO: bring up keyboard 
// ssid and password passed, so save network settings
} elseif (count($_GET) == 2) {
		//TODO: close keyboard
		//TODO: save to wpa_supplicant.conf and sleep with animation
		if (is_connected()) {
			header('Location: http://localhost/geo.php');
        exit();
		} else {
			$control = "";
			$label = "Error message";
		}
		 
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title></title>
</head>

<body>
	<form action="wifi.php" method="get">		
		<div id="label">
			<?= $label ?>
		</div>
		<div id="control">
			<?= $control?>
		</div>
		<button>Select</button>
	</form>
</body>

</html>

<?php
// Deubugging
//exec ( 'DISPLAY=:0 sudo /var/www/html/scripts/editWifi 2 2 2>&1', $output, $return_var );
//var_dump ( $output );
//var_dump ( $return_var );
?>