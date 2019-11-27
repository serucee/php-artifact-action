FROM composer:latest

COPY . /usr/local/bin
RUN cd /usr/local/bin && composer install --no-dev --no-interaction

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
