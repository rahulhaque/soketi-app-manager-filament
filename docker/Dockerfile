FROM ubuntu:22.04

LABEL maintainer="Rahul Haque <rahulhaque07@gmail.com>"

ARG WWWGROUP=1000
ARG WWWUSER=1000
ARG PHP_VERSION=8.2

WORKDIR /var/www/html

ENV DEBIAN_FRONTEND noninteractive
ENV TZ=UTC

RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

# Install dependencies and add php repository
RUN apt-get update \
    && apt-get install -y apt-utils ca-certificates curl gnupg gosu \
    libcap2-bin nano python2 sqlite3 supervisor unzip zip \
    && mkdir -p ~/.gnupg \
    && chmod 600 ~/.gnupg \
    && echo "disable-ipv6" >> ~/.gnupg/dirmngr.conf \
    && echo "keyserver hkp://keyserver.ubuntu.com:80" >> ~/.gnupg/dirmngr.conf \
    && gpg --recv-key 0x14aa40ec0831756756d7f66c4f4ea0aae5267a6c \
    && gpg --export 0x14aa40ec0831756756d7f66c4f4ea0aae5267a6c > /usr/share/keyrings/ppa_ondrej_php.gpg \
    && echo "deb [signed-by=/usr/share/keyrings/ppa_ondrej_php.gpg] https://ppa.launchpadcontent.net/ondrej/php/ubuntu jammy main" > /etc/apt/sources.list.d/ppa_ondrej_php.list

# Install php and necessary extensions
RUN apt-get update \
    && apt-get install -y php$PHP_VERSION-fpm php$PHP_VERSION-cli php$PHP_VERSION-dev \
    php$PHP_VERSION-pgsql php$PHP_VERSION-sqlite3 php$PHP_VERSION-mysql \
    php$PHP_VERSION-imap php$PHP_VERSION-gd php$PHP_VERSION-mbstring \
    php$PHP_VERSION-xml php$PHP_VERSION-zip php$PHP_VERSION-bcmath \
    php$PHP_VERSION-soap php$PHP_VERSION-intl php$PHP_VERSION-readline \
    php$PHP_VERSION-ldap php$PHP_VERSION-curl php$PHP_VERSION-msgpack \
    php$PHP_VERSION-igbinary php$PHP_VERSION-redis php$PHP_VERSION-pcov

# Install composer
COPY --from=composer:2.7.2 /usr/bin/composer /usr/bin/composer

# Clean any temporary files
RUN apt-get -y autoremove \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Copy all required config files
COPY start-server.sh /usr/local/bin/start-server.sh
COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY php-fpm-pool.conf /etc/php/$PHP_VERSION/fpm/pool.d/z-www-custom.conf
COPY php.ini /etc/php/$PHP_VERSION/fpm/conf.d/99-php.ini

# Set file capabilities
RUN setcap "cap_net_bind_service=+ep" /usr/bin/php$PHP_VERSION

# Update runtime permissions
RUN groupadd --force -g $WWWGROUP soketi \
    && useradd -s /bin/bash --create-home --no-user-group -g $WWWGROUP -u $WWWUSER soketi \
    && chown -R $WWWUSER:$WWWGROUP /home/soketi \
    && chmod +x /usr/local/bin/start-server.sh

# Expose php fpm port
EXPOSE 9000

CMD ["/usr/local/bin/start-server.sh"]
