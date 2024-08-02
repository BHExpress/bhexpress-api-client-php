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

Se recomienda ver las pruebas para más detalles. Lo que se muestra aquí es sólo
una idea, y muy resumida:

```php
use bhexpress\api_client\ApiClient;

$Boleta = new ApiClient();

$periodo = '202407';
$url_listar = '/bhe/boletas?periodo='.$periodo; # Buscar algo similar a urlencode
$response = self::$client->get($url_listar);

echo 'Listado Boletas: '.$response->getBody(); # Resultado del listado

$numero_bhe = '3'; # Número de la BHE a convertir
$url_pdf = '/bhe/pdf/'.$numero_bhe;
$pdf = self::$client->get($url_pdf);

file_put_contents('boleta.pdf', $pdf->getBody()); # Función para crear PDF
```

Los ejemplos anteriores demuestran la capacidad de obtener BHEs emitidas, y en un caso hasta convertir una de ellas en PDF.

Ejecución de cliente de API
--------

Para utilizar este programa y sus servicios, deberás definir las siguientes variables de entorno, a partir de 
la consola de comandos. En Windows, se hace de la siguiente forma:

```shell
set BHEXPRESS_API_URL="https://bhexpress.cl"
set BHEXPRESS_API_TOKEN="" # aquí el token obtenido en https://bhexpress.cl/usuarios/perfil#token
set BHEXPRESS_EMISOR_RUT="" # aquí el RUT del emisor de las BHE
```

En Linux, se hace de la siguiente manera:

```shell
export BHEXPRESS_API_URL="https://bhexpress.cl"
export BHEXPRESS_API_TOKEN="" # aquí el token obtenido en https://bhexpress.cl/usuarios/perfil#token
export BHEXPRESS_EMISOR_RUT="" # aquí el RUT del emisor de las BHE
```

Pruebas
--------

Para los siguientes pasos necesitarás los siguientes programas:
- php 7.4
- Composer
- phpunit/phpunit
- vlucas/phpdotenv
- guzzlehttp/guzzle

Crea un archivo llamado `test.env`, y coloca las variables de entorno definidas en `test.env-dist`.

Luego, para ejecutar las pruebas, deberás tener PHP activo. Para más información de qué programas 
se necesitarán, referirse a `composer.json`.

Por último, ejecuta el siguiente comando en la consola cmd, Windows powershell, o la shell de linux o Apple.
 Abre la consola desde la ubicación de tu proyecto, y ejecuta:

```shell
./vendor/bin/phpunit --filter test_boleta_listar
```

Lo que hizo el comando es ejecutar una prueba que extrae una lista de boletas emitidas en un periodo específico de tiempo. 

Los siguientes comandos pertenecen a las siguientes pruebas:

### BoletaListarTest
- Ejecuta una prueba que obtiene un listado de boletas en un periodo de tiempo `AAAAMM`.
- Retorna: Array con todas las boletas emitidas (o vacía si no se han emitido boletas en ese periodo).
- Variables a utilizar: `TEST_LISTAR_PERIODO`

```shell
./vendor/bin/phpunit --filter test_boleta_listar
```

### BoletaEmitirTest
- Ejecuta una prueba que emite una boleta a un destinatario genérico. Importante anular esta boleta cuando las pruebas se terminen.
- Retorna: Array con la información de la boleta emitida.
- Variables a utilizar: `BHEXPRESS_EMISOR_RUT`, `TEST_EMITIR_FECHAEMIS`

```shell
./vendor/bin/phpunit --filter test_boleta_emitir
```

### BoletaPdfTest
- Ejecuta una prueba que convierte una boleta existente en un PDF.
- Retorna: bytes para crear el PDF.
- Variables a utilizar: `TEST_PDF_NUMEROBHE`

```shell
./vendor/bin/phpunit --filter test_boleta_pdf
```

### BoletaEmailTest
- Ejecuta una prueba que envía una BHE existente por correo a un destinatario.
- Retorna: Respuesta con confirmación de que el correo fue enviado a la dirección especificada.
- Variables a utilizar: `TEST_EMAIL_NUMEROBHE`, `TEST_EMAIL_CORREO`

```shell
./vendor/bin/phpunit --filter test_boleta_email
```

### BoletaAnularTest
- Ejecuta una prueba que anula una BHE que sigue vigente.
- Retorna: Cabecera de BHE anulada.
- Variables a utilizar: `TEST_ANULAR_NUMEROBHE`

Esta prueba se debe efectuar teniendo una boleta propia que siga activa pero que desees anular.

```shell
./vendor/bin/phpunit --filter test_boleta_anular
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
