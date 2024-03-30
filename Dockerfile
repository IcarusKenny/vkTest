FROM php:8.1-apache

RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    vim \
    nano

RUN docker-php-ext-install \
    mysqli \
    pdo_mysql

RUN pecl install xdebug && docker-php-ext-enable xdebug
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY ./apache/000-default.conf /etc/apache2/sites-available/000-default.conf

RUN a2enmod rewrite
