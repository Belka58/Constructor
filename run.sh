#!/bin/bash

docker compose up -d

docker exec constructor-laravel.test-1 php artisan migrate:fresh --seed
docker exec constructor-laravel.test-1 composer i
docker exec constructor-laravel.test-1 npm i
dcoker exec constructor-laravel.test-1 npm run dev
