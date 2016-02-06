#!/usr/bin/env bash
set SYMFONY_ENV=loc

php bin/composer install
php con doctrine:schema:update
php con assets:install
php con cache:clear
php bin/codecept build
php bin/codecept run