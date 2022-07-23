FROM php:7.4-fpm

RUN pecl install -o -f redis \
&&  rm -rf /tmp/pear \
&&  docker-php-ext-enable redis

RUN apt-get update && apt-get install -y \
        cron \
        curl \
        wget \
        git \
        libfreetype6-dev \
        libonig-dev \
        libpq-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libpng-dev \
        libzip-dev \
    && pecl install mcrypt-1.0.3 \
    && docker-php-ext-install -j$(nproc) iconv mbstring mysqli pdo pdo_mysql zip json \
    && docker-php-ext-install  sockets \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-enable mcrypt \
    && docker-php-ext-enable sockets

# Указываем рабочую директорию для PHP
WORKDIR /var/www

# Copy crontab file to the cron.d directory
#COPY ./crontab /etc/cron.d

# Запускаем контейнер
# Вариант без крона
CMD ["php-fpm"]
# С работающим кроном
#CMD bash -c "cron && php-fpm"