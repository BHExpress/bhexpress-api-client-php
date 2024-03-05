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

namespace bhexpress\api_client;

/**
 * Clase abstracta para trabajar con recursos de la API
 * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
 * @version 2021-04-22
 */
abstract class Base
{

    protected $client;

    /**
     * Constructor de la clase.
     *
     * Este método inicializa una nueva instancia del cliente de API BHExpress.
     * Permite la configuración inicial del token de autenticación y la URL base de la API.
     *
     * @param string|null $token Token de autenticación para las solicitudes a la API.
     *                    Si se proporciona, se utilizará para autenticar todas las solicitudes.
     *                    De lo contrario, se debe establecer más adelante mediante un método apropiado.
     * @param string|null $url URL base de la API de BHExpress.
     *                    Si se proporciona, se establecerá como la URL base para todas las solicitudes.
     *                    De lo contrario, se debe configurar más adelante para que el cliente funcione correctamente.
     */

    public function __construct($token = null, $url = null)
    {
        $this->client = new ApiClient($token, $url);
    }

}
