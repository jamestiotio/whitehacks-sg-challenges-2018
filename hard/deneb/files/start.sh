#!/bin/sh

/sbin/iptables-restore --noflush /root/iptables.rules
/usr/bin/supervisord -c /etc/supervisor/supervisord.conf
