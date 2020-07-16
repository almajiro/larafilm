FROM php:7.4-rc-fpm-alpine
LABEL maintainer="Kuroki Almajiro <kuroki@almajiro.net"

ARG APP_UID
ARG APP_GID
ARG APP_DIR="/usr/local/share/larafilm"

RUN apk add libzip-dev libpng-dev jpeg-dev freetype-dev icu-dev unzip && \
    docker-php-ext-install zip pdo_mysql intl iconv mysqli bcmath pcntl && \
    docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/ && \
    docker-php-ext-install -j$(nproc) gd

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN addgroup -g ${APP_GID} app && \
    adduser -s /sbin/nologin -D -u ${APP_UID} -G app app

RUN sed -i -e "s/www-data/app/" /usr/local/etc/php-fpm.d/www.conf

RUN mkdir -p ${APP_DIR} && chown app:app ${APP_DIR}

USER ${APP_UID}
WORKDIR ${APP_DIR}
