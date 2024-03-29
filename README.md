# TRAZA

# Descripción

Traza es un sistema para la homologación de autopartes. Está pensado para integrarse con el sistema GDE para la validación de los trámites iniciados desde el módulo TAD.

Esta primera versión del sistema se ha resuelto con una carga manual a través del administrador del sistema, dado que no se llegó a contar con los datos y servicios de conexión para su implementación en forma automatizada.

# Instalación

El sistema está desarrollado en [Laravel](https://laravel.com/) (versión 6.5 o superior) con algunos toques de [Vue](https://vuejs.org/) (versión 2.6 o superior). Corre sobre [PHP](https://www.php.net/) (versión 7.2 o superior), una base de datos [MySQL](https://www.mysql.com/) (versión 5.7, es posible usar [MariaDB](https://mariadb.org/) también, revisar versiones equivalentes en ese caso) y el servidor web [Apache](http://httpd.apache.org/) (versión 2.4). Utiliza [composer](https://getcomposer.org/) para gestionar las dependencias de PHP y [yarn](https://yarnpkg.com/) para las de [node](https://nodejs.org/). El código está bajo el sistema de control de versiones [git](https://git-scm.com/) y el respositorio se encuentra en [https://bitbucket.org/matricelp/traza-autopartes/](https://bitbucket.org/matricelp/traza-autopartes/).

El sistema operativo recomendado es Linux (preferentemente [Ubuntu](https://ubuntu.com/)). Esta arquitectura se conoce como [LAMP](https://en.wikipedia.org/wiki/LAMP_(software_bundle)) (Linux, Apache, MySQL, PHP). 

## Pasos a seguir

- Clonar este repositorio o descomprimir el archivo .zip con el código fuente en el directorio elegido
  - `git clone [dirección del repositorio]`

- Crear una nueva base de datos en el servidor MySQL
  - Tener en cuenta que es posible que se requiera un nuevo usuario con los permisos correspondientes en el servidor de base de datos


- Descargar [composer](https://getcomposer.org/download/) en el directorio de la aplicación
  - Se deben correr unos comandos desde la consola, ver instrucciones en el sitio web de composer

- Configurar el archivo `.env` a partir del `.env.example`:
  - A priori sólo es necesario configurar las claves que comienzan con `APP`, `DB` y `MAIL`. Se puede configurar [Sentry](https://sentry.io/) para el reporte de errores en la clave `SENTRY_LARAVEL_DSN`

- Instalar [redis](https://redis.io/download)
  - Redis no se está usando por el momento (está pensado para administrar la cola de los trabajos de homologación cuando éstos se puedan automatizar)


- Ejecutar 
  - `php composer.phar install`
    - Dependiendo de la instalación del servidor es probable que este comando solicite ciertas extensiones de php. Es necesario buscar cómo se instalan de acuerdo al sistema operativo.

  - `php artisan migrate --seed`
    - Genera la estructura de la base de datos y algunos datos para que la aplicación pueda funcionar correctamente

  - `yarn`
    - Descarga las dependencias de node (ver cómo instalar yarn en caso de que no esté instalado en el servidor)

  - `yarn prod`
    - Compila los archivos necesarios para el frontend

  - `php artisan horizon`
    - Ejecuta la consola de inspección de trabajos (no está en uso por el momento)

# Configuración de Apache

En el archivo httpd.conf se debe agregar lo siguiente:

```
<Directory "/var/www/html/traza-autopartes/public">
    AllowOverride All
</Directory>

<VirtualHost *:80>
    DocumentRoot "/var/www/html/traza-autopartes/public"
</VirtualHost>

Listen 8080
<VirtualHost *:8080>
    DocumentRoot "/var/www/html/phpMyAdmin"
</VirtualHost>
```

El primer bloque permite utilizar un archivo `.htaccess` desde ese directorio.

El segundo configura el sitio para que se muestre al ingresar a la dirección del servidor.

El tercero sólo es necesario si tenemos instalado phpMyAdmin y queremos acceder desde la web.

# Comentarios

A lo largo del código "Certificados" y "Licencias" representan a la misma entidad.
