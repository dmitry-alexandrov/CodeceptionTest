FROM ubuntu:latest

ARG PHP_VERSION='8.3'
ENV PHP_VERSION=${PHP_VERSION}

RUN apt-get update && apt-get install ${APT_INSTALL_OPTIONS} \
#    build-essential \
    software-properties-common \
    apt-transport-https \
    less \
    bc \
    iputils-ping \
    iproute2 \
    vim \
    curl \
    ncdu \
    lsof \
    wget \
    htop \
    binutils \
    supervisor \
    git \
    php-yaml -y \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

RUN dpkg -l | grep php | tee packages.txt
RUN add-apt-repository ppa:ondrej/php -y
RUN apt update
RUN apt install php${PHP_VERSION} \
	php${PHP_VERSION}-cli \
	php${PHP_VERSION}-bz2 \
	php${PHP_VERSION}-curl \
	php${PHP_VERSION}-mbstring \
	php${PHP_VERSION}-intl \
	php${PHP_VERSION}-xml \
	php${PHP_VERSION}-zip \
	-y
RUN apt install php${PHP_VERSION}-fpm

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
	&& php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
	&& php -r "unlink('composer-setup.php');"
RUN composer config --global --auth github-oauth.github.com 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

COPY ./docker/php/root /
RUN chmod +x /docker-entrypoint.sh && mkdir -p /var/www && mkdir -p /run/php

WORKDIR /var/www/src

ENTRYPOINT ["/docker-entrypoint.sh"]