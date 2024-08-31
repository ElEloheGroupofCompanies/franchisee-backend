FROM richarvey/nginx-php-fpm:latest

COPY . .

# Image config
ENV SKIP_COMPOSER 1
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
ENV RUN_SCRIPTS 1
ENV REAL_IP_HEADER 1

# Laravel config
ENV APP_ENV franchisee
ENV APP_DEBUG false
ENV DB_CONNECTION pgsql
ENV DB_HOST dpg-cr9ab9rv2p9s73b4e48g-a.singapore-postgres.render.com
ENV DB_PORT 5432
ENV DB_DATABASE franchisee
ENV DB_USERNAME franchisee_user
ENV DB_PASSWORD MhjzFKYh34mQcrXxEr79lj5wQPwt19wR

# Allow composer to run as root
ENV COMPOSER_ALLOW_SUPERUSER 1

CMD ["/start.sh"]