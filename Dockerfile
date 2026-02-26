# Production Dockerfile for Laravel 12 on Render (PostgreSQL)
# Uses nginx + PHP-FPM; WEBROOT points to public/ for proper document root.

# ---- Stage 1: Build Vite assets with Node ----
FROM node:20-alpine AS vite

WORKDIR /app

COPY package.json package-lock.json* ./
# Install all deps (including dev) so Vite can build; we only copy public/build to the final image
RUN npm ci

COPY vite.config.js tailwind.config.js postcss.config.js ./
COPY resources ./resources
COPY public ./public

RUN npm run build

# ---- Stage 2: Laravel app with PHP-FPM ----
FROM richarvey/nginx-php-fpm:3.1.6

WORKDIR /var/www/html

# Skip base image composer/script composer so we control install and build
ENV SKIP_COMPOSER=1
ENV WEBROOT=/var/www/html/public
# Send non-file requests to Laravel index.php (fixes 404 on /menu, /login, etc.)
ENV PHP_CATCHALL=1
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

# Copy built Vite assets from Node stage (no Node needed in this image)
COPY --from=vite /app/public/build /var/www/html/public/build

# Ensure writable directories exist (runtime script will chown if needed)
RUN mkdir -p storage/framework/cache storage/framework/sessions storage/framework/views storage/logs bootstrap/cache && \
    chmod -R 775 storage bootstrap/cache

# Custom nginx config: send all non-file requests to Laravel index.php (fixes /menu etc. 404)
COPY docker/nginx-site.conf /var/www/html/conf/nginx/nginx-site.conf

# Startup runs scripts in /var/www/html/scripts/ (migrate, cache, storage:link)
CMD ["/start.sh"]
