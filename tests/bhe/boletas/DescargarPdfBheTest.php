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
 * Clase de pruebas para obtener un PDF a partir de una BHE existente.
 */
class DescargarPdfBheTest extends AbstractBoletas
{
    /**
     * Variable que permite desplegar en consola los resultados.
     *
     * @var bool
     */
    protected static $verbose;

    /**
     * RUT del emisor de la BHE.
     *
     * @var string
     */
    protected static $emisor_rut;

    public static function setUpBeforeClass(): void
    {
        self::$verbose = env('TEST_VERBOSE', false);
        self::$client = new Bhe();
        self::$emisor_rut = env('BHEXPRESS_EMISOR_RUT');
    }

    /**
     * Clase de test para probar recurso que descarga un PDF a partir de un
     * código de una BHE existente.
     *
     * @throws \bhexpress\api_client\ApiException si la búsqueda falla, si la BHE
     * no existe, o si no hay conexión.
     * @return void
     */
    public function testDescargarPdfBhe()
    {
        $response_body = $this->listar();

        $body_dec = json_decode($response_body->getBody()->getContents(), true);
        $numero_bhe = $body_dec['results'][0]['numero'];

        try {
            $response = self::$client->descargarPdfBhe($numero_bhe);

            $this->assertNotEmpty($response, 'El contenido del PDF no debe estar vacío');

            // Ruta base para el directorio actual (archivo ejecutándose en
            // "tests/dte_facturacion")
            $currentDir = __DIR__;

            // Nueva ruta relativa para guardar el archivo PDF en "tests/archivos"
            $targetDir = dirname(dirname($currentDir)) . '/archivos/bhe_emitidas_pdf';

            // Define el nombre del archivo PDF en el nuevo directorio
            $filename = $targetDir . '/' . sprintf(
                'BHEXPRESS_BHE_EMITIDA_%s_bhe_%d.pdf',
                self::$emisor_rut,
                $numero_bhe
            );

            // Verifica si el directorio existe, si no, créalo
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0777, true);
            }

            // Se genera el archivo PDF.
            file_put_contents($filename, $response->getBody());

            $this->assertFileExists($filename, 'El archivo PDF debe existir en el sistema de archivos');

            if (self::$verbose) {
                echo "\n",'test_boleta_pdf() pdf ',' Se ha generado exitosamente un PDF. ',"\n";
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
