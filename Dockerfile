FROM composer:latest

RUN composer install --no-dev
COPY . /usr/local/bin
RUN cd /usr/local/bin && composer install --no-dev

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
