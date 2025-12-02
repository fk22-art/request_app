FROM php:8.2-apache

# Enable Apache rewrite
RUN a2enmod rewrite

# Copy all project files to Apache root
COPY . /var/www/html/

# Set working directory
WORKDIR /var/www/html/

# Give proper permission
RUN chmod -R 755 /var/www/html
