FROM php:8.1-fpm

RUN apt-get update && apt-get install -y nginx zip unzip

# Copy all API files
COPY . /var/www/html/

# Copy Nginx config
COPY default.conf /etc/nginx/conf.d/default.conf

# Set working directory
WORKDIR /var/www/html/

CMD service nginx start && php-fpm
