FROM alpine:3.7

RUN apk --no-cache add apache2 php7 php7-apache2 \
    && mkdir /run/apache2 \
    && rm -rf /var/www/localhost/htdocs/*

# Add flags, log poisoning and python reverse shell capabilities limited by iptables
RUN apk --no-cache add python2 supervisor iptables openrc \
    && adduser -D whitehacks \
    && echo "WHITEHACKS{1_f0UNd_y0u_l1ttl3_fuL1_sTOp}" > /home/whitehacks/.flag \
    && echo "WHITEHACKS{d3nEb_5UP_sUp_5w@Y}" >> /root/.flag \
    && chmod +x /var/log/apache2

# setup chkrootkit cron backdoor (https://www.exploit-db.com/exploits/33899/)
COPY files/chkrootkit-0.49.tar.gz /root/chkrootkit-0.49.tar.gz
RUN tar -C /root -xzvf /root/chkrootkit-0.49.tar.gz \
    && mv /root/chkrootkit-0.49/chkrootkit /usr/local/bin/chkrootkit \
    && rm -rf /root/chkrootkit-0.49 chkrootkit-0.49.tar.gz \
    && chmod +x /usr/local/bin/chkrootkit \
    # min    hour    day    month    weekday    command
    && echo "*    *    *    *    *    /usr/local/bin/chkrootkit" >> /var/spool/cron/crontabs/root

COPY files/iptables.rules /root/iptables.rules
COPY files/supervisord.conf /etc/supervisor/supervisord.conf
COPY files/start.sh /start.sh
COPY app/ /var/www/localhost/htdocs/

EXPOSE 80
CMD ["/bin/sh", "/start.sh"]
