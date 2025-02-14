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
 * Módulo que permite obtener información de receptores con los cuales se
 * haya interactuado.
 */
class Receptores extends ApiBase
{
    /**
     * Módulo que permite obtener información de receptores con los cuales se
     * haya interactuado.
     *
     * @param string|null $token Token de autenticación del usuario. Si no se
     * proporciona, se intentará obtener de una variable de entorno.
     * @param string|null $rut RUT del emisor de BHExpress. Si no se proporciona,
     * se intentará obtener de una variable de entorno.
     * @param string|null $url URL base de la API. Si no se proporciona, se
     * usará una URL por defecto.
     */
    public function __construct(
        string $token = null,
        string $rut = null,
        string $url = null
    ) {
        parent::__construct(token: $token, rut: $rut, url: $url);
    }

    /**
     * Recurso que permite obtener información de uno o más receptores con los
     * que ya se haya interactuado.
     *
     * @return \Psr\Http\Message\ResponseInterface Respuesta con la lista de
     * receptores.
     */
    public function listarReceptores(): ResponseInterface
    {
        $url = '/bhe/receptores';

        $response = $this->get(resource: $url);

        return $response;
    }

    /**
     * Recurso que permite obtener información de un receptor específico con el
     * que ya se haya interactuado.
     *
     * @param int $rut RUT del receptor a ser buscado, sin puntos ni DV (opcional).
     * @param int $codigo Código del receptor (opcional).
     * @return \Psr\Http\Message\ResponseInterface Respuesta con la
     * información del receptor.
     */
    public function obtenerDetalleReceptor(
        int $rut = null,
        int $codigo = null
    ): ResponseInterface {
        $url = '/bhe/receptores';

        if (isset($rut)) {
            $url = sprintf('%s/%d', $url, $rut);
        }
        if (isset($codigo)) {
            $url = sprintf('%s/%d', $url, $codigo);
        }

        $response = $this->get(resource: $url);

        return $response;
    }
}
