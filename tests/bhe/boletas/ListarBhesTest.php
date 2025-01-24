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
 * Clase de pruebas para listar BHEs.
 */
class ListarBhesTest extends AbstractBoletas
{
    /**
     * Variable que permite desplegar en consola los resultados.
     *
     * @var bool
     */
    protected static $verbose;

    public static function setUpBeforeClass(): void
    {
        self::$verbose = env('TEST_VERBOSE', false);
        self::$client = new Bhe();
    }

    /**
     * Método de test que prueba el recurso de listar BHEs emitidas.
     *
     * @throws \bhexpress\api_client\ApiException si los filtros son incorrectos,
     * o si la conexión falla.
     * @return void
     */
    public function testListarBhes()
    {
        try {
            $fecha_desde = env(
                'TEST_FECHA_DESDE',
                date('Y-m-d', strtotime('-30 days'))
            );
            $filtros = [
                'fecha_desde' => $fecha_desde,
                'fecha_hasta' => date('Y-m-d'),
            ];
            $response = self::$client->listarBhes($filtros);

            $this->assertTrue(true);

            if (self::$verbose) {
                echo "\n",'test_boleta_listar() listar ',$response->getBody(),"\n";
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
