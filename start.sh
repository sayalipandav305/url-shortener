#!/bin/sh
/usr/sbin/php-fpm8.2 -D
nginx -g 'daemon off;'