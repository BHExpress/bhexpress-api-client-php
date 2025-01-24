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

namespace bhexpress\api_client;

/**
 * Clase base para las clases que consumen la API (wrappers).
 */
class ApiBase extends ApiClient
{
    /**
     * Clase base para las clases que consumen la API (wrappers).
     *
     * @param string $token Token de autenticación para la API
     * @param string $rut RUT del emisor de BHExpress.
     * @param string $url Versión de la API.
     */
    public function __construct(
        string $token = null,
        string $rut = null,
        string $url = null
    ) {
        parent::__construct($token, $rut, $url);
    }
}
