<?php

/**
 * BHExpress
 * Copyright (C) SASCO SpA (https://sasco.cl)
 *
 * Este programa es software libre: usted puede redistribuirlo y/o modificarlo
 * bajo los términos de la GNU Lesser General Public License (LGPL) publicada
 * por la Fundación para el Software Libre, ya sea la versión 3 de la Licencia,
 * o (a su elección) cualquier versión posterior de la misma.
 *
 * Este programa se distribuye con la esperanza de que sea útil, pero SIN
 * GARANTÍA ALGUNA; ni siquiera la garantía implícita MERCANTIL o de APTITUD
 * PARA UN PROPÓSITO DETERMINADO. Consulte los detalles de la GNU Lesser General
 * Public License (LGPL) para obtener una información más detallada.
 *
 * Debería haber recibido una copia de la GNU Lesser General Public License
 * (LGPL) junto a este programa. En caso contrario, consulte
 * <http://www.gnu.org/licenses/lgpl.html>.
 */

use PHPUnit\Framework\TestCase;
use bhexpress\api_client\ApiClient;
use bhexpress\api_client\ApiException;

class BoletaEmitirTest extends TestCase
{

    protected static $verbose;
    protected static $client;
    protected static $emisor_rut;
    protected static $fecha_emis;

    public static function setUpBeforeClass(): void
    {
        self::$verbose = env('TEST_VERBOSE', false);
        self::$client = new ApiClient();
        self::$emisor_rut = env('BHEXPRESS_EMISOR_RUT');
        self::$fecha_emis = env('TEST_FECHAEMIS', date('Y-m-d'));
    }

    public function test_boleta_emitir()
    {
        $url = '/bhe/emitir';
        $datos_boleta = [
            'Encabezado' => [
                'IdDoc' => [
                    'FchEmis' => self::$fecha_emis,
                    'TipoRetencion' => 1,
                ],
                'Emisor' => [
                    'RUTEmisor' => self::$emisor_rut
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

        try {
            $response = self::$client->post($url, $datos_boleta);
            $this->assertEquals(200, $response->getStatusCode());

            if (self::$verbose) {
                echo "\n",'test_boleta_emitir() emitir ',$response->getBody(),"\n";
            }
        } catch (ApiException $e) {
            $this->fail(sprintf('[ApiException %d] %s', $e->getCode(), $e->getMessage()));
        }
    }
}
