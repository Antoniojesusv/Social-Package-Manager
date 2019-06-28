FROM php:7.2-fpm

# # Copy composer.lock and composer.json
# COPY composer.json /var/www/

# Copy existing application directory contents
COPY . /var/www

# Set working directory
WORKDIR /var/www

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    mysql-client \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    nano \
    libxml2-dev

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install extensions
RUN docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl tokenizer xml ctype json bcmath
RUN docker-php-ext-configure gd --with-gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ --with-png-dir=/usr/include/
RUN docker-php-ext-install gd

# # Install composer
# # RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# RUN chmod +x ./composer.phar
# RUN ./composer.phar install

# # Add user for laravel application
# RUN groupadd -g 1002 www
# RUN useradd -u 1002 -ms /bin/bash -g www www

# # Copy existing application directory permissions
# COPY --chown=www:www . /var/www

# # Change current user to www
# USER www

RUN chmod -R 775 ./.env

# Expose port 9000 and start php-fpm server
EXPOSE 9000

ENTRYPOINT [ "./docker/php/docker-entrypoint.sh" ]
