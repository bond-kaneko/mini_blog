FROM php:7.2.4-apache

# Install Hogehoge
RUN apt-get update && \
    apt-get install -y libpq-dev libxml2 libxml2-dev libicu-dev git ssl-cert rsyslog cron vim git gnupg wget

# Install PHP-extentions
RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    && docker-php-ext-install -j$(nproc) iconv \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install pdo_mysql mysqli  mbstring xml pdo intl opcache zip

# Composer
RUN EXPECTED_SIGNATURE="$(wget -q -O - https://composer.github.io/installer.sig)" \
  && php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
  && ACTUAL_SIGNATURE="$(php -r "echo hash_file('sha384', 'composer-setup.php');")" \
  && if [ "$EXPECTED_SIGNATURE" != "$ACTUAL_SIGNATURE" ]; then \
       >&2 echo 'ERROR: Invalid installer signature' \
       rm composer-setup.php \
       exit 1; fi \
  && php composer-setup.php --quiet \
  && RESULT=$? \
  && rm composer-setup.php \
  && mv composer.phar /usr/local/bin/composer

# Set composer environment
ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_HOME /composer
ENV PATH $PATH:/composer/vendor/bin

RUN usermod -u 1000 www-data && groupmod -g 1000 www-data
RUN a2enmod rewrite

EXPOSE 80

