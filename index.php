<?php
require_once('is_connected.php');
//echo is_connected();
if (is_connected()){

        header('Location: http://localhost/geo.php');
        exit();
}

else{

        header('Location: http://localhost/wifi.php');
        exit();
}
