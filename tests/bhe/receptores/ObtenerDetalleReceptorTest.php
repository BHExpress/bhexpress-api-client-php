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
use bhexpress\api_client\bhe\Receptores;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Receptores::class)]
/**
 * Clase de pruebas para obtener el detalle de un receptor.
 */
class ObtenerDetalleReceptorTest extends TestCase
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
     * @var Receptores
     */
    protected static $client;

    public static function setUpBeforeClass(): void
    {
        self::$verbose = env(varname: 'TEST_VERBOSE', default: false);
        self::$client = new Receptores();
    }

    /**
     * Método de test que prueba el recurso para obtener detalles de un receptor
     * con el que ya se haya interactuado.
     *
     * @throws \bhexpress\api_client\ApiException si el receptor no existe, si la
     * búsqueda falla, o si no hay conexión.
     * @return void
     */
    public function testObtenerDetalleReceptor(): void
    {
        try {
            $responseLista = self::$client->listarReceptores();
            $listaDec = json_decode(
                json: $responseLista->getBody()->getContents(),
                associative: true
            )['results'][0];
            $rut = $listaDec['rut'];

            $response = self::$client->obtenerDetalleReceptor(rut: $rut);

            $this->assertSame(200, $response->getStatusCode());

            if (self::$verbose) {
                echo "\n",
                'test_detalle_receptores() detalle ',
                $response->getBody(),
                "\n";
            }
        } catch (ApiException $e) {
            throw new ApiException(message: sprintf(
                '[ApiException %d] %s',
                $e->getCode(),
                $e->getMessage()
            ));
        }
    }
}
