FROM php:8.1-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    cron

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install nodejs and npm
RUN curl -L https://deb.nodesource.com/nsolid_setup_deb.sh | bash -s -- 16
RUN apt-get install nodejs -y

# Set working directory
WORKDIR /var/www

USER root

# Create the log file to be able to run tail
RUN touch /var/log/cron.log

CMD ["php-fpm"]
