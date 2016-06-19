#!/bin/bash

#Run browser
#With Epiphany
#epiphany http://www.flightradar24.com/51.48,-0.12/12

#Get page for processing
#curl http://www.flightradar24.com/51.48,-0.12/12

#echo this is the script

#With Iceweasel
DISPLAY=:0 iceweasel https://www.flightradar24.com/51.48,-0.12/11

#Let the browser start before F11
DISPLAY=:0 sleep 20

#Emulate F11 for full screen
DISPLAY=:0 xte "key F11" &

