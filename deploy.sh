#!/usr/bin/env bash
set SYMFONY_ENV=loc

php composer update
php bin/console doctrine:schema:update --force --env=loc
rm -rf var/cache/*
php bin/console server:start -q --env=loc
php bin/codeception run
