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

namespace bhexpress\api_client\bhe;

use bhexpress\api_client\ApiBase;
use Psr\Http\Message\ResponseInterface;

/**
 * Módulo que permite obtener información de servicios registrados que
 * provees desde la cuenta de BHExpress.
 */
class Servicios extends ApiBase
{
    /**
     * Módulo que permite obtener información de servicios registrados
     * que provees desde la cuenta de BHExpress.
     *
     * @param string|null $token Token de autenticación del usuario. Si no se
     * proporciona, se intentará obtener de una variable de entorno.
     * @param string|null $rut RUT del emisor de BHExpress. Si no se proporciona,
     * se intentará obtener de una variable de entorno.
     * @param string|null $url URL base de la API. Si no se proporciona, se
     * usará una URL por defecto.
     */
    public function __construct($token = null, $rut = null, $url = null)
    {
        parent::__construct(token: $token, rut: $rut, url: $url);
    }

    /**
     * Recurso que permite obtener una lista de servicios provistos por el usuario.
     *
     * @return \Psr\Http\Message\ResponseInterface Respuesta con el servicio
     * (o lista de servicios) provisto en BHExpress.
     */
    public function listarServicios(): ResponseInterface
    {
        $url = '/bhe/servicios';

        $response = $this->get(resource: $url);

        return $response;
    }

    /**
     * Recurso que permite obtener información de un servicio provisto específico.
     *
     * @param string $codigo Código del servicio prestado en BHExpress.
     * @param array $filtros Filtros adicionales.
     * @return \Psr\Http\Message\ResponseInterface Respuesta con el servicio
     * (o lista de servicios) provisto en BHExpress.
     */
    public function obtenerDetalleServicio(
        string $codigo,
        array $filtros
    ): ResponseInterface {
        $url = sprintf('/bhe/servicios/%s', $codigo);

        if (count($filtros) > 0) {
            $queryString = http_build_query($filtros);
            $url = sprintf('%s?%s', $url, $queryString);
        }

        $response = $this->get(resource: $url);

        return $response;
    }
}
