# Production Dockerfile for Laravel 12 on Render (PostgreSQL)
# Uses nginx + PHP-FPM; WEBROOT points to public/ for proper document root.

FROM richarvey/nginx-php-fpm:3.1.6

WORKDIR /var/www/html

# Skip base image composer/script composer so we control install and build
ENV SKIP_COMPOSER=1
ENV WEBROOT=/var/www/html/public
ENV PHP_ERRORS_STDERR=1
ENV RUN_SCRIPTS=1
ENV REAL_IP_HEADER=1
ENV COMPOSER_ALLOW_SUPERUSER=1

# Production defaults (overridden by Render env vars)
ENV APP_ENV=production
ENV APP_DEBUG=0
ENV LOG_CHANNEL=stderr

# Copy app files (respects .dockerignore)
COPY . .

# Install PHP dependencies (no dev; production only)
RUN composer install --no-dev --no-interaction --optimize-autoloader --prefer-dist

# Install Node and build Vite assets (production manifest + hashed files)
RUN apk add --no-cache nodejs npm && \
    npm ci --omit=dev && \
    npm run build && \
    rm -rf node_modules && \
    apk del npm

# Ensure writable directories exist (runtime script will chown if needed)
RUN mkdir -p storage/framework/cache storage/framework/sessions storage/framework/views storage/logs bootstrap/cache && \
    chmod -R 775 storage bootstrap/cache

# Optional: custom nginx config to ensure index.php routing (uncomment if needed)
# COPY docker/nginx-site.conf /var/www/html/conf/nginx/nginx-site.conf

# Startup runs scripts in /var/www/html/scripts/ (migrate, cache, storage:link)
CMD ["/start.sh"]
