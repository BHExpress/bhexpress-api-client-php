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
use bhexpress\api_client\Boleta;
use bhexpress\api_client\ApiException;

class BoletaEmitirTest extends TestCase
{
    protected static $Boleta;
    protected static $url;
    protected static $token;
    protected static $rut;

    public static function setUpBeforeClass(): void
    {
        self::$url = getenv('BHEXPRESS_API_URL', 'https://bhexpress.cl');
        self::$token = getenv('BHEXPRESS_API_TOKEN');
        self::$rut = getenv('BHEXPRESS_EMISOR_RUT');

        // Inicializar el cliente API de Boleta
        self::$Boleta = new Boleta(self::$token, self::$url);
    }

    public function testEmitirBoleta()
    {
        $datosBoleta = [
            'Encabezado' => [
                'IdDoc' => [
                    'FchEmis' => '2024-02-27',
                    'TipoRetencion' => 1,
                ],
                'Emisor' => [
                    'RUTEmisor' => self::$rut
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
            $boleta = self::$Boleta->emitir($datosBoleta);
            $this->assertIsArray($boleta, 'La respuesta debe ser un array');
            $this->assertArrayHasKey('someExpectedKey', $boleta, 'La respuesta debe contener la clave esperada');

            // Otros asserts específicos para verificar el contenido de la respuesta...
            
        } catch (ApiException $e) {
            $this->fail('La emisión de la boleta falló: ' . $e->getMessage());
        }
    }
}
