# Installation
1. `composer install`
2. `cp .env .env.local`
3. `nano .env.local` - edit DATABASE_URL
4. `php bin/console doctrine:database:create`
5. `php bin/console doctrine:schema:update --dump-sql --force --complete`
6. `php bin/console doctrine:fixtures:load --no-interaction`
7. `php bin/console app:add:user email password`
8. `yarn install`
9. `yarn encore production`
10. `php bin/console assets:install`
11. `nano .env.local` - edit APP_ENV=prod
12. `mkdir public/projects public/projects/images public/projects/animations public/files`
13. `sudo chown -R www-data public/files public/projects/images public/projects/animations var/cache/prod/vich_uploader`

Admin panel: /admin

# Tests
1. `cp .env.test .env.test.local`
2. `nano .env.test.local` - edit DATABASE_URL
3. `php bin/console doctrine:database:create --env=test`
5. `php bin/console doctrine:schema:update --dump-sql --force --complete --env=test`
6. `php bin/console doctrine:fixtures:load --no-interaction --env=test`
7. `php vendor/bin/codecept run`