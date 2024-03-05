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
use bhexpress\api_client\Boletas;
use bhexpress\api_client\ApiException;

class BoletasListadoTest extends TestCase
{
    protected static $Boletas;
    protected static $url;
    protected static $token;
    protected static $rut;
    protected static $page;

    public static function setUpBeforeClass(): void
    {
        self::$url = env('BHEXPRESS_API_URL', 'https://bhexpress.cl');
        self::$token = env('BHEXPRESS_API_TOKEN');
        self::$rut = env('BHEXPRESS_EMISOR_RUT');
        self::$page = 1;

        // Inicializar el cliente API de Boletas
        self::$Boletas = new Boletas(self::$token, self::$url);
    }

    public function testObtenerListadoBoletas()
    {
        $filtros = [
            'page' => self::$page,
            'periodo' => 202401,
            // 'fecha_desde' => '2021-01-01',
            // 'fecha_hasta' => '2021-03-31',
            // 'receptor_codigo' => '76192083',
        ];

        try {
            $response = self::$Boletas->listado(self::$rut, $filtros);
            $this->assertEquals(200, $response->getStatusCode());
            if (self::$verbose) {
                echo "\n",'test_situacion_tributaria_tercero() situacion_tributaria ',$response->getBody(),"\n";
            }
        } catch (ApiException $e) {
            $this->fail(sprintf('[ApiException %d] %s', $e->getCode(), $e->getMessage()));
        }
    }
}
 
