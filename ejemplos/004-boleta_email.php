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
 *  - Enviar por email una boleta de honorarios electrónica
 * @link https://documenter.getpostman.com/view/5911929/TzCMbnYo#5b00089b-2fbf-458b-af81-8475640fef69
 * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
 * @version 2021-04-22
 */

// datos a utilizar
$url = getenv('BHEXPRESS_API_URL', 'https://bhexpress.cl');
$token = getenv('BHEXPRESS_API_TOKEN');
$rut = getenv('BHEXPRESS_EMISOR_RUT');
$numero = 226;
$email = '';

// incluir autocarga de composer
require('../vendor/autoload.php');

// crear cliente
$Boleta = new \sasco\BHExpress\API\Boleta($token, $url);

// obtener PDF de la boleta
try {
    $resultado = $Boleta->email($rut, $numero, $email);
} catch (\sasco\BHExpress\API\Exception $e) {
    die('Error #'.$e->getCode().': '.$e->getMessage()."\n");
}

// mostrar resultado
print_r($resultado);
