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
 * Wrapper para trabajar con una boleta de la API
 * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
 * @version 2021-04-22
 */
class Boleta extends Base
{

    /**
     * Emite un documento electrónico a través de la API.
     *
     * Este método envía los datos del documento a emitir a la API y devuelve la respuesta.
     * Requiere que el RUT del emisor esté presente en los datos proporcionados.
     *
     * @param array $datos Datos del documento a emitir, incluido el RUT del emisor.
     * @throws ApiException Si falta el RUT del emisor en los datos proporcionados.
     * @return mixed Respuesta de la API decodificada del cuerpo de la respuesta HTTP.
     */
    public function emitir($datos)
    {
        if (empty($datos['Encabezado']['Emisor']['RUTEmisor'])) {
            throw new ApiException('Falta RUTEmisor');
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

    /**
     * Obtiene el PDF de un documento electrónico emitido.
     *
     * Solicita a la API el PDF del documento identificado por el número de documento y el emisor.
     *
     * @param string $emisor RUT del emisor del documento.
     * @param int $numero Número del documento del cual se desea obtener el PDF.
     * @return mixed Cuerpo de la respuesta HTTP, que se espera contenga el PDF del documento.
     */
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

    /**
     * Envía por correo electrónico un documento electrónico emitido.
     *
     * Este método solicita a la API enviar por correo electrónico el documento identificado
     * por el número de documento y el emisor al destinatario especificado.
     *
     * @param string $emisor RUT del emisor del documento.
     * @param int $numero Número del documento a enviar.
     * @param string $email Dirección de correo electrónico del destinatario.
     * @return mixed Respuesta de la API decodificada del cuerpo de la respuesta HTTP.
     */
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

    /**
     * Anula un documento electrónico emitido.
     *
     * Este método envía una solicitud a la API para anular un documento específico,
     * identificado por el número de documento y el emisor, con una causa de anulación.
     *
     * @param string $emisor RUT del emisor del documento.
     * @param int $numero Número del documento a anular.
     * @param string $causa Razón o causa de la anulación del documento.
     * @return mixed Respuesta de la API decodificada del cuerpo de la respuesta HTTP.
     */
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
