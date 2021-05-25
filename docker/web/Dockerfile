FROM php:7.4-apache

# SET MAINTAINER.
MAINTAINER Aleksandar Rakić <aleksandar.rakic@yahoo.com>

# COPY SELF-SIGNED SSL CERTIFICATES.
COPY ./docker/web/certs/server.crt /etc/apache2/ssl/server.crt
COPY ./docker/web/certs/server.key /etc/apache2/ssl/server.key

# COPY CUSTOM APACHE CONFIGURATION.
COPY ./docker/web/config/dev.conf /etc/apache2/sites-enabled/dev.conf

# UPDATE AND INSTALL REQUIRED OS PACKAGES.
RUN apt-get update && apt-get install -y unzip

# INSTALL REQUIRED PHP EXTENSIONS.
RUN docker-php-ext-install pdo \
    pdo_mysql

# INSTALL COMPOSER.
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin/ --filename=composer

# ENABLE REWRITE AND SSL MODE.
RUN a2enmod rewrite ssl

# MAKE PORTS 80 AND 443 AVAILABLE TO THE WORLD OUTSIDE THIS CONTAINER.
EXPOSE 80 443

# SET THE WORKING DIRECTORY IN CONTAINER.
WORKDIR /var/www/html