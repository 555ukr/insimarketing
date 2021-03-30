FROM php:7.3-fpm
RUN apt-get update -y && apt-get install -y libmcrypt-dev openssl \
    && pecl install mcrypt-1.0.2 \
    && docker-php-ext-enable mcrypt
# RUN pecl install mcrypt-1.0.3
# RUN docker-php-ext-enable mcrypt
RUN docker-php-ext-install pdo mbstring
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN docker-php-ext-install pdo mbstring
RUN docker-php-ext-install mysqli pdo pdo_mysql
WORKDIR /app
COPY . /app
RUN composer install

CMD php artisan serve --host=0.0.0.0 --port=8000
EXPOSE 8000