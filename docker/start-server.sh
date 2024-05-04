#!/usr/bin/env bash

# Root based on Dockerfile WORKDIR
# if [ ! -d vendor ]; then
#     echo "Running composer install..."
#     gosu soketi composer install
# fi

echo "Starting php-fpm..."
exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
