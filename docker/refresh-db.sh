#!/usr/bin/env bash

sleep 1 &&
php bin/console doctrine:database:create --if-not-exists &&
php bin/console doctrine:schema:update --dump-sql --force --complete &&

exec "$@"