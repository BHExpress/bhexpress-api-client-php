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
 * Clase de pruebas para anular una Boleta de Honorarios Electrónica emitida.
 */
class AnularBheTest extends AbstractBoletas
{
    /**
     * Variable que permite desplegar en consola los resultados.
     *
     * @var bool
     */
    protected static $verbose;

    public static function setUpBeforeClass(): void
    {
        self::$verbose = env(varname: 'TEST_VERBOSE', default: false);
        self::$client = new Bhe();
    }

    /**
     * Método de test que prueba el recurso de anular una BHE.
     *
     * @throws \bhexpress\api_client\ApiException si la BHE no existe, si la
     * búsqueda falla, o si ocurre un error de conexión.
     * @return void
     */
    public function testAnularBhe(): void
    {
        $causa = 3;

        $listaBhes = $this->listar();
        $body_dec = json_decode(
            json: $listaBhes->getBody()->getContents(),
            associative: true
        )['results'][0];
        $numeroBhe = $body_dec['numero'];

        try {
            $response = self::$client->anularBhe($numeroBhe, $causa);

            $this->assertSame(200, $response->getStatusCode());

            if (self::$verbose) {
                echo "\n",
                'test_boleta_anular() anular ',
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
