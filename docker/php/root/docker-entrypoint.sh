#!/bin/bash

cd /var/www/src && composer self-update && composer install

supervisord -n -c /etc/supervisor/supervisord.conf &

php-fpm${PHP_VERSION} -y /etc/php/${PHP_VERSION}/fpm/php-fpm.conf -R -F
