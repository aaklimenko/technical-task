FROM php:7.1
COPY ./ /app
WORKDIR /app
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php install
RUN php composer.phar install
RUN rm composer.phar composer-setup.php

CMD php index.php