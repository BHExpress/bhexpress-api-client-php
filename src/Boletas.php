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
 * Wrapper para trabajar con un grupo de boletas de la API
 * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
 * @version 2021-04-22
 */
class Boletas extends Base
{

    /**
     * Obtiene un listado de boletas electrónicas emitidas por el emisor especificado, aplicando filtros opcionales.
     *
     * Este método consulta la API para obtener un listado de boletas, permitiendo la aplicación de filtros
     * para refinar los resultados obtenidos, como fechas de emisión, rangos de montos, estados, entre otros.
     * La solicitud incluye el RUT del emisor en los encabezados para identificar al emisor de las boletas.
     *
     * @param string $emisor RUT del emisor de las boletas.
     * @param array $filtros (opcional) Arreglo asociativo de filtros para aplicar a la consulta de listado.
     *                        Los filtros deben ser compatibles con los aceptados por la API.
     * @return mixed Respuesta de la API decodificada del cuerpo de la respuesta HTTP, generalmente un arreglo
     *               de objetos o un objeto que contiene el listado de boletas y metadatos asociados.
     */
    public function listado(string $emisor, array $filtros = [])
    {
        $resource = '/bhe/boletas?' . http_build_query($filtros);

        $response = $this->client->get($resource, [
            'X-Bhexpress-Emisor' => $emisor
        ]);

        return $response->getBody();
    }

}
