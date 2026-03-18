<?php

declare(strict_types=1);

/**
 * BHExpress: Cliente de API en PHP.
 * Copyright (C) BHExpress <https://www.bhexpress.cl>
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
use bhexpress\tests\Helpers\FunctionHelpers;

#[CoversClass(Bhe::class)]
/**
 * Clase de pruebas que permite probar el cálculo de un monto bruto.
 */
class CalcularMontoBrutoTest extends AbstractBoletas
{
    use FunctionHelpers;
    /**
     * Variable que permite desplegar en consola los resultados.
     *
     * @var bool
     */
    protected static $verbose;

    public static function setUpBeforeClass(): void
    {
        self::requireEnv('BHEXPRESS_API_TOKEN');
        self::$verbose = env(varname: 'TEST_VERBOSE', default: false);
        self::$client = new Bhe();
    }

    /**
     * Método de test que prueba el recurso de calcular un monto bruto a partir
     * de un monto líquido y un periodo específico.
     * @throws \bhexpress\api_client\ApiException si ocurre un error en la API o
     * si falla la conexión.
     * @return void
     */
    public function testCalcularMontoBruto(): void
    {
        $valorLiquido = 100000;
        $fecha = date('Y').'01';
        try {
            $response = self::$client->calcularMontoBruto(
                $valorLiquido,
                $fecha
            );

            $this->assertSame(200, $response->getStatusCode());

            if (self::$verbose) {
                echo "\n",
                'test_calcular_monto_bruto() detalle ',
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
