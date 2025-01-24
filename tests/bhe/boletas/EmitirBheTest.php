<?php

declare(strict_types=1);

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

use bhexpress\api_client\ApiException;
use bhexpress\api_client\bhe\Bhe;
use bhexpress\tests\bhe\AbstractBoletas;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(Bhe::class)]
/**
 * Clase de prueba para emitir una BHE.
 */
class EmitirBheTest extends AbstractBoletas
{
    /**
     * Variable que permite desplegar en consola los resultados.
     *
     * @var bool
     */
    protected static $verbose;

    /**
     * RUT del emisor de la BHE.
     *
     * @var string
     */
    protected static $emisor_rut;

    /**
     * Datos de la boleta a emitir.
     *
     * @var array
     */
    protected static $datos_boleta = [
        'Encabezado' => [
            'IdDoc' => [
                'FchEmis' => null,
                'TipoRetencion' => 1,
            ],
            'Emisor' => [
                'RUTEmisor' => null,
            ],
            'Receptor' => [
                'RUTRecep' => '66666666-6',
                'RznSocRecep' => 'Receptor generico',
                'DirRecep' => 'Santa Cruz',
                'CmnaRecep' => 'Santa Cruz',
            ],
        ],
        'Detalle' => [
            [
                'NmbItem' => 'Item con monto final solamente (lo básico en SII)',
                'MontoItem' => 100,
            ],
            [
                'CdgItem' => 'CASO2',
                'NmbItem' => 'Se agrega código al item',
                'MontoItem' => 300,
            ],
            [
                'NmbItem' => 'Se agrega cantidad al item (se indica precio unitario)',
                'QtyItem' => 1,
                'PrcItem' => 120,
            ],
            [
                'NmbItem' => 'Se agrega cantidad al item (se indica precio unitario)',
                'QtyItem' => 0.5,
                'PrcItem' => 120,
            ],
            [
                'CdgItem' => 'CASO2',
                'NmbItem' => 'Se agrega código y cantidad al item (se indica precio unitario)',
                'QtyItem' => 2,
                'PrcItem' => 250,
            ],
            [
                'CdgItem' => 'COMPLETO',
                'NmbItem' => 'Caso más completo, con código, cantidad, precio unitario y descuento en porcentaje',
                'QtyItem' => 10,
                'PrcItem' => 75,
                'DescuentoPct' => 10,
            ],
            [
                'CdgItem' => 'COMPLETO',
                'NmbItem' => 'Caso más completo, con codigo, cantidad, precio unitario y descuento en monto fijo',
                'QtyItem' => 10,
                'PrcItem' => 75,
                'DescuentoMonto' => 50,
            ],
            [
                'NmbItem' => 'En este caso el MontoItem es descartado por que va cantidad y precio unitario',
                'QtyItem' => 2,
                'PrcItem' => 10,
                'MontoItem' => 100,
            ],
        ],
    ];

    public static function setUpBeforeClass(): void
    {
        self::$verbose = env('TEST_VERBOSE', false);
        self::$client = new Bhe();
        self::$emisor_rut = env('BHEXPRESS_EMISOR_RUT');
        self::$datos_boleta['Encabezado']['IdDoc']['FchEmis'] = date('Y-m-d');
        self::$datos_boleta['Encabezado']['Emisor']['RUTEmisor'] = self::$emisor_rut;
    }

    /**
     * Método de test que permite probar la emisión de una BHE nueva.
     *
     * @throws \bhexpress\api_client\ApiException Si la estructura de la boleta
     * es errónea, si la boleta está incompleta, o si falla la conexión.
     * @return void
     */
    public function testEmitirBhe()
    {
        try {
            $response = self::$client->emitirBhe(self::$datos_boleta);

            $this->assertSame(200, $response->getStatusCode());

            if (self::$verbose) {
                echo "\n",'test_boleta_emitir() emitir ',$response->getBody(),"\n";
            }
        } catch (ApiException $e) {
            throw new ApiException(sprintf(
                '[ApiException %d] %s',
                $e->getCode(),
                $e->getMessage()
            ));
        }
    }
}
