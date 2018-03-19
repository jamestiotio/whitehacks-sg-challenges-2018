FROM alpine:3.7

RUN apk --no-cache add \
        python2 \
        py2-pip \
        py2-jinja2 \
        py2-flask \
        py2-pillow \
        py2-gunicorn \
        openssh-client \
    && adduser -D www-data -s /sbin/nologin

# Obfuscate /etc/passwd (https://github.com/MarkBaggett/MarkBaggett/blob/master/liam_neeson.py)
COPY files/liam_neeson.py /root/liam_neeson.py
RUN echo "root:Hail_Mary_WhiteHacks" | chpasswd \
    && sed -i 's/root:x:0:0:root:/root:x:0:0:Do not share this with anyone - Hail_Mary_WhiteHacks:/g' /etc/passwd \
    && python /root/liam_neeson.py -a /etc/passwd -p

COPY app/ /app

EXPOSE 8000
ENTRYPOINT ["/usr/bin/gunicorn"]
CMD ["-w", "4", "-b", ":8000", "-u", "www-data", "-g", "www-data", "--access-logfile", "-", "--chdir", "/app", "main:app"]
