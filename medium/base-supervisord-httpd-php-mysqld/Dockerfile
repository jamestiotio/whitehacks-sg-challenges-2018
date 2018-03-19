FROM alpine:3.7

COPY docker-entrypoint.sh /docker-entrypoint.sh
COPY supervisord.conf /etc/supervisor/supervisord.conf

RUN apk --no-cache add bash mysql supervisor apache2 php7 php7-apache2 php7-session php7-mysqli \
    && addgroup mysql mysql \
    && mkdir /run/apache2 \
    && rm -rf /var/www/localhost/htdocs/* \
    && chmod +x /docker-entrypoint.sh

ONBUILD COPY app/ /var/www/localhost/htdocs/
ONBUILD COPY docker-entrypoint-initdb.d/ /docker-entrypoint-initdb.d/

EXPOSE 80 3306
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/supervisord.conf"]
