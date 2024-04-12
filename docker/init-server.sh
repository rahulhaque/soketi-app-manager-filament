#!/usr/bin/env bash

# appDir="/var/www/html/soketi-app-manager-filament"
appDir="./"
cd $appDir

if [ ! -d docker/config ]; then
mkdir -p docker/config
fi

if [ ! -f .env ]; then
cp .env.docker.example docker/config/.env
ln -fs docker/config/.env .env
fi

if [ ! -f soketi.docker.json ]; then
cp soketi.docker.json.example docker/config/soketi.docker.json
ln -fs docker/config/soketi.docker.json soketi.docker.json
fi

if [ ! -f docker/config/defaultUsers.json ]; then
cp defaultUsers.example.json docker/config/defaultUsers.json
fi

if [ ! -f docker/config/INITIALIZED ]; then
composer install

php artisan key:generate -q

php artisan migrate:fresh -q

php artisan db:seed --class=UserSeeder -q

touch docker/config/INITIALIZED
fi
