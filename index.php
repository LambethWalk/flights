<?php
exec('DISPLAY=:0 xte "key F11"');

require_once('is_connected.php');

$connected = is_connected('www.google.com');

//debug
$connected = FALSE;

if ($connected){
        header('Location: http://localhost/geo.php');
        exit();
}else{
        header('Location: http://localhost/ssid.php?action=' . $action);
        exit();
}
