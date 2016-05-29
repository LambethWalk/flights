<?php
//latlang with preferred zoom
$locations = [
		"London" => "51.51,-0.14/11", 
		"Ostuni" => "40.94,17.41/9",
		"Islamabad" => "34.08,73.32/8"
];

asort($locations);
reset($locations);

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
</head>

<body>
	<form action="flights.php" method="get">		
		<div id="label">

		</div>
		<div id="control">
			<?= $control?>
		</div>
		<button>Select</button>
	</form>
</body>

</html>