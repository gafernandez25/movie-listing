FROM php:8.2-fpm as development

RUN apt-get -y update && apt-get -y upgrade \
	&& \
	apt-get -y install curl vim git zip unzip openssl openssh-server \
    && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && \
    apt-get -y update && apt-get -y upgrade