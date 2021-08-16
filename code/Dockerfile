FROM php:7.4-apache

RUN apt-get update && apt-get install -y \
&& docker-php-ext-install mysqli pdo pdo_mysql

RUN a2enmod rewrite

RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

RUN sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

RUN chmod 777 -R -c /var/www

# Update Php Settings
RUN sed -E -i -e 's/max_execution_time = 30/max_execution_time = 120/' /etc/php.ini \
 && sed -E -i -e 's/memory_limit = 128M/memory_limit = 512M/' /etc/php.ini \
 && sed -E -i -e 's/post_max_size = 8M/post_max_size = 64M/' /etc/php.ini \
 && sed -E -i -e 's/upload_max_filesize = 2M/upload_max_filesize = 64M/' /etc/php.ini
