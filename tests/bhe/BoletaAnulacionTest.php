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
use bhexpress\api_client\Boleta;
use bhexpress\api_client\ApiException;

class BoletaAnulacionTest extends TestCase
{
    protected static $Boleta;
    protected static $url;
    protected static $token;
    protected static $rut;
    protected static $numero;
    protected static $causa;

    public static function setUpBeforeClass(): void
    {
        self::$url = env('BHEXPRESS_API_URL', 'https://bhexpress.cl');
        self::$token = env('BHEXPRESS_API_TOKEN');
        self::$rut = env('BHEXPRESS_EMISOR_RUT');
        self::$numero = 226;
        self::$causa = 3;

        // Inicializar el cliente API de Boleta
        self::$Boleta = new Boleta(self::$token, self::$url);
    }

    public function testAnularBoleta()
    {
        try {
            $resultado = self::$Boleta->anular(self::$rut, self::$numero, self::$causa);
            $this->assertNotNull($resultado, 'El resultado no debe ser nulo');
            // Aquí puedes agregar más aserciones específicas, como verificar el mensaje de éxito, el código de estado, etc.
        } catch (ApiException $e) {
            $this->fail(sprintf('[ApiException %d] %s', $e->getCode(), $e->getMessage()));
        }
    }
}
