<?php
//latlang with preferred zoom
$locations = [
		"London" => "51.5,-0.08/10",
		"Central London" => "51.5,-0.08/12",
		"St Williams Court" => "51.54,-0.12/13",
		"Islamabad" => "34.08,73.32/8",
		"Kinshasa" => "-4.39,15.44/8"
];


$control = '<select name="loc">';

foreach($locations as $p => $w){
	$control .= '<option value="'. $w .'">' .$p .'</option>';
};

$control .= '</select>';

?>

<!DOCTYPE html>
<html>
<head>
<meta name="referrer" content="no-referrer" /> <!-- Stop 403 from website -->
<meta charset="UTF-8">
<title></title>
<link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body>
	<form action="flights.php" method="get">		
		<div>
			<p>Select location</p>
			<?= $control?>
			<button id="submit" onclick="javascript:document.getElementById('preloader').style.display = '';">Select</button>
		</div>
	</form>
	<div id="preloader" style="display:none; position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 10; background-color: rgba(0,0,0,0.5)">
	<img style="position:relative; top:75%;" src="preloader.gif"/>
	</div>
</body>

</html>
