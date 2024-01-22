FROM php:8.3-fpm-alpine

# Install necessary dependencies
RUN apk add --no-cache $PHPIZE_DEPS \
    && apk add --no-cache autoconf \
    && apk add --no-cache linux-headers

# Install xdebug
RUN pecl install xdebug

# Enable xdebug module
RUN docker-php-ext-enable xdebug

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy xdebug configurations
COPY ./php/90-xdebug.ini "${PHP_INI_DIR}/conf.d/"

# Additional PHP-FPM configurations
ADD ./php/www.conf /usr/local/etc/php-fpm.d/www.conf

# Create laravel group and user
RUN addgroup -g 1000 laravel && adduser -G laravel -g laravel -s /bin/sh -D laravel

# Create directory and set permissions
RUN mkdir -p /var/www/html
ADD ./src/ /var/www/html
RUN chmod -R 777 /var/www/html/storage \
    && chmod -R 777 /var/www/html/bootstrap/cache

# Install additional PHP extensions
RUN docker-php-ext-install pdo pdo_mysql

# Run permission to user laravel
RUN chown -R laravel:laravel /var/www/html
