FROM php:8.2-fpm-alpine as production

# Useful PHP extension installer image, copy binary into your container
COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/

COPY --from=composer:2.4 /usr/bin/composer /usr/bin/composer

COPY composer.* ./

RUN set -eux; \
    composer install --prefer-dist --no-dev --no-scripts --no-progress --no-interaction; \
    composer clear-cache

COPY . .

RUN set -eux; \
    composer dump-autoload --optimize

RUN chown www-data:www-data storage/json_repository/

FROM production as development

RUN apk update; \
    apk add vim; \
    apk add bash

RUN echo 'alias ll="ls -al"' >> ~/.bashrc

#RUN	mv "$PHP_INI_DIR/php.ini" "$PHP_INI_DIR/php.ini-production"; \
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini";
#    mv "$PHP_INI_DIR/php.dev.ini" "$PHP_INI_DIR/conf.d/";

COPY ./docker/php-fpm/xdebug.ini $PHP_INI_DIR/conf.d/

RUN set -eux; \
    install-php-extensions \
    	xdebug \
    ;

RUN set -eux; \
	composer install --prefer-dist --no-progress --no-interaction