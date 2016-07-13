<?php

// get available networks and write to file
exec('sudo /var/www/html/scripts/scan_ssid.sh', $output);

//var_dump($output);

//exit();

// read file into array
$lines = file ( 'networks.txt' );
//var_dump($lines);
//exit();

// create SSID menu
$control = '';

foreach ( $lines as $line ) {
		$control .= '<option value="' . rtrim ( $line ) . '">' . $line . '</option>';
		}

$control = 	'<select name="ssid" onchange="validate(this.value);">'
		. '<option value="">Select network</option>'
		. $control
		. '</select>'
		. '<button id="submit" disabled>Select</button>';

$label = 	'Hi David, which wifi network?';

// if no lines, no networks found so junk the control
if (count($lines) < 1){
	$control = NULL;
	$label = 'Hmmm, can\'t find wifi networks. Unplug and try a different location.';
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
      document.getElementById("submit").disabled = false;
    }else{
      document.getElementById("submit").disabled = true;
    }
  }
</script>
</head>

<body>
	<form action="pass.php" method="get">
	<div>
		<p><?= $label?></p>
		<?= $control?>
	</div>
	</form>
</body>

</html>
