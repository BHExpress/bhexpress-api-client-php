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

class BoletaAnularTest extends TestCase
{

    protected static $verbose;
    protected static $client;
    protected static $emisor_rut;
    protected static $numero_bhe;
    protected static $causa;

    public static function setUpBeforeClass(): void
    {
        self::$verbose = env('TEST_VERBOSE', false);
        self::$client = new ApiClient();
        self::$emisor_rut = env('BHEXPRESS_EMISOR_RUT');
        self::$numero_bhe = env('TEST_EMAIL_NUMEROBHE', '0');
        self::$causa = 3;
    }

    public function test_boleta_anular()
    {
        $url = '/bhe/anular/'.self::$numero_bhe;
        $causa = [
            'causa' => self::$causa
        ];
        try {
            $response = self::$client->post($url, $causa);
            $this->assertEquals(200, $response->getStatusCode());

            if (self::$verbose) {
                echo "\n",'test_boleta_anular() anular ',$response->getBody(),"\n";
            }
        } catch (ApiException $e) {
            $this->fail(sprintf('[ApiException %d] %s', $e->getCode(), $e->getMessage()));
        }
    }
}
