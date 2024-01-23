FROM phpdockerio/php:8.2-fpm
WORKDIR "/application"

RUN apt-get update; \
    apt-get -y --no-install-recommends install \
        git \ 
        php8.2-bcmath \ 
        php8.2-bz2 \ 
        php8.2-gd \ 
        php8.2-intl \ 
        php8.2-redis \
        php8.2-pgsql \ 
        php8.2-pdo_pgsql \
        php8.2-pdo \  
        php8.2-soap; \
    apt-get clean; \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*