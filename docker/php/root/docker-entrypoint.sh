#!/bin/bash

cd /var/www/src && composer self-update && composer install || 'echo composer install command Е*ЕТ МОЗК'

php-fpm8.3 -R -F
