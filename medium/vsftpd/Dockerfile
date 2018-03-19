FROM alpine:3.7

WORKDIR /app
RUN apk update \
    && apk add --virtual .dependencies wget unzip build-base linux-headers man-pages \
    && apk add supervisor openssh \
    # Build vsftpd
    && wget https://github.com/winstonho90/vsftpd-2.3.4-infected/archive/vsftpd_original.zip \
    && unzip vsftpd_original.zip \
    && rm vsftpd_original.zip \
    && mv * vsftpd_original \
    && chmod +x vsftpd_original/vsf_findlibs.sh \
    && sed -i 's/6200/38426/g' vsftpd_original/sysdeputil.c \
    && sed -i 's/execl("\/bin\/sh","sh",(char \*)0)/execl("\/bin\/cat","cat","\/root\/flag",(char *)0)/g' vsftpd_original/sysdeputil.c \
    && sed -i '66 i #undef VSF_SYSDEP_HAVE_UTMPX' vsftpd_original/sysdeputil.c \
    && (cd vsftpd_original && make && make install) \
    && cp vsftpd_original/vsftpd.conf /etc/vsftpd.conf \
    && echo "listen_address=127.0.0.1" >> /etc/vsftpd.conf \
    && echo "listen=YES"  >> /etc/vsftpd.conf \
    && echo "listen_port=21" >> /etc/vsftpd.conf \
    && echo "local_enable=YES" >> /etc/vsftpd.conf \
    && mkdir -p /usr/share/empty /var/lib/ftp \
    # Cleanup
    && apk del --purge .dependencies \
    && rm -rf /var/cache/apk/* /app/vsftpd_original

# Post-setup
RUN adduser -D user \
    && echo "user:user" | chpasswd \
    && ssh-keygen -A

COPY supervisord.conf /etc/supervisor/supervisord.conf
COPY flag /root/flag
ENTRYPOINT ["/usr/bin/supervisord", "-c", "/etc/supervisor/supervisord.conf"]
