# Use the official PHP image as the base image
FROM php:8.1-cli

# Set the working directory in the container
WORKDIR /app

# Install system dependencies
RUN apt-get update && apt-get install -y \
    zlib1g-dev \
    libpq-dev \
    libonig-dev \
    libxml2-dev

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql mbstring xml

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy the application files to the container
COPY . /app

# Install project dependencies
RUN composer install

# Set the database connection environment variables
ENV DB_CONNECTION=sqlite
ENV DB_HOST=127.0.0.1
ENV DB_PORT=3306
ENV DB_DATABASE=feeding
ENV DB_USERNAME=root
ENV DB_PASSWORD=

# Expose a port if needed
# EXPOSE 8000

# Run the command
CMD php feed process:feed
