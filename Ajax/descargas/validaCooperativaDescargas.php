<?php
require_once '../../Controladores/ControladorViaje.php';
require_once '../../Modelos/ModeloViaje.php';

$idCooperativa = $_POST['idCooperativa'];
$fechaActual = date('Y-m-d H:i:s');

// $datosCoop = ControladoresViajes::CtrlGruposCooperativa($idCooperativa);

$listadoCooperativas = ControladoresViajes::CtrlValidaCooperativas($idCooperativa);

foreach ($listadoCooperativas as $Lista) {
    $vencimiento = $Lista['seguroVencimiento'];
}

if ($vencimiento < $fechaActual) {
    echo json_encode("seguro_coop_vencido");
} else {
    echo json_encode($vencimiento);
}






// $gruposCoop = array();

// // Agregar la opción por defecto
// $opcionPorDefecto = array(
//     "grupo" => "SELECCIONAR GRUPO",
//     "id" => "0",
// );
// $gruposCoop[] = $opcionPorDefecto;

// // Recorrer los datos y agregar las opciones basadas en los datos recibidos
// foreach ($datosCoop as $grupo) {
//     $nuevaOpcion = array(
//         "grupo" => $grupo['grupo'],
//         "id" => $grupo['id'],
//     );
//     $gruposCoop[] = $nuevaOpcion;
// }
