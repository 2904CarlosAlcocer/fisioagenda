FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    git unzip curl libzip-dev zip nodejs npm \
    && docker-php-ext-install pdo pdo_mysql zip

WORKDIR /app

COPY . .

RUN curl -sS https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer

RUN composer install --no-dev --optimize-autoloader

RUN npm install && npm run build

RUN php artisan config:clear
RUN php artisan cache:clear

EXPOSE 10000

CMD php artisan serve --host=0.0.0.0 --port=10000