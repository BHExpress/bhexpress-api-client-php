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

class BoletaPdfTest extends TestCase
{
    protected static $Boleta;
    protected static $url;
    protected static $token;
    protected static $rut;
    protected static $numero;
    protected static $archivoPdf;

    public static function setUpBeforeClass(): void
    {
        self::$url = getenv('BHEXPRESS_API_URL', 'https://bhexpress.cl');
        self::$token = getenv('BHEXPRESS_API_TOKEN');
        self::$rut = getenv('BHEXPRESS_EMISOR_RUT');
        self::$numero = 226;
        self::$archivoPdf = self::$rut . '_bhe_' . self::$numero . '.pdf';

        // Inicializar el cliente API de Boleta
        self::$Boleta = new Boleta(self::$token, self::$url);
    }

    public function testObtenerYPdfBoleta()
    {
        try {
            $pdf = self::$Boleta->pdf(self::$rut, self::$numero);
            $this->assertNotEmpty($pdf, 'El contenido del PDF no debe estar vacío');

            // Intentar guardar el PDF en el sistema de archivos y verificar si el archivo existe
            file_put_contents(self::$archivoPdf, $pdf);
            $this->assertFileExists(self::$archivoPdf, 'El archivo PDF debe existir en el sistema de archivos');

        } catch (ApiException $e) {
            $this->fail(sprintf('[ApiException %d] %s', $e->getCode(), $e->getMessage()));
        } finally {
            // Limpiar: eliminar el archivo PDF después de la prueba para no dejar residuos
            if (file_exists(self::$archivoPdf)) {
                unlink(self::$archivoPdf);
            }
        }
    }
}
