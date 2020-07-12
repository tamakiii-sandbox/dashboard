FROM php:7.4.8-fpm as production-pseudo

# --

FROM production-pseudo as development

# --

FROM development as debug

