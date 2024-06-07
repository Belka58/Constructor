#!/bin/bash

docker compose up -d

docker exec constructor-laravel.test-1 php artisan migrate:fresh --seed
