# Use official PHP + Apache image
FROM php:8.2-apache

# Enable Apache rewrite module
RUN a2enmod rewrite

# Install MySQL extension for PHP
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Set working directory inside the container
WORKDIR /var/www/html

# Copy your project files into container
COPY . .

# Set proper permissions (optional, but recommended)
RUN chown -R www-data:www-data /var/www/html

# Expose Apache port
EXPOSE 80

# Start Apache in the foreground
CMD ["apache2-foreground"]
