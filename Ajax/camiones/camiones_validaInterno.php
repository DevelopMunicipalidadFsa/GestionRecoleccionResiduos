<?php

require_once '../../Controladores/ControladorCamiones.php';
require_once '../../Modelos/ModelosCamiones.php';


$interno = $_POST['interno'];

$ValidaInterno = ControladorCamiones::CtrlValidaInterno($interno);
// Crear un array con el resultado

if (empty($ValidaInterno)) {
    $existe = 'no existe';
} else {
    $existe = 'existe';
}


$respuesta = array("existe" => $existe);

// Convertir el array a JSON y devolverlo
echo json_encode($respuesta);
