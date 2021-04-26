Cliente API de BHExpress para PHP
=================================

[![Total Downloads](https://poser.pugx.org/sasco/bhexpress-api-client/downloads)](https://packagist.org/packages/sasco/bhexpress-api-client)
[![Monthly Downloads](https://poser.pugx.org/sasco/bhexpress-api-client/d/monthly)](https://packagist.org/packages/sasco/bhexpress-api-client)
[![License](https://poser.pugx.org/sasco/bhexpress-api-client/license)](https://packagist.org/packages/sasco/bhexpress-api-client)

Cliente para realizar la integración con los servicios web de la API de BHExpress desde PHP.

Este código está liberado bajo licencia [LGPL](http://www.gnu.org/licenses/lgpl-3.0.en.html).
O sea, puede ser utilizado tanto en software libre como en software privativo.

Instalación
-----------

Directamente desde la terminal con:

        $ composer require sasco/bhexpress-api-client

O editando el archivo *composer.json* y agregando:

        {
                "require": {
                         "sasco/bhexpress-api-client": "1.*"
                }
        }

Modo de uso
-----------

Se recomienda ver los ejemplos para más detalles. Lo que se muestra aquí es sólo
una idea, y muy resumida:

```php
    $Boleta = new \sasco\BHExpress\API\Boleta($token);
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
    ﻿export BHEXPRESS_API_URL="https://bhexpress.cl"
    export BHEXPRESS_API_TOKEN="" # aquí el token obtenido en https://bhexpress.cl/usuarios/perfil#token
    export BHEXPRESS_EMISOR_RUT="" # aquí el RUT del emisor de las BHE
```

Luego, para probar los ejemplos, lo más rápido, en GNU/Linux, es crear una
carpeta para el proyecto y dentro de esta ejecutar:

```shell
    $ composer require sasco/bhexpress-api-client
    $ cp -ar vendor/sasco/bhexpress-api-client/ejemplos .
    $ ﻿cd ejemplos﻿
    $ ﻿﻿﻿php 001-boletas_listado.php
```

Básicamente, lo que hacen estos 4 comandos es:

1. Instalar el cliente de BHExpress para PHP usando composer.
2. ﻿Copiar ejemplos a la carpeta base del proyecto creado.
3. ﻿Entrar a la carpeta de ejemplos recién copiada.
4. ﻿Ejecutar con PHP el ejemplo `001-boletas_listado.php`.

Con eso podrás ver el listado de boletas que tengas emitidas para el perído
definido en el ejemplo.
