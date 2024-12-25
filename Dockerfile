# ================ Stage 1: Composer dependencies =====================
FROM composer:2 AS composer_prod
WORKDIR /app
COPY . .
RUN composer install --no-interaction --no-dev --prefer-dist --optimize-autoloader
RUN rm -rf /root/.composer/cache

# =============== Stage 1b: Composer for testing =======================
FROM composer:2 as composer_test
WORKDIR /app
COPY . .
RUN composer install --no-interaction
RUN rm -rf /root/.composer/cache


# =============== Stage 2: Frontend build with Node.js ===============
FROM node:18-alpine AS frontend
WORKDIR /app
COPY package.json package-lock.json vite.config.js tailwind.config.js ./
RUN npm ci
COPY . .
COPY --from=composer_prod /app/vendor ./vendor
RUN npm run build && npm cache clean --force

# ============== Stage 3: Setup PHP and Laravel for production ===============
FROM php:8.2-fpm-alpine AS prod

# Install system dependencies
RUN apk update && apk add --no-cache \
    curl \
    zip \
    unzip \
    git \
    oniguruma-dev \
    icu-dev \
    libzip-dev \
    nginx

# Configure PHP extensions
RUN docker-php-ext-install \
    pdo_mysql \
    mbstring \
    zip \
    intl


# Copy vendor files from composer stage
COPY --from=composer_prod /app/vendor /var/www/html/vendor

# Copy frontend build files
COPY --from=frontend /app/public /var/www/html/public

# Copy project files
COPY . /var/www/html

# Set workdir
WORKDIR /var/www/html

# Copy our prod script and set permissions
COPY docker/run.sh /start.sh
RUN chmod +x /start.sh

# Remove the 'tests' directory (to ensure they are not in prod image, they can be added back later for testing)
RUN rm -rf /var/www/html/tests

#-----Setup permissions------
RUN addgroup -g 1000 web

RUN addgroup nginx web && \
    addgroup www-data web

RUN chown -R www-data:web /var/www/html && \
    chmod -R g+rwxs /var/www/html && \
    chmod -R 775 /var/www/html


# Copy Nginx config file
COPY docker/nginx.conf /etc/nginx/http.d/default.conf

# Copy .env.run
COPY .env.run /var/www/html/.env

# Expose port 80
EXPOSE 80

# Run start script
ENTRYPOINT ["/start.sh"]

# ================= Stage 4: Setup PHP and Laravel for testing ==========================

FROM prod AS test

# Copy test vendor files from composer stage
COPY --from=composer_test /app/vendor /var/www/html/vendor

# Copy test project files
COPY tests /var/www/html/tests

# Copy testing .env file to use as the main .env
COPY .env.testing /var/www/html/.env

# Create sqlite test database
RUN touch /var/www/html/database/database.sqlite

# Copy our testing script and set permissions
COPY docker/tests.sh /start.sh
RUN chmod +x /start.sh

ENTRYPOINT ["/start.sh"]
