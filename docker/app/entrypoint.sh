#!/bin/sh

mkdir -p var/cache var/log

if [ "$APP_ENV" != 'prod' ]; then
  php composer.phar install --prefer-dist --no-progress --no-interaction
  bin/console assets:install --no-interaction
fi

until bin/console doctrine:query:sql "select 1" >/dev/null 2>&1; do
    (>&2 echo "Waiting for Database to be ready...")
  sleep 1
done

php bin/console doctrine:schema:update --dump-sql --force --complete

exec docker-php-entrypoint "$@"