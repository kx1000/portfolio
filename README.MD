1. `composer install`
2. `php bin/console doctrine:schema:update --dump-sql --force --complete`
3. `php bin/console doctrine:fixtures:load --no-interaction`
3. `php bin/console app:add:user email password`
4. `yarn install`
5. `yarn build prod`