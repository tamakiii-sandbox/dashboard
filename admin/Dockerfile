FROM php:7.4.8-fpm as production-pseudo

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php -r "if (hash_file('sha384', 'composer-setup.php') === 'e5325b19b381bfd88ce90a5ddb7823406b2a38cff6bb704b0acc289a09c8128d4a8ce2bbafcd1fcbdc38666422fe2806') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" && \
    php composer-setup.php --install-dir=/usr/local/sbin --filename=composer && \
    php -r "unlink('composer-setup.php');"

RUN curl -sS https://get.symfony.com/cli/installer | bash && \
    mv /root/.symfony/bin/symfony /usr/local/sbin/symfony

RUN apt-get update && \
    apt-get install -y --no-install-recommends \
      git \
      && \
    apt autoremove -y && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install \
      pdo_mysql

WORKDIR /usr/app/dashboard/admin

# --

FROM production-pseudo as development

# --

FROM development as debug

