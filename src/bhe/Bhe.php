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
 * Módulo que permite gestionar las BHE registradas y/o sincronizadas
 * en BHExpress.
 */
class Bhe extends ApiBase
{
    /**
     * Módulo que permite gestionar las BHE registradas y/o sincronizadas
     * en BHExpress.
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
     * Recurso que permite obtener el listado paginado de boletas de honorarios
     * electrónicas emitidas.
     *
     * @param array $filtros Filtros para obtener BHEs específicas (opcional).
     * @return \Psr\Http\Message\ResponseInterface Respuesta con el listado
     * de boletas emitidas.
     */
    public function listarBhes(array $filtros = []): ResponseInterface
    {
        $url = '/bhe/boletas';
        if (count($filtros) > 0) {
            $queryString = http_build_query($filtros);
            $url = sprintf('%s?%s', $url, $queryString);
        }

        $response = $this->get(resource: $url);

        return $response;
    }

    /**
     * Recurso que permite obtener el detalle de una boleta de honorarios
     * electrónica emitida.
     *
     * @param int $numeroBhe Número de la BHE emitida.
     * @return \Psr\Http\Message\ResponseInterface Respuesta con el detalle
     * de la boleta emitida.
     */
    public function obtenerDetalleBhe(int $numeroBhe): ResponseInterface
    {
        $url = sprintf('/bhe/boletas/%d', $numeroBhe);

        $response = $this->get(resource: $url);

        return $response;
    }

    /**
     * Recurso que permite emitir una nueva Boleta de Honorarios Electrónica.
     *
     * @param array $datosBoleta Información detallada de la boleta a emitir.
     * @return \Psr\Http\Message\ResponseInterface Respuesta con el
     * encabezado y detalle de la boleta emitida.
     */
    public function emitirBhe(array $datosBoleta): ResponseInterface
    {
        $url = '/bhe/emitir';

        $response = $this->post(resource: $url, data: $datosBoleta);

        return $response;
    }

    /**
     * Recurso que permite descargar el PDF de una Boleta de Honorarios
     * Electrónica específica.
     *
     * @param int $numeroBhe Número de la BHE registrada en BHExpress.
     * @return \Psr\Http\Message\ResponseInterface Respuesta con el
     * contenido del PDF de la BHE.
     */
    public function descargarPdfBhe(int $numeroBhe): ResponseInterface
    {
        $url = sprintf('/bhe/pdf/%d', $numeroBhe);

        $response = $this->get(resource: $url);

        return $response;
    }

    /**
     * Recurso que permite enviar por correo electrónico una BHE.
     *
     * @param int $numeroBhe Número de la BHE registrada en BHExpress.
     * @param string $email Correo del destinatario.
     * @return \Psr\Http\Message\ResponseInterface Respuesta con la
     * confirmación del envío del email.
     */
    public function enviarEmailBhe(
        int $numeroBhe,
        string $email
    ): ResponseInterface {
        $url = sprintf('/bhe/email/%d', $numeroBhe);
        $data = [
            'destinatario' => [
                'email' => $email,
            ],
        ];

        $response = $this->post(resource: $url, data: $data);

        return $response;
    }

    /**
     * Recurso que permite anular una Boleta de Honorarios Electrónica
     * específica.
     *
     * @param int $numeroBhe Número de la BHE registrada en BHExpress.
     * @param int $causa Causa de la anulación de la BHE.
     * @return \Psr\Http\Message\ResponseInterface Respuesta con el
     * encabezado de la boleta anulada.
     */
    public function anularBhe(
        int $numeroBhe,
        int $causa
    ): ResponseInterface {
        $url = sprintf('/bhe/anular/%d', $numeroBhe);

        $data = [
            'causa' => $causa,
        ];

        $response = $this->post(resource: $url, data: $data);

        return $response;
    }

    /**
     * Recurso que permite calcular el monto líquido a partir de un monto bruto.
     *
     * @param int $bruto Monto bruto a convertir.
     * @param string $periodo Periodo para el cual calcular los totales.
     * @return \Psr\Http\Message\ResponseInterface Respuesta con el
     * monto líquido calculado.
     */
    public function calcularMontoLiquido(
        int $bruto,
        string $periodo
    ): ResponseInterface {
        $url = sprintf('/bhe/liquido/%d/%s', $bruto, $periodo);

        $response = $this->get(resource: $url);

        return $response;
    }

    /**
     * Recurso que permite calcular el monto bruto a partir de un monto líquido.
     *
     * @param int $liquido Monto líquido a convertir.
     * @param string $periodo Periodo para el cual calcular los totales.
     * @return \Psr\Http\Message\ResponseInterface Respuesta con el
     * monto bruto calculado.
     */
    public function calcularMontoBruto(
        int $liquido,
        string $periodo
    ): ResponseInterface {
        $url = sprintf('/bhe/bruto/%d/%s', $liquido, $periodo);

        $response = $this->get(resource: $url);

        return $response;
    }
}
