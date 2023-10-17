FROM php:8.2-fpm-alpine as development

RUN apk update \
    && apk add vim \
    && apk add bash

RUN echo 'alias ll="ls -al"' >> ~/.bashrc

# get composer using multi-stage build
COPY --from=composer:2.4 /usr/bin/composer /usr/bin/composer