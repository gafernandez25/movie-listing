FROM ubuntu:20.04

ENV DEBIAN_FRONTEND=nonintercative
ENV TZ=Europe/Berlin

RUN apt-get -y update && apt-get -y upgrade \
	&& \
	apt-get -y install apache2 ufw curl vim git zip unzip openssl mysql-client \
	&& \
	ufw allow 'Apache' \
	&& \
	a2enmod ssl rewrite \
	&& \
	apt install lsb-release ca-certificates apt-transport-https software-properties-common -y \
	&& \
	add-apt-repository ppa:ondrej/php \
	&& \
	apt-get -y update && apt-get -y upgrade \
	&& \
	apt-get install -y php8.1 libapache2-mod-php8.1 php8.1-zip php8.1-common php8.1-cli php8.1-gd php8.1-curl php8.1-mysql php8.1-pgsql php8.1-mbstring php8.1-xml php8.1-mcrypt \
	&& \
	curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
	&& \
	apt-get -y update && apt-get -y upgrade

COPY apache2.conf /etc/apache2/apache2.conf

RUN a2ensite default-ssl.conf

EXPOSE 80 443

CMD apachectl -DFOREGROUND