FROM php:5.6-apache

ADD conf/corsomagento.conf /etc/apache2/sites-available/corsomagento.conf
ADD index.php /var/www/html/index.php

ENV TERM=xterm
ENV APACHE_LOG_DIR=/var/log/apache2

RUN export TERM=xterm \
    && usermod -u 1000 www-data \
    && echo "\n\nServerName localhost:80" >> /etc/apache2/apache2.conf \
    && mkdir /var/www/corso-magento \
    && apt-get update \
    && apt-get install -y apt-utils \
    && apt-get install -y git \
    && apt-get install -y libmcrypt-dev \
    && apt-get install -y libpng12-dev \
    && apt-get install -y libxml2-dev \
    && apt-get install -y php5-xdebug \
    && cd /var/www \
#    && git clone https://github.com/lucacondotta/corso-magento.git \
    && docker-php-ext-install mcrypt \
    && docker-php-ext-install gd \
    && docker-php-ext-install soap \
    && docker-php-ext-install mbstring \
    && docker-php-ext-install pdo_mysql \
    && a2enmod rewrite \
    && a2ensite 000-default \
    && a2ensite corsomagento \
    && service apache2 restart \
#    && chown -R www-data:www-data /var/www/corso-magento/app/etc \
#    && chown -R www-data:www-data /var/www/corso-magento/media \
#    && chown -R www-data:www-data /var/www/corso-magento/var
