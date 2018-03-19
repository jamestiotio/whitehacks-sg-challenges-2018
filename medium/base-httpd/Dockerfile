FROM alpine:3.7

RUN apk --no-cache add apache2 \
    && mkdir /run/apache2 \
    && rm -rf /var/www/localhost/htdocs/*

ONBUILD COPY app/ /var/www/localhost/htdocs/

EXPOSE 80
CMD ["/usr/sbin/httpd", "-D", "FOREGROUND"]
