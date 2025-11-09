#!/bin/sh

set -e

cd /var/www/html

if [ ! -d vendor ]; then
    echo "vendor отсутствует → запускаю composer install"
    composer install --no-interaction --no-progress --prefer-dist
else
    echo "vendor найден → пропуск установки"
fi

exec php-fpm

