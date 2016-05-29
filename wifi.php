<?php
require_once ('is_connected.php');

// get available network and write to file
// exec ( 'iwlist wlan0 scan | grep SSID | cut -d\" -f2 > networks.txt', $output, $return_var );

// read file into array
$lines = file ( 'networks.txt' );

// no query string variables so this is the first step: make SSID control
if (count ( $_GET ) < 1) {
	foreach ( $lines as $line ) {
		$control .= '<option value="' . rtrim ( $line ) . '">' . $line . '</option>';
	}
	$control = 	'<select name="ssid" onchange="validate(this.value)">' 
				. '<option value="">Select network</option>' 
				. $control 
				. '</select>';
	$label = "Select a wireless network";
	// TODO: network not found: close browser, use rpi connection then relaunch browser
	// TODO: validation?
	// SSID only passed, so make password control
} elseif (count ( $_GET ) == 1) {
	$control = '<input type="text" name="pass" onkeydown="validate(this.value)" onchange="validate(this.value)"/>';
	$control .= '<input type="hidden" name="ssid" value="' . $_GET ["ssid"] . '"/>';
	$label = "Enter password for the network " . $_GET ["ssid"];
	// TODO: bring up keyboard
	// ssid and password passed, so save network settings
} elseif (count ( $_GET ) == 2) {
	// TODO: close keyboard
	// TODO: run bash script to update wpa_supplicant.
	// Find SSID and update password if exists, or append new network if dosn't
	if (is_connected ()) {
		header ( 'Location: http://localhost/geo.php' );
		exit ();
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
<script type="text/javascript">
function validate(text)
  {
    if (text.length > 1){
      document.getElementById("button").disabled = false;
    }else{
      document.getElementById("button").disabled = true;
    }
  }
</script>
</head>

<body>
	<form action="wifi.php" method="get">
		<div id="label">
			<?= $label?>
		</div>
		<div id="control">
			<?= $control?>
		</div>
		<button id="button" disabled>Select</button>
	</form>
</body>

</html>

<?php
// Deubugging
// exec ( 'DISPLAY=:0 sudo /var/www/html/scripts/editWifi 2 2 2>&1', $output, $return_var );
// var_dump ( $output );
// var_dump ( $return_var );
?>