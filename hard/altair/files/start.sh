#!/bin/bash

# parameters
MYSQL_ROOT_PWD=${MYSQL_ROOT_PWD:-"mysql"}
MYSQL_USER=${MYSQL_USER:-"wordpress"}
MYSQL_USER_PWD=${MYSQL_USER_PWD:-"wordpress"}
MYSQL_USER_DB=${MYSQL_USER_DB:-"wordpress"}

if [ ! -d "/run/mysqld" ]; then
	mkdir -p /run/mysqld
	chown -R mysql:mysql /run/mysqld
fi

if [ ! -d "/run/apache2" ]; then
	mkdir -p /run/apache2
	chown -R apache:www-data /run/apache2
fi

if [ -d /var/lib/mysql/mysql ]; then
	echo '[i] MySQL directory already present, skipping creation'
else
	echo "[i] MySQL data directory not found, creating initial DBs"

	chown -R mysql:mysql /var/lib/mysql

	# init database
	echo 'Initializing database'
	mysql_install_db --user=mysql > /dev/null
	echo 'Database initialized'

	echo "[i] MySql root password: $MYSQL_ROOT_PWD"

	# create temp file
	tfile=`mktemp`
	if [ ! -f "$tfile" ]; then
	    return 1
	fi

	# save sql
	echo "[i] Create temp file: $tfile"
	cat << EOF > $tfile
USE mysql;
FLUSH PRIVILEGES;
DELETE FROM mysql.user;
GRANT ALL PRIVILEGES ON *.* TO 'root'@'localhost' IDENTIFIED BY '$MYSQL_ROOT_PWD' WITH GRANT OPTION;
GRANT ALL PRIVILEGES ON *.* TO 'root'@'%' IDENTIFIED BY '$MYSQL_ROOT_PWD' WITH GRANT OPTION;
EOF


	# Create new database
	if [ "$MYSQL_USER_DB" != "" ]; then
		echo "[i] Creating database: $MYSQL_USER_DB"
		echo "CREATE DATABASE IF NOT EXISTS \`$MYSQL_USER_DB\` CHARACTER SET utf8 COLLATE utf8_general_ci;" >> $tfile

		# set new User and Password
		if [ "$MYSQL_USER" != "" ] && [ "$MYSQL_USER_PWD" != "" ]; then
		echo "[i] Creating user: $MYSQL_USER with password $MYSQL_USER_PWD"
		echo "GRANT ALL ON \`$MYSQL_USER_DB\`.* to '$MYSQL_USER'@'%' IDENTIFIED BY '$MYSQL_USER_PWD';" >> $tfile
		fi
	else
		# don`t need to create new database,Set new User to control all database.
		if [ "$MYSQL_USER" != "" ] && [ "$MYSQL_USER_PWD" != "" ]; then
		echo "[i] Creating user: $MYSQL_USER with password $MYSQL_USER_PWD"
		echo "GRANT ALL ON *.* to '$MYSQL_USER'@'%' IDENTIFIED BY '$MYSQL_USER_PWD';" >> $tfile
		fi
	fi

	echo 'FLUSH PRIVILEGES;' >> $tfile

	# run sql in tempfile
	echo "[i] run tempfile: $tfile"
	/usr/bin/mysqld --user=mysql --bootstrap --verbose=0 < $tfile
	rm -f $tfile
fi

# run any scripts in docker-entrypoint-initdb folder
# for f in /docker-entrypoint-initdb.d/*; do
    # case "$f" in
        # *.sh)     echo "$0: running $f"; . "$f" ;;
        # *.sql)    echo "$0: running $f"; /usr/bin/mysqld --user=mysql --bootstrap --verbose=0 < "$f"; echo ;;
        # *.sql.gz) echo "$0: running $f"; gunzip -c "$f" | "${mysql[@]}"; echo ;;
        # *)        echo "$0: ignoring $f" ;;
    # esac
    # echo
# done

echo '[i] start running mysqld'
/usr/bin/mysqld --user=mysql &

echo "[i] Sleeping 5 sec"
sleep 5

mysql -uroot -pmysql < /docker-entrypoint-initdb.d/altair.sql

cat << EOF > /tmp/test
USE wordpress;
SET @oldsite='http://192.168.99.100'; 
SET @newsite='http://${WP_HOST:-"127.0.0.1"}';
UPDATE wp_options SET option_value = replace(option_value, @oldsite, @newsite) WHERE option_name = 'home' OR option_name = 'siteurl';
UPDATE wp_posts SET post_content = replace(post_content, @oldsite, @newsite);
UPDATE wp_links SET link_url = replace(link_url, @oldsite, @newsite);
UPDATE wp_postmeta SET meta_value = replace(meta_value, @oldsite, @newsite);
EOF
mysql -uroot -pmysql < /tmp/test
rm -f /tmp/test

echo '[i] start running httpd'
/usr/sbin/httpd -D FOREGROUND
