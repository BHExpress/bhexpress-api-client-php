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

namespace bhexpress\tests\bhe;

use bhexpress\api_client\ApiException;
use bhexpress\api_client\bhe\Bhe;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

/**
 * Clase abstracta que permite ejecutar un método compartido entre sus clases hijas.
 */
class AbstractBoletas extends TestCase
{
    /**
     * Instancia de servicios API Client a través de Bhe.
     *
     * @var Bhe
     */
    protected static $client;

    /**
     * Método protegido para buscar una boleta específica.
     * @throws \bhexpress\api_client\ApiException si TEST_FECHA_DESDE no está
     * correctamente definida.
     * @return \Psr\Http\Message\ResponseInterface Respuesta con la lista de BHEs
     * filtradas.
     */
    protected function listar(): ResponseInterface
    {
        $fecha_desde = env(
            varname: 'TEST_FECHA_DESDE',
            default: date(
                format: 'Y-m-d',
                timestamp: strtotime('-30 days')
            )
        );
        $filtros = [
            'fecha_desde' => $fecha_desde,
            'fecha_hasta' => date('Y-m-d'),
        ];

        try {
            $response = self::$client->listarBhes(filtros: $filtros);

        } catch (ApiException $e) {
            throw new ApiException(message: sprintf(
                '[ApiException %d] %s',
                $e->getCode(),
                $e->getMessage()
            ));
        }
        return $response;
    }
}
