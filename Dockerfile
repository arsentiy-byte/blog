FROM php:8.3-fpm-alpine

WORKDIR /app

RUN addgroup -g 1000 -S app && \
    adduser -u 1000 -S app -G app

RUN apk add --update \
    autoconf \
    build-base \
    git \
    postgresql-dev \
    linux-headers

RUN docker-php-ext-install pdo pdo_pgsql && \
    pecl install apcu-5.1.23 && \
    docker-php-ext-enable apcu opcache && \
    pecl install xdebug-3.3.2 && \
    docker-php-ext-enable xdebug

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

COPY ./ /app
COPY ./entrypoint.sh /usr/local/bin/entrypoint
RUN chmod +x /usr/local/bin/entrypoint

EXPOSE 9000
ENTRYPOINT ["/usr/local/bin/entrypoint"]
