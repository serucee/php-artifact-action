FROM composer:latest

RUN composer install --no-dev
COPY . /usr/local/bin

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
