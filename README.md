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
