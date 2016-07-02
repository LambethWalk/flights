#!/bin/bash

#scan for SSID names and write to file
iwlist wlan0 scan | grep SSID | cut -d\" -f2 > /var/www/html/networks.txt

