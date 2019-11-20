FROM composer:latest

COPY entrypoint.sh /usr/local/bin/entrypoint.sh
COPY app /usr/local/bin/app

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
