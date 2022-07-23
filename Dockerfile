FROM php:7.4-apache as app

# Symfony Apache configuration
RUN a2dissite 000-default.conf
RUN a2enmod rewrite
COPY ./docker/symfony.conf /etc/apache2/sites-available
RUN a2ensite symfony.conf

# PHP dependecies
RUN apt-get update
RUN apt-get install -y libzip-dev git
RUN docker-php-ext-install mysqli pdo pdo_mysql zip && docker-php-ext-enable pdo_mysql

WORKDIR /var/www/html/symfony

COPY . .

RUN php composer.phar install

# copy only specifically what we need
COPY .env ./
COPY bin bin/
COPY config config/
COPY public public/
COPY src src/
COPY templates templates/
COPY translations translations/
COPY composer.phar ./

EXPOSE 80

COPY docker/app/entrypoint.sh /usr/local/bin/entrypoint
RUN chmod +x /usr/local/bin/entrypoint

ENTRYPOINT ["entrypoint"]

CMD ["apache2-foreground"]

FROM node:14-alpine as nodejs

WORKDIR /var/www/html/symfony

RUN apk add --no-cache --virtual .gyp \
        python3 \
        make \
        g++ \
    && apk del .gyp \
    ;

# prevent the reinstallation of vendors at every changes in the source code
COPY package.json yarn.lock ./
RUN set -eux; \
	yarn install; \
	yarn cache clean \
    ;

COPY docker/nodejs/entrypoint.sh /usr/local/bin/entrypoint
RUN chmod +x /usr/local/bin/entrypoint

ENTRYPOINT ["entrypoint"]

CMD ["yarn", "encore", "dev-server", "--host=0.0.0.0"]