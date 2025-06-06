FROM php:8.3-rc-fpm

RUN apt-get update && apt-get install -y \
  unzip \
  git \
  curl \
  libzip-dev \
  default-mysql-client \
  && docker-php-ext-install mysqli pdo pdo_mysql \
  && rm -rf /var/lib/apt/lists/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

