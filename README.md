# Status Api

Es un desarrollo que permite guardar y mostrar mensajes cortos de máximo 120 caracteres a través de un servicio web.

## Estructura

Este proyecto esta construido en PHP con ayuda del manejador de dependencias [Composer](https://getcomposer.org/) y consta de dos partes:

### Front

*  *Carpeta:* statusapi

El front esta compuesto por un HTML en el que podremos ingresar nuestros mensajes , verlos , filtrarlos y eliminarlos, Adicionalmente podremos limpiar la lista de Logs.

### Servicio Web

*  *Carpeta:* proyectoInt

Este servicio web es el que alimenta la información de los mensajes 

## Instalación 

* Subimos las dos carpetas a nuestro servidor o podemos cargar cada carpeta en un servidor independiente
* Subimos la base de datos *api.sql*
* Cambiamos la conexión de la base de datos en la clase *Conection* del *namespace Controller\Api* 
* Dependiendo de la ubicación del servidor deberemos cambiar la ruta a la que apunta el web service en el archivo *scripts.js*.  *Nota: * Esta url esta por defecto para que trabaje sobre la raíz del servidor 
* Por defecto el proyecto tiene el archivo *composer.phar* pero si el servidor tiene composer instalado de manera global debemos configurarlo para que trabaje de alguna de las dos maneras.
* Debemos tener en cuenta que el servidor debe tener instalado el *mod_rewrite* para que el *htaccess* pueda funcionar correctamente.
