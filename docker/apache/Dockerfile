FROM php:7.4.5-apache-buster


ARG UID=1000
ARG GID=1000

RUN apt update && apt install -y rsync ssh default-mysql-client vim

RUN mkdir /home/docker \
    && groupadd -r docker -g ${GID} \
    && useradd -u ${UID} -r -g docker -d /home/docker -s /bin/bash -c "Docker user" docker \
    && echo "docker:docker" | chpasswd \
    && chown -R docker:docker /home/docker \
    && mkdir -p /var/www/html/web/wp-content/cache \
    && chmod -R 777 /var/www/html/web/wp-content/cache \
    && a2enmod rewrite deflate

RUN docker-php-ext-install -j$(nproc) mysqli  \
    && docker-php-ext-install -j$(nproc) pdo_mysql

# Install library and gd
RUN apt install -y --no-install-recommends libmagick++-dev libmagickwand-dev libpq-dev libfreetype6-dev libjpeg62-turbo-dev libpng-dev libwebp-dev libxpm-dev
RUN docker-php-ext-configure gd --with-jpeg=/usr/include/ --with-freetype=/usr/include/
RUN docker-php-ext-install gd

# Install wp-cli and composer
RUN curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar \
    && chmod +x wp-cli.phar \
    && mv wp-cli.phar /usr/local/bin/wp

COPY ./docker/apache/ini_files/php.ini /usr/local/etc/php/
COPY ./docker/apache/000-default.conf /etc/apache2/sites-available/000-default.conf

ADD --chown=docker:docker ./wp /var/www/html/web

RUN mkdir -p /var/www/html/web/wp-content/cache
RUN chmod -R 777 /var/www/html/web/wp-content/cache
RUN mkdir -p /var/www/html/web/wp-content/w3tc-config
RUN chmod -R 777 /var/www/html/web/wp-content/w3tc-config
