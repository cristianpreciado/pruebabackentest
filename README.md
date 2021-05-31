# prueba tecnica php
Prueba de php back end por Cristian Camilo Preciado Sánchez
## 1. crear base de datos
No importa el nombre de la base de datos ya que se solicita en el siguiente paso 
## 2. Instalacion inicial de la aplicacion(por script)
Ejecución del script por bash (sh inicial.sh), este script ejecuta composer install, solicita datos base de datos, genera tabla usuario y levanta servidor php
### en caso de no poder ejecutar bash
#### 1. Si no se puede ejecutar el bash 
- composer install
- crear archivo .env donde su contenido es: 
  - MYSQL_HOST=host
  - MYSQL_USERNAME=usuario
  - MYSQL_PASSWORD=clave
  - MYSQL_DB=nombre base de datos
- php vendor/bin/doctrine orm:schema-tool:update --force --dump-sql && php -S localhost:8080
