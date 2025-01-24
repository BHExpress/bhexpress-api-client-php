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
use bhexpress\api_client\bhe\Servicios;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Servicios::class)]
/**
 * Clase de pruebas para obtener información de un servicio provisto.
 */
class ObtenerInfoServicioTest extends TestCase
{
    /**
     * Variable que permite desplegar en consola los resultados.
     *
     * @var bool
     */
    protected static $verbose;

    /**
     * Instancia de servicios API Client a través de Receptores.
     *
     * @var Servicios
     */
    protected static $client;

    public static function setUpBeforeClass(): void
    {
        self::$verbose = env('TEST_VERBOSE', false);
        self::$client = new Servicios();
    }

    /**
     * Método de test que prueba el recurso para obtener información de un
     * servicio específico provisto.
     *
     * @throws \bhexpress\api_client\ApiException
     * @return void
     */
    public function testObtenerInfoServicio()
    {
        $filtros = [
            'montos_clp' => 'bruto',
            'fecha' => '2025-01-01',
        ];
        try {
            $responseServicio = self::$client->listarServicios();
            $servicioDec = json_decode($responseServicio->getBody()->getContents(), true);

            $codigo = $servicioDec['results'][0]['codigo'];

            $response = self::$client->obtenerDetalleServicio($codigo, $filtros);

            $this->assertSame(200, $response->getStatusCode());

            if (self::$verbose) {
                echo "\n",'test_obtener_info_servicio() servicio ',$response->getBody(),"\n";
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
