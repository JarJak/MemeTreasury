#!/usr/bin/env bash
set SYMFONY_ENV=loc

php composer install
php con doctrine:schema:update --force
rm -rf var/cache/*
php con server:start -q
php codecept run