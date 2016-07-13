<?php
require_once ('is_connected.php');

// get available network and write to file
exec ( '/var/www/html/scripts/scan_ssid.sh');

// read file into array
$lines = file ( 'networks.txt' );

// get query string variables
$qsnum = count ( $_GET );

$control = '';

switch ($qsnum) {
	case 0: // no query string variables so this is the first step: make SSID control
		foreach ( $lines as $line ) {
			$control .= '<option value="' . rtrim ( $line ) . '">' . $line . '</option>';
		}
		$control = 	'<select name="ssid" onchange="validate(this.value);">'
				. '<option value="">Select network</option>' // Add empty initial option
				. $control
				. '</select>';
		$label = "Select a wireless network";
		// TODO: network not found: close browser, use rpi connection then relaunch browser
		// TODO: validation?
		break;
	case 1: // SSID only passed, so make password control
		$control = '<input type="text" name="pass" onkeydown="validate(this.value)" onchange="validate(this.value)"/>';
		$control .= '<input type="hidden" name="ssid" value="' . $_GET ["ssid"] . '"/>';
		$label = "Enter password for the network " . $_GET ["ssid"];
		//bring up keyboard, but not under www-data
		exec('DISPLAY=:0 /usr/bin/matchbox-keyboard & 2>&1', $output, $return_var);
		var_dump ( $output );
		var_dump ( $return_var );
		break;
	case 2: // ssid and password passed, so save network settings
		// close keyboard
		exec('killall matchbox-keyboard');
		// go to connection page
		$qs = 'ssid=' . urlencode($_GET["ssid"]) . '&pass=' . urlencode($_GET["pass"]);
		header('Location: http://localhost/connect.php?' . $qs);
		break;
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title></title>
<link rel="stylesheet" type="text/css" href="styles.css">
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
	<div>
		<p><?= $label?></p>
		<?= $control?>
		<button id="button" disabled>Select</button>
	</div>
	</form>
</body>

</html>

<?php
// Deubugging
// exec ( 'DISPLAY=:0 sudo /var/www/html/scripts/editWifi 2 2 2>&1', $output, $return_var );
?>
