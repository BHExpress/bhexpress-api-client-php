Pruebas unitarias
=================

Para ejecutar las pruebas unitarias se necesita tener instaladas las dependencias de composer y luego ejecutar:

.. important::
  Al ejecutar pruebas, deberás tener configuradas las variables de entorno necesarias en el archivo test.env. Favor de duplicar test.env-dist, cambiar su nombre a test.env y rellenar las variables necesarias.

Antes de empezar, debes configurar las siguientes variables de entorno:

.. code-block:: shell
    BHEXPRESS_API_URL="https://bhexpress.cl"
    BHEXPRESS_API_TOKEN="token-bhexpress"

Para ejecutar las pruebas unitarias se necesita tener instaladas las dependencias de composer, y para hacer todas las pruebas, ejecutar lo siguiente:

.. code-block:: shell
    ./vendor/bin/phpunit

También es posible ejecutar una pruebas específica indicando el test. Ejemplo:

.. code-block:: shell
    ./vendor/bin/phpunit --filter test_boleta_listar
