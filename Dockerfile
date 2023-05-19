FROM alpine:3.15

ARG uid=1000
ARG gid=1000

RUN adduser -D -u $uid -g $gid -s /bin/sh www && \
    mkdir -p /var/www/html && \
    chown -R www:www /var/www/html

RUN apk --no-cache add nginx \ 
        ca-certificates \
        # openrc \    
        git \
        curl \
        openssh \
        sqlite \
        supervisor \
        php8 \
        php8-fpm \
        php8-apcu \
        php8-bcmath \
        php8-bz2 \
        php8-cgi \
        php8-ctype \
        php8-curl \
        php8-dom \
        php8-ftp \
        php8-gd \
        php8-iconv \
        php8-json \
        php8-mbstring \
        php8-pecl-oauth \
        php8-opcache \
        php8-openssl \
        php8-pcntl \
        php8-fileinfo \
        php8-pecl-msgpack \
        php8-pdo \
        php8-pdo_mysql \
        php8-phar \
        php8-sqlite3 \
        php8-pdo_sqlite \
        php8-redis \
        php8-pecl-imagick \
        php8-session \
        php8-simplexml \
        php8-tokenizer \
        php8-xmlreader \
        php8-exif \
        php8-xdebug \
        php8-xml \
        php8-xmlwriter \
        php8-zip \
        php8-zlib --repository http://nl.alpinelinux.org/alpine/edge/testing/ 

RUN ln -s -f /usr/bin/php8 /usr/bin/php
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer 
RUN rm -rf /var/cache/apk/*

# Configure PHP-FPM
COPY docker-config/fpm-pool.conf /etc/php8/php-fpm.d/www.conf

# Configure supervisord
COPY docker-config/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Setup document root
RUN mkdir -p /var/www/html

# Make sure files/folders needed by the processes are accessable when they run under the www user
RUN chown -R www.www /run && \
  chown -R www.www /var/lib/nginx && \
  chown -R www.www /var/log/nginx

# Switch to use a non-root user from here on
USER www

# Add application
WORKDIR /var/www/html
# COPY --chown=www src/ /var/www/html/

# Expose the port nginx is reachable on
EXPOSE 8080
# EXPOSE 8000 -> if you want to use artisan serve

# Let supervisord start nginx & php-fpm
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
# CMD ["php artisan serve"] -> if you want to use artisan serve
# Configure a healthcheck to validate that everything is up&running
HEALTHCHECK --timeout=10s CMD curl --silent --fail http://127.0.0.1:8080/fpm-ping