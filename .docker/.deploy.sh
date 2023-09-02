#!/usr/bin/zsh

echo '------ Starting deploy tasks  ------'

cp .env.example .env
composer install --prefer-dist --no-interaction --no-progress --ansi

yarn install 
yarn build

php artisan migrate:fresh --seed --force

php artisan config:cache
php artisan view:cache
php artisan route:cache

echo '------ Deploy completed ------'