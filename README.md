BHExpress: Cliente de API en PHP
================================

[![Total Downloads](https://poser.pugx.org/bhexpress/bhexpress-api-client/downloads)](https://packagist.org/packages/bhexpress/bhexpress-api-client)
[![Monthly Downloads](https://poser.pugx.org/bhexpress/bhexpress-api-client/d/monthly)](https://packagist.org/packages/bhexpress/bhexpress-api-client)
[![License](https://poser.pugx.org/bhexpress/bhexpress-api-client/license)](https://packagist.org/packages/bhexpress/bhexpress-api-client)

Cliente para realizar la integración con los servicios web de [BHExpress](https://www.bhexpress.cl) desde PHP.

Instalación
-----------

Ejecutar en la terminal:

```shell
$ composer require bhexpress/bhexpress-api-client
```

Modo de uso
-----------

Se recomienda ver los ejemplos para más detalles. Lo que se muestra aquí es sólo
una idea, y muy resumida:

```php
$Boleta = new \bhexpress\api_client\Boleta($token);
$boleta = $Boleta->emitir($datos);
$pdf = $Boleta->pdf($rut_emisor, $boleta['numero']);
file_put_contents('boleta.pdf', $pdf);
```

Ejemplos
--------

Los ejemplos cubren los siguientes casos:

- `001-boletas_listado.php`: obtener las boletas de un período.
- `002-boleta_emitir.php`: emisitir una BHE.
- `003-boleta_pdf.php`: descargar el PDF de una BHE.
- `004-boleta_email.php`: enviar por email una BHE.
- `005-boleta_anular.php`: anular una BHE.

Los ejemplos, por defecto, hacen uso de variables de entornos, si quieres usar
esto debes tenerlas creadas, por ejemplo, en GNU/Linux, con:

```shell
export BHEXPRESS_API_URL="https://bhexpress.cl"
export BHEXPRESS_API_TOKEN="" # aquí el token obtenido en https://bhexpress.cl/usuarios/perfil#token
export BHEXPRESS_EMISOR_RUT="" # aquí el RUT del emisor de las BHE
```

Luego, para probar los ejemplos, lo más rápido, en GNU/Linux, es crear una
carpeta para el proyecto y dentro de esta ejecutar:

```shell
$ composer require sasco/bhexpress-api-client
$ cp -ar vendor/sasco/bhexpress-api-client/ejemplos .
$ cd ejemplos
$ php 001-boletas_listado.php
```

Básicamente, lo que hacen estos 4 comandos es:

1. Instalar el cliente de BHExpress para PHP usando composer.
2. Copiar ejemplos a la carpeta base del proyecto creado.
3. Entrar a la carpeta de ejemplos recién copiada.
4. Ejecutar con PHP el ejemplo `001-boletas_listado.php`.

Con eso podrás ver el listado de boletas que tengas emitidas para el período
definido en el ejemplo.

El siguiente es un video que muestra la ejecución de los pasos previamente descritos:

[![Video BHExpress](http://img.youtube.com/vi/dyF9ZrdKr0Y/0.jpg)](http://www.youtube.com/watch?v=dyF9ZrdKr0Y "Cliente PHP de la API de BHExpress")

Licencia
--------

Este programa es software libre: usted puede redistribuirlo y/o modificarlo
bajo los términos de la GNU Lesser General Public License (LGPL) publicada
por la Fundación para el Software Libre, ya sea la versión 3 de la Licencia,
o (a su elección) cualquier versión posterior de la misma.

Este programa se distribuye con la esperanza de que sea útil, pero SIN
GARANTÍA ALGUNA; ni siquiera la garantía implícita MERCANTIL o de APTITUD
PARA UN PROPÓSITO DETERMINADO. Consulte los detalles de la GNU Lesser General
Public License (LGPL) para obtener una información más detallada.

Debería haber recibido una copia de la GNU Lesser General Public License
(LGPL) junto a este programa. En caso contrario, consulte
[GNU Lesser General Public License](http://www.gnu.org/licenses/lgpl.html).

Enlaces
-------

- [Sitio web BHExpress](https://www.bhexpress.cl).
- [Código fuente en GitHub](https://github.com/BHExpress/bhexpress-api-client-php).
- [Paquete en Packagist](https://packagist.org/packages/bhexpress/bhexpress-api-client).
