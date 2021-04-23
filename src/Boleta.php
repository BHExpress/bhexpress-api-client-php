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

namespace sasco\BHExpress\API;

/**
 * Wrapper para trabajar con una boleta de la API
 * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
 * @version 2021-04-22
 */
class Boleta extends Base
{

    public function emitir($datos)
    {
        if (empty($datos['Encabezado']['Emisor']['RUTEmisor'])) {
            throw new Exception('Falta RUTEmisor');
        }
        $resource = '/bhe/emitir';
        return $this->client->consume(
            $resource,
            $datos,
            [
                'X-Bhexpress-Emisor' => $datos['Encabezado']['Emisor']['RUTEmisor'],
            ]
        )->getBodyDecoded();
    }

    public function pdf($emisor, $numero)
    {
        $resource = '/bhe/pdf/' . (int)$numero;
        return $this->client->consume(
            $resource,
            [],
            [
                'X-Bhexpress-Emisor' => $emisor,
            ]
        )->getBody();
    }

    public function email($emisor, $numero, $email)
    {
        $resource = '/bhe/email/' . (int)$numero;
        return $this->client->consume(
            $resource,
            [
                'destinatario' => [
                    'email' => $email,
                ],
            ],
            [
                'X-Bhexpress-Emisor' => $emisor,
            ]
        )->getBodyDecoded();
    }

    public function anular($emisor, $numero, $causa)
    {
        $resource = '/bhe/anular/' . (int)$numero;
        return $this->client->consume(
            $resource,
            [
                'causa' => $causa,
            ],
            [
                'X-Bhexpress-Emisor' => $emisor,
            ]
        )->getBodyDecoded();
    }

}
