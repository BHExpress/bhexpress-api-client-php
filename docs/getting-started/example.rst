Ejemplo
=======

El siguiente es un ejemplo básico de cómo obtener un listado de documentos BHE utilizando el cliente de API.

.. code-block:: php
    <?php

    # Definición de directorio autoload. Necesario si se usa la versión de GitHub.
    require_once __DIR__ . '/vendor/autoload.php';

    # Importaciones del cliente de API de BHExpress
    use bhexpress\api_client\ApiClient;

    # Instanciación de cliente de API
    $client = new ApiClient();

    # Periodo de búsqueda de BHEs
    $periodo = '202407';
    # Recurso a consumir
    $url = '/bhe/boletas?periodo='.$periodo;

    # Respuesta de la solicitud HTTP
    $response = $client->get($url);

    # Impresión de código de estado y BHE pertenecientes al periodo.
    echo "\n", $response->getStatusCode();
    echo "\nLISTA BOLETAS: \n";
    echo "\n",$response->getBody(),"\n";

Desgloce de ejemplo
-------------------

Para utilizar el cliente de API de BHExpress, deberás tener definido el token de API y el RUT del emisor como variables de entorno. 

.. seealso::
    Para más información sobre este paso, referirse al la guía en Configuración.

Al momento de integrar el cliente de API con tu programa, debes importar el cliente e instanciarlo.

.. code-block:: php
    # Importaciones del cliente de API de BHExpress
    use bhexpress\api_client\ApiClient;

    # Instanciación de cliente de API
    $client = new ApiClient();

Luego, se definen los parámetros a utilizar.

.. code-block:: php
    # Periodo de búsqueda de BHEs
    $periodo = '202407';
    # Recurso a consumir
    $url = '/bhe/boletas?periodo='.$periodo;

Más adelante, se ejecuta la solicitud HTTP y se guarda en una variable llamada ``$response``. Response contiene la información de la respuesta HTTP, desde el código de estado, hasta las cabeceras y el cuerpo (si es que tiene).

.. code-block:: php
    # Respuesta de la solicitud HTTP
    $response = $client->get($url);

Y al final de todo, se despliega el cuerpo de la respuesta en consola, junto con su código de estado.

.. code-block:: php
    # Impresión de código de estado y BHE pertenecientes al periodo.
    echo "\n", $response->getStatusCode();
    echo "\nLISTA BOLETAS: \n";
    echo "\n",$response->getBody(),"\n";

.. seealso::
    Para saber más sobre los parámetros posibles y el cómo consumir las API, referirse a la `documentación de BHExpress. <https://developers.bhexpress.cl/>`_
