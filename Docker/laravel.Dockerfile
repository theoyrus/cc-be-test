FROM webdevops/php-nginx:8.2-alpine
ENV WEB_DOCUMENT_ROOT=/app/public
ENV PHP_DISMOD=bz2,calendar,exiif,ffi,intl,gettext,ldap,mysqli,imap,pdo_pgsql,pgsql,soap,sockets,sysvmsg,sysvsm,sysvshm,shmop,xsl,zip,gd,apcu,vips,yaml,imagick,mongodb,amqp
WORKDIR /app
COPY composer.json .
COPY composer.lock .
COPY . .
RUN composer install --no-interaction --optimize-autoloader --no-dev
RUN php artisan optimize
# RUN php artisan horizon:publish
# Ensure all of our files are owned by the same user and group.
RUN chown -R application:application .
