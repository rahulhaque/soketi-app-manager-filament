FROM serversideup/php:8.2-fpm-nginx

ENV PHP_OPCACHE_ENABLE=1

USER root

# Install Node.js
RUN curl -fsSL https://deb.nodesource.com/setup_22.x | bash - \
    && apt-get update \
    && apt-get install -y nodejs \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Copy application files
COPY --chown=www-data:www-data . /var/www/html

# Switch to non-root user
USER www-data

# Install dependencies and build
RUN npm install \
    && npm run build \
    && rm -rf /var/www/html/.npm

# Install PHP dependencies
RUN composer install --no-interaction --optimize-autoloader --no-dev

# Remove composer cache
RUN rm -rf /var/www/html/.composer/cache
