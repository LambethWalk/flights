<?php
$querystring = $_GET['loc'];

//exec('export DISPLAY=:0', $output, $ret);
//var_dump($output);
//echo ('export: ' . $ret . '<br/>');


// remove X11 access control
//exec('DISPLAY=:0 sudo /usr/bin/xhost + 2>&1', $output, $ret);
//var_dump($output);
//echo ('xhost: ' . $ret . '<br/>');

//disbale touch screen so that user can't click links (no way to go back)
exec('DISPLAY=:0 sudo /usr/bin/xinput disable 6 2>&1', $output, $ret);
exec("echo $(date) ' | flights.php Line 16 | xinput disable: " . $output . $ret . "' >> log");
//var_dump($output);
//echo ('xinput: ' . $ret . '<br/>');

//remove cursor
//exec('DISPLAY=:0 unclutter -idle 1 & 2>&1', $output, $ret);
//var_dump($output);
//echo ('unclutter: ' . $ret);

//exec('sleep 5');

//go to site
header('Location: https://www.flightradar24.com/' . $querystring);

