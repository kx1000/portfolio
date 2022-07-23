#!/usr/bin/env bash

sleep 1 &&
php bin/console doctrine:database:create --if-not-exists &&
php bin/console doctrine:schema:update --dump-sql --force --complete &&
php bin/console doctrine:fixtures:load --no-interaction

exec "$@"