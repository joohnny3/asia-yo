FROM --platform=linux/arm64/v8 php:8.1.4-fpm

RUN apt-get update && apt-get install -yq libzip-dev zip git \
    nano \
    sudo \
    cron 

# composer
RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer

RUN rm /bin/sh && ln -s /bin/bash /bin/sh


#timeZone
ENV TZ=Asia/Taipei
RUN ln -snf /usr/share/zoneinfo/${TZ} /etc/localtime && echo ${TZ} > /etc/timezone


EXPOSE 3000
ENV HOST 0.0.0.0
WORKDIR /var/project