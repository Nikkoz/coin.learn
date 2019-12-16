FROM php:7.3-fpm

# Install dependencies
RUN apt-get -qq update && apt-get -qq install -y \
    build-essential \
    libmcrypt-dev \
    libpq-dev \
    git \
    vim \
    zip \
    unzip \
    openssl \
    zlib1g-dev \
    libzip-dev \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    sqlite3 \
    jpegoptim optipng pngquant gifsicle \
    libsqlite3-dev  \
    curl

#RUN php7-xsl

# Clear cache
RUN rm -rf /var/lib/apt/lists/*

RUN apt-get update -yqq && \
    apt-get install -y apt-utils && \
    pecl channel-update pecl.php.net

RUN apt-get update && apt-get install -y wget git unzip \
    && pecl install xdebug-2.9.0 \
    && docker-php-ext-enable xdebug

# Install extensions
RUN docker-php-ext-install pdo pdo_pgsql zip mbstring tokenizer bcmath
RUN docker-php-ext-install -j$(nproc) iconv
RUN docker-php-ext-configure gd --with-gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ --with-png-dir=/usr/include/
RUN docker-php-ext-install -j$(nproc) gd

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin/ --filename=composer

RUN pear install PHP_CodeSniffer

RUN /usr/local/bin/phpcs --config-set show_progress 1 && \
    /usr/local/bin/phpcs --config-set colors 1 && \
    /usr/local/bin/phpcs --config-set report_width 140 && \
    /usr/local/bin/phpcs --config-set encoding utf-8 && \
    /usr/local/bin/phpcs --config-set severity 1

# Set working directory
WORKDIR /var/www

COPY ./docker/php/local.ini /usr/local/etc/php/php.ini

RUN adduser --disabled-password --gecos "" docker-user && \
    echo "docker-user ALL=(ALL) NOPASSWD:ALL" >> /etc/sudoers

# Clean
RUN apt-get clean
RUN rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /var/cache/*

# Change current user to docker-user
USER docker-user
