<?php
function is_connected()
{
    $connected = @fsockopen("www.google.com", 80);
    if ($connected){
        $is_conn = TRUE;
        fclose($connected);
    }else{
        $is_conn = FALSE;
    }
    return $is_conn;
}