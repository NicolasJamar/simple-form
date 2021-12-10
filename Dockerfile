#Install Apache & PHP
FROM php:8.0.13-apache

#Install libraries for PHP
RUN apt-get update && apt-get install -y libxml2-dev libpq-dev && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql
RUN docker-php-ext-install mysqli pdo_mysql pdo_pgsql pgsql session soap

RUN curl -LkSso /usr/bin/mhsendmail 'https://github.com/mailhog/mhsendmail/releases/download/v0.2.0/mhsendmail_linux_amd64'&& \
    chmod 0755 /usr/bin/mhsendmail

#Config PHP
COPY conf/php.ini /usr/local/etc/php/php.ini

#Config Apache
COPY conf/vhost.conf /etc/apache2/sites-available/000-default.conf
COPY conf/apache.conf /etc/apache2/conf-available/z-src.conf
RUN a2enmod rewrite remoteip && \
    a2enconf z-src

#Rights on the env
RUN sed -ri 's/^www-data:x:33:33:/www-data:x:1000:50:/' /etc/passwd