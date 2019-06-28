#!/bin/bash

./composer.phar install;
chmod -R 777 storage;
chmod -R 777 app/Imports;
chown -R 1001:1001 app/Imports;
php-fpm
