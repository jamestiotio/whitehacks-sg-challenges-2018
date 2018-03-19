FROM alpine:3.7

COPY files/latest.tar.gz /wordpress.tar.gz

RUN apk --no-cache add \
    # Install basic provision tools
    bash ed sed curl \
    # Install wordpress prerequisites
    apache2 mysql mysql-client php7-mysqli php7 php7-apache2 php7-mcrypt php7-gd \
    # Install packages for rooting challenge
    vim \
    && chmod u+s /usr/bin/vim \
    # setup mysql
    && sed -Ei 's/^(bind-address|log)/#&/' /etc/mysql/my.cnf \
    # extract wordpress
    && tar xvzf /wordpress.tar.gz \
    && rm -rf /var/www/localhost/htdocs /wordpress.tar.gz \
    && mv /wordpress /var/www/localhost/htdocs/ \
    # setup apache settings
    && chown -R apache:www-data /var/www/localhost/htdocs \
    && sed -i "s/upload_max_filesize = 2M/upload_max_filesize = 20M/" /etc/php7/php.ini \
    # configure wordpress
    && mv /var/www/localhost/htdocs/wp-config-sample.php /var/www/localhost/htdocs/wp-config.php \
    && sed -i -r "s/define\('DB_NAME', '[^']+'\);/define\('DB_NAME', 'wordpress'\);/g" /var/www/localhost/htdocs/wp-config.php \
    && sed -i -r "s/define\('DB_USER', '[^']+'\);/define\('DB_USER', 'wordpress'\);/g" /var/www/localhost/htdocs/wp-config.php \
    && sed -i -r "s/define\('DB_PASSWORD', '[^']+'\);/define\('DB_PASSWORD', 'wordpress'\);/g" /var/www/localhost/htdocs/wp-config.php \
    && printf '%s\n' "g/WHITEHACKS@SG/d" a "$(curl -sL https://api.wordpress.org/secret-key/1.1/salt/)" . w | ed -s /var/www/localhost/htdocs/wp-config.php \
    # Fixed HTTP 500 error during login (https://core.trac.wordpress.org/ticket/37071)
    && sed -i "s/wp_signon( '', \$secure_cookie )/wp_signon( array(), \$secure_cookie )/g" /var/www/localhost/htdocs/wp-login.php \
    # Cleanup
    && apk del --purge ed curl

# make it vulnerable
## TODO
# wp-config backup
RUN ["/bin/bash", "-c", "for f in wp-config.{php~,php.save,old,txt} ; do cp /var/www/localhost/htdocs/wp-config.php /var/www/localhost/htdocs/$f ; done"]
COPY files/robots.txt /var/www/localhost/htdocs/robots.txt
COPY files/debug.log /var/www/localhost/htdocs/wp-content/debug.log
COPY files/header.conf /etc/apache2/conf.d/header.conf
COPY files/flag /root/flag
COPY files/altair.sql /docker-entrypoint-initdb.d/altair.sql

EXPOSE 80
ENV WP_HOST '127.0.0.1'

COPY files/start.sh /start.sh
RUN chmod 755 /start.sh
ENTRYPOINT ["/bin/bash"]
CMD ["/start.sh"]
