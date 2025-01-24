Ejemplo
=======

Para utilizar el cliente de API de BHExpress, deberás tener definido el token de API y el RUT del emisor como variables de entorno.

.. seealso::
    Para más información sobre este paso, referirse al la guía en Configuración.

El siguiente es un ejemplo básico de cómo emitir una BHE utilizando el cliente de API.

.. code-block:: php
    <?php

    # Definición de directorio autoload. Necesario si se usa la versión de GitHub.
    require_once __DIR__ . '/vendor/autoload.php';

    # Importaciones del cliente de API de BHExpress
    use bhexpress\api_client\bhe\Bhe;

    # Instancia de cliente.
    $client = new Bhe();
    # RUT del emisor.
    $emisor_rut = "12345678-9";
    # Fecha de emisión de BHE.
    $fecha_emis = date('Y-m-d');

    # Datos de la boleta a ser emitida.
    $datos_boleta = [
        'Encabezado' => [
            'IdDoc' => [
                'FchEmis' => $fecha_emis,
                'TipoRetencion' => 1,
            ],
            'Emisor' => [
                'RUTEmisor' => $emisor_rut
            ],
            'Receptor' => [
                'RUTRecep' => '66666666-6',
                'RznSocRecep' => 'Receptor generico',
                'DirRecep' => 'Santa Cruz',
                'CmnaRecep' => 'Santa Cruz'
            ]
        ],
        'Detalle' => [
            [
                'NmbItem' => 'Item con monto final solamente (lo básico en SII)',
                'MontoItem' => 100
            ],
            [
                'CdgItem' => 'CASO2',
                'NmbItem' => 'Se agrega código al item',
                'MontoItem' => 300
            ],
            [
                'NmbItem' => 'Se agrega cantidad al item (se indica precio unitario)',
                'QtyItem' => 1,
                'PrcItem' => 120
            ],
            [
                'NmbItem' => 'Se agrega cantidad al item (se indica precio unitario)',
                'QtyItem' => 0.5,
                'PrcItem' => 120
            ],
            [
                'CdgItem' => 'CASO2',
                'NmbItem' => 'Se agrega código y cantidad al item (se indica precio unitario)',
                'QtyItem' => 2,
                'PrcItem' => 250
            ],
            [
                'CdgItem' => 'COMPLETO',
                'NmbItem' => 'Caso más completo, con código, cantidad, precio unitario y descuento en porcentaje',
                'QtyItem' => 10,
                'PrcItem' => 75,
                'DescuentoPct' => 10
            ],
            [
                'CdgItem' => 'COMPLETO',
                'NmbItem' => 'Caso más completo, con codigo, cantidad, precio unitario y descuento en monto fijo',
                'QtyItem' => 10,
                'PrcItem' => 75,
                'DescuentoMonto' => 50
            ],
            [
                'NmbItem' => 'En este caso el MontoItem es descartado por que va cantidad y precio unitario',
                'QtyItem' => 2,
                'PrcItem' => 10,
                'MontoItem' => 100
            ]
        ]
    ];

    # Respuesta de solicitud HTTP (POST) de emisión de boleta.
    $response = $client->emitirBhe($datos_boleta);

    # Despliegue del resultado.
    echo "\n", $response->getStatusCode();
    echo "\nEMISION BOLETA: \n";
    echo "\n",$response->getBody(),"\n";

.. seealso::
    Para saber más sobre los parámetros posibles y el cómo consumir las API, referirse a la `documentación de BHExpress. <https://developers.bhexpress.cl/>`_
