<?php

//disbale touch screen so that user can't click links (no way to go back)
exec('DISPLAY=:0 xinput disable 6');
 
//requires 'export DISPLAY=:0' in /etc/profile
header('Location: https://www.flightradar24.com/51.48,-0.12/11');

//exec('sleep 10');

//using a FF extension instead
//exec('xte "key F11"');

// debugging: note 2>&1 
//exec('DISPLAY=:0 xinput disable 6 2>&1', $output, $return_var);
//var_dump($output);
//var_dump($return_var);

