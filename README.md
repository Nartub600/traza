# TRAZA

# Descripción

Traza es un sistema para la homologación de autopartes. Está integrado con el sistema GDE para la validación de los trámites iniciados desde el módulo TAD.

# Instalación

El sistema corre sobre [php](https://www.php.net/) y [Apache](http://httpd.apache.org/). Utiliza [composer](https://getcomposer.org/) para gestionar las dependencias de php y [yarn](https://yarnpkg.com/) para las de [node](https://nodejs.org/).

## Pasos a seguir

- Clonar este repositorio
- Descargar [composer](https://getcomposer.org/download/) en el directorio de la aplicación
- Configurar el archivo `.env` a partir del `.env.example`
- Instalar [redis](https://redis.io/download)
- Ejecutar 
- - `php composer.phar install`
- - `php artisan migrate --seed`
- - `yarn`
- - `yarn prod`
- - `php artisan horizon`
