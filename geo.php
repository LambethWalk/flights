<?php
//latlang with preferred zoom
$locations = [
		"Select location" => "",
		"London" => "51.51,-0.14/11", 
		"Ostuni" => "40.94,17.41/9",
		"Islamabad" => "34.08,73.32/8"
];

asort($locations);
reset($locations);

$control = '<select name="loc" onchange="validate(this.value);">';

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
	<form action="flights.php" method="get">		
		<div>
			<p>Where are you?</p>
			<?= $control?>
			<button id="button" disabled>Select</button>
		</div>
		
	</form>
</body>

</html>