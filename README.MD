1. `composer install`
2. `cp .env .env.local`
3. `nano .env.local` - edit DATABASE_URL
4. `php bin/console doctrine:database:create`
5. `php bin/console doctrine:schema:update --dump-sql --force --complete`
6. `php bin/console doctrine:fixtures:load --no-interaction`
7. `php bin/console app:add:user email password`
8. `yarn install`
9. `yarn encore production`
10. `nano .env.local` - edit APP_ENV=prod
11. `sudo chmod -R 755 var/cache/prod/vich_uploader/`
12. `mkdir public/projects public/projects/images public/projects/animations`

Admin panel: /admin