FROM richarvey/nginx-php-fpm:latest

COPY . .

# Image config
ENV SKIP_COMPOSER 1
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
ENV RUN_SCRIPTS 1
ENV REAL_IP_HEADER 1

# Laravel config
ENV APP_ENV production
ENV APP_DEBUG false
ENV DB_CONNECTION pgsql
ENV DB_HOST dpg-cqgrsuks1f4s73bepqng-a.singapore-postgres.render.com
ENV DB_PORT 5432
ENV DB_DATABASE eleloheproductiondb
ENV DB_USERNAME eleloheproductiondb_user
ENV DB_PASSWORD uyMUL1VWdPMCQi7V3Key3VQPke1oBSpx

# Allow composer to run as root
ENV COMPOSER_ALLOW_SUPERUSER 1

CMD ["/start.sh"]