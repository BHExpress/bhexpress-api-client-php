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
 * Clase de pruebas para obtener un listado de receptores.
 */
class ListarReceptoresTest extends TestCase
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
     * Método de test que pueba el recurso de listar receptores.
     *
     * @throws \bhexpress\api_client\ApiException si la búsqueda falla, o si
     * no hay conexión.
     * @return void
     */
    public function testListarReceptores(): void
    {
        try {
            $response = self::$client->listarReceptores();

            $this->assertTrue(true);

            if (self::$verbose) {
                echo "\n",
                'test_listar_receptores() listar ',
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
