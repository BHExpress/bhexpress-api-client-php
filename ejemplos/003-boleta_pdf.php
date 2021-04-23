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
 *  - Descargar el PDF de una boleta de honorarios electrónica
 * @link https://documenter.getpostman.com/view/5911929/TzCMbnYo#1a3a16a5-7601-44dd-b1a2-be531bb4b1dc
 * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
 * @version 2021-04-22
 */

// datos a utilizar
$url = getenv('BHEXPRESS_API_URL', 'https://bhexpress.cl');
$token = getenv('BHEXPRESS_API_TOKEN');
$rut = getenv('BHEXPRESS_EMISOR_RUT');
$numero = 226;

// incluir autocarga de composer
require('../vendor/autoload.php');

// crear cliente
$Boleta = new \sasco\BHExpress\API\Boleta($token, $url);

// obtener PDF de la boleta
try {
    $pdf = $Boleta->pdf($rut, $numero);
} catch (\sasco\BHExpress\API\Exception $e) {
    die('Error #'.$e->getCode().': '.$e->getMessage()."\n");
}

// guardar PDF en el sistema de archivos
file_put_contents($rut . '_bhe_'. $numero . '.pdf', $pdf);
