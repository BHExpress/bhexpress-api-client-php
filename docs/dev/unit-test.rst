Pruebas unitarias
=================

Para ejecutar las pruebas unitarias se necesita tener instaladas las dependencias de composer y luego ejecutar:

.. important::
  Al ejecutar pruebas, deberás tener configuradas las variables de entorno necesarias en el archivo test.env. Favor de duplicar test.env-dist, cambiar su nombre a test.env y rellenar las variables necesarias.

Antes de empezar, debes configurar las siguientes variables de entorno:

.. code-block:: shell
    BHEXPRESS_API_URL="https://bhexpress.cl"
    BHEXPRESS_API_TOKEN="token-bhexpress"
    BHEXPRESS_EMISOR_RUT="12345678-9"

Para ejecutar las pruebas unitarias se necesita tener instaladas las dependencias de composer, y para hacer todas las pruebas, ejecutar lo siguiente:

.. code-block:: shell
    ./vendor/bin/phpunit

También es posible ejecutar una pruebas específica indicando el test. Ejemplo:

.. code-block:: shell
    ./vendor/bin/phpunit --filter testListarBhes --no-coverage

Alternativamente, se puede ejecutar un "testsuite", o conjunto de tests (solo válido desde la versión de GitHub, o si has definido testsuites previamente):

.. code-block:: shell
    ./vendor/bin/phpunit --no-coverage --testsuite servicios