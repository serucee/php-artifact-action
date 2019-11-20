FROM composer:latest

COPY . /usr/local/bin

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
