FROM php:8.2-fpm

# Copy composer.lock and composer.json
#COPY composer.lock composer.json /var/www/

# Set working directory
WORKDIR /var/www

# Install dependencies
RUN apt update && apt upgrade -y
RUN apt install -y libpq-dev

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install extensions
RUN docker-php-ext-install pdo
RUN docker-php-ext-install pdo_pgsql

RUN pecl install xdebug && docker-php-ext-enable xdebug

# Add user for laravel application
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

# Copy existing application directory contents
#COPY . /var/www

# Copy existing application directory permissions
COPY --chown=www:www . /var/www

COPY docker-php-ext-xdebug.ini /usr/local/etc/php/conf.d/

# Change current user to www
USER www

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
