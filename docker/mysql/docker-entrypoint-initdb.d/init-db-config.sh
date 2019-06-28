#!/bin/bash

mysql -u root --password=$MYSQL_ROOT_PASSWORD <<EOFMYSQL
USE MSP-Manager;
GRANT ALL ON laravel.* TO 'laraveluser'@'%' IDENTIFIED BY 'secret';
GRANT ALL ON *.* TO 'admin'@'%' IDENTIFIED BY 'admin';
FLUSH PRIVILEGES;
EOFMYSQL