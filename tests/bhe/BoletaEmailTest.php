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

class BoletaEmailTest extends TestCase
{

    protected static $verbose;
    protected static $client;
    protected static $emisor_rut;
    protected static $email;

    public static function setUpBeforeClass(): void
    {
        self::$verbose = env('TEST_VERBOSE', false);
        self::$client = new ApiClient();
        self::$emisor_rut = env('BHEXPRESS_EMISOR_RUT');
        self::$email = env('TEST_CORREO', '');
    }

    private function _buscar(): Psr\Http\Message\MessageInterface
    {
        $fecha_desde = '2015-12-31';
        $fecha_hasta = date('Y-m-d');
        $url = '/bhe/boletas?fecha_desde='.$fecha_desde.'&fecha_hasta='.$fecha_hasta; # Buscar algo similar a urlencode
        try {
            $response = self::$client->get($url);

        } catch (ApiException $e) {
            throw new ApiException (sprintf('[ApiException %d] %s', $e->getCode(), $e->getMessage()));
        }
        return $response;
    }

    public function test_boleta_email()
    {
        $response_body = $this->_buscar();
        $body_dec = json_decode($response_body->getBody()->getContents(), true);
        $numero_bhe = $body_dec['results'][0]['numero'];
        $url = '/bhe/email/'.$numero_bhe;

        $destinatario = [
            'destinatario' => [
                'email' => self::$email
            ]
        ];

        try {
            $response = self::$client->post($url, $destinatario);
            $this->assertEquals(200, $response->getStatusCode());

            if (self::$verbose) {
                echo "\n",'test_boleta_email() email ',$response->getBody(),"\n";
            }
        } catch (ApiException $e) {
            $this->fail(sprintf('[ApiException %d] %s', $e->getCode(), $e->getMessage()));
        }
    }
}
