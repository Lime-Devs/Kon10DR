# Use PHP 8.1 with Alpine as the base image
FROM php:8.1-fpm-alpine

# Hardcode the user and group IDs
ARG UID=1000
ARG GID=1000
ENV USER=laraveluser

# Remove conflicting dialout group
RUN delgroup dialout

# Create a group if it doesn't exist already
RUN if getent group ${GID} ; then \
        echo "Group with GID ${GID} exists"; \
    else \
        addgroup -g ${GID} nginxgroup; \
    fi

# Create user if it doesn't exist
RUN if getent passwd ${UID} ; then \
        echo "User with UID ${UID} exists"; \
    else \
        adduser -u ${UID} -G nginxgroup -D ${USER}; \
    fi
    
# Modify php-fpm configuration to use the new user's privileges
RUN sed -i "s/user = www-data/user = ${USER}/g" /usr/local/etc/php-fpm.d/www.conf
RUN sed -i "s/group = www-data/group = nginxgroup/g" /usr/local/etc/php-fpm.d/www.conf
RUN echo "php_admin_flag[log_errors] = on" >> /usr/local/etc/php-fpm.d/www.conf

# Install required packages
RUN apk update && apk upgrade
RUN apk add --no-cache \
    libzip-dev \
    libcurl \
    curl-dev \
    openssl-dev \
    zlib-dev \
    oniguruma-dev \
    libxml2-dev \
    gcc \
    g++ \
    make \
    autoconf \
    php81-pdo_mysql \
    php81-mbstring \
    php81-bcmath \
    php81-fileinfo \
    php81-pdo \
    php81-mysqli \
    php81-zip

# Configure and install php extensions using docker-php-ext-install
RUN docker-php-ext-install pdo pdo_mysql bcmath curl fileinfo mbstring zip mysqli

# Install redis extension
COPY phpredis-5.3.4.tar.gz /usr/src/php/ext/redis/phpredis-5.3.4.tar.gz
RUN tar xvzf /usr/src/php/ext/redis/phpredis-5.3.4.tar.gz -C /usr/src/php/ext/redis --strip 1 \
    && echo 'redis' >> /usr/src/php-available-exts \
    && docker-php-ext-install redis

# Start php-fpm
CMD ["php-fpm", "-y", "/usr/local/etc/php-fpm.conf", "-R"]