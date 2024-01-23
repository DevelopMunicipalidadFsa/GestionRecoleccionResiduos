<?php
require_once '../../Controladores/ControladorCamiones.php';
require_once '../../Modelos/ModelosCamiones.php';

$idCamion = $_GET['idCamion'];
$fechaActual = date('Y-m-d H:i:s');
$datosChoferes = ControladorCamiones::CtrlListaChoferesCamion($idCamion);

$gruposCoop = array();

// Agregar la opción por defecto
$opcionPorDefecto = array(
    "nombre_completo" => "Seleccionar Chofer",
    "id" => "disabled",
);
$gruposCoop[] = $opcionPorDefecto;

// Recorrer los datos y agregar las opciones basadas en los datos recibidos
foreach ($datosChoferes as $grupo) {

    if ($grupo['fecVencimientoLicencia'] > $fechaActual) {
        $nuevaOpcion = array(
            "nombre_completo" => $grupo['apellidosNombres'],
            "id" => $grupo['id'],
        );
    } else {
        $nuevaOpcion = array(
            "nombre_completo" => $grupo['apellidosNombres'] . " (Licencia Vencida) ",
            "id" => null,
            "deshabilitado" => true,
        );
    }

    $gruposCoop[] = $nuevaOpcion;
}

echo json_encode($gruposCoop);
