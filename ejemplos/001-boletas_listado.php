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

/**
 * Ejemplo que muestra los pasos para:
 *  - Consultar el listado de boletas de honorarios emitidas
 * @link https://documenter.getpostman.com/view/5911929/TzCMbnYo#2374fc68-76b1-455f-b367-36ca4fef2c5f
 * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
 * @version 2021-04-22
 */

// datos a utilizar
$url = getenv('BHEXPRESS_API_URL', 'https://bhexpress.cl');
$token = getenv('BHEXPRESS_API_TOKEN');
$rut = getenv('BHEXPRESS_EMISOR_RUT');
$page = 1;

// incluir autocarga de composer
require('../vendor/autoload.php');

// crear cliente
$Boletas = new \sasco\BHExpress\API\Boletas($token, $url);

// obtener boletas
try {
    $boletas = $Boletas->listado($rut, [
        'page' => $page,
        'periodo' => 202104,
        //'fecha_desde' => '2021-01-01',
        //'fecha_hasta' => '2021-03-31',
        //'receptor_codigo' => '76192083',
    ]);
} catch (\sasco\BHExpress\API\Exception $e) {
    die('Error #'.$e->getCode().': '.$e->getMessage()."\n");
}

// mostrar boletas
print_r($boletas);
