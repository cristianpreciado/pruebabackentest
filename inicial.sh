#!/bin/bash
touch .env
echo 'Introduzca host de la base de datos:'
read host
echo 'Introduzca usuario de la base de datos:'
read usuario
echo 'Introduzca clave de la base de datos:'
read clave
echo 'Introduzca nombre de la base de datos:'
read nombre
echo "MYSQL_HOST=$host
MYSQL_USERNAME=$usuario
MYSQL_PASSWORD=$clave
MYSQL_DB=$nombre" > .env
php vendor/bin/doctrine orm:schema-tool:update --force --dump-sql && php -S localhost:8080
echo ---------Fin del script.-------------