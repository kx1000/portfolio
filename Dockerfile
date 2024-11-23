# Stage 1: Build the Symfony application and JS assets
FROM node:18-alpine as nodejs

WORKDIR /app

# Install required build tools for Node.js
RUN apk add --no-cache --virtual .build-deps \
    python3 \
    make \
    g++

ENV NODE_OPTIONS=--openssl-legacy-provider
RUN yarn config set python $(which python3)

# Copy package.json and yarn.lock for dependency installation
COPY package.json yarn.lock ./
COPY .env .env.local

# Install Node.js dependencies
RUN yarn install --frozen-lockfile && yarn cache clean

# Copy all files for the build
COPY . .

# Build assets with Webpack Encore
RUN yarn encore production

# Stage 2: PHP application with built assets
FROM php:7.4-apache as app

# Symfony Apache configuration
RUN a2dissite 000-default.conf
RUN a2enmod rewrite
COPY ./docker/symfony.conf /etc/apache2/sites-available
RUN a2ensite symfony.conf

# PHP dependencies
RUN apt-get update \
    && apt-get install -y libzip-dev git \
    && docker-php-ext-install mysqli pdo pdo_mysql zip \
    && docker-php-ext-enable pdo_mysql

WORKDIR /var/www/html/symfony

COPY . .

# Copy Node.js from the first stage
COPY --from=nodejs /usr/local/bin/node /usr/local/bin/node
COPY --from=nodejs /usr/local/lib/node_modules /usr/local/lib/node_modules
COPY --from=nodejs /usr/local/bin/yarn /usr/local/bin/yarn
COPY --from=nodejs /usr/local/bin/yarnpkg /usr/local/bin/yarnpkg
COPY --from=nodejs /app/public/build /var/www/html/symfony/public/build

# Create a symlink for `node` in `/usr/bin`
RUN ln -s /usr/local/bin/node /usr/bin/node

RUN php composer.phar install --no-dev --optimize-autoloader

# Copy Symfony project files
COPY . .

# Expose port and configure entrypoint
EXPOSE 80

COPY docker/app/entrypoint.sh /usr/local/bin/entrypoint
RUN chmod +x /usr/local/bin/entrypoint

ENTRYPOINT ["entrypoint"]

CMD ["apache2-foreground"]
