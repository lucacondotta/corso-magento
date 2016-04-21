FROM php:5.6-apache

ADD conf/corsomagento.conf /etc/apache2/sites-available/corsomagento.conf
ADD conf/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini
ADD index.php /var/www/html/index.php

ENV TERM=xterm
ENV APACHE_LOG_DIR=/var/log/apache2

RUN export TERM=xterm \
    && usermod -u 1000 www-data \
    && echo "\n\nServerName localhost:80" >> /etc/apache2/apache2.conf \
    && mkdir /var/www/corso-magento \
    && apt-get update \
    && apt-get install -y \
                apt-utils \
                git \
                mysql-client \
    # For mcrypt
                libmcrypt-dev \
    # For gd
                libfreetype6-dev \
                libpng12-dev \
                libjpeg62-turbo-dev \
                libxpm-dev \
                libvpx-dev \
    # For soap
                libxml2-dev \
    # Xdebug
                php5-xdebug \
    && cd /var/www \
    && docker-php-ext-install mcrypt \
    && docker-php-ext-configure gd \
       		--with-freetype-dir=/usr/lib/x86_64-linux-gnu/ \
       		--with-png-dir=/usr/lib/x86_64-linux-gnu/ \
       		--with-jpeg-dir=/usr/lib/x86_64-linux-gnu/ \
       		--with-xpm-dir=/usr/lib/x86_64-linux-gnu/ \
       		--with-vpx-dir=/usr/lib/x86_64-linux-gnu/ \
    && docker-php-ext-install gd \
                              soap \
                              mbstring \
                              pdo_mysql \
    && a2enmod rewrite \
    && a2ensite 000-default \
    && a2ensite corsomagento \
    && service apache2 restart

EXPOSE 80
EXPOSE 443
EXPOSE 9000

VOLUME /var/www/corso-magento
