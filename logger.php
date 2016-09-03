<?php

function writeLog($line, $s1, $s2 = "") {

if(is_array($s1)){$s1 = implode(';' , $s1);}
if(is_array($s2)){$s2 = implode(';' , $s2);}

$s1 = preg_replace('/[\r\n]+/','', $s1);
$s2 = preg_replace('/[\r\n]+/','', $s2);

$page = basename($_SERVER['PHP_SELF']); 

$entry = date(DATE_W3C) . " | " . $page . " line " . $line . " | " . $s1 . " " . $s2 . PHP_EOL; 

return file_put_contents("log", $entry, FILE_APPEND);

}
?>

