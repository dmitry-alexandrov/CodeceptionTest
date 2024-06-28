#!/bin/bash

cd /var/www/src && composer self-update && composer install || 'echo composer install command Е*ЕТ МОЗК'

php-fpm${PHP_VERSION} -y /etc/php/${PHP_VERSION}/fpm/php-fpm.conf -R -F
