<?php
$ssid = $_GET ['ssid'];
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

<!-- Keyboard: jQuery & jQuery UI + theme (required) -->
<link href="Keyboard-master/docs/css/jquery-ui.min.css" rel="stylesheet">
<script src="Keyboard-master/docs/js/jquery-latest.min.js"
	type="text/javascript"></script>
<script src="Keyboard-master/docs/js/jquery-ui.min.js"
	type="text/javascript"></script>
<script src="Keyboard-master/docs/js/bootstrap.min.js"
	type="text/javascript"></script>

<!-- keyboard widget css & script (required) -->
<link href="Keyboard-master/css/keyboard.css" rel="stylesheet">
<script src="Keyboard-master/js/jquery.keyboard.js"
	type="text/javascript"></script>

<!-- initialize keyboard (required) -->
<script type="text/javascript">
	$(function(){
		$('#keyboard').keyboard();
	});
</script>

</head>

<body>
	<form action="verify.php" method="get">
		<div>
			<p>Password for <?= $ssid?></p>
			<div id="wrap">
				<!-- wrapper only needed to center the input -->

				<!-- keyboard input -->
				<input id="keyboard" type="text" onchange="validate(this.value);">
				<button id="submit" disabled>Select</button>

			</div>
			<!-- End wrapper -->

		</div>
	</form>
</body>

</html>
