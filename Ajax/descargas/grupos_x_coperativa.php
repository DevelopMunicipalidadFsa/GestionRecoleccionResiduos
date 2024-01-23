<?php
require_once '../../Controladores/ControladorViaje.php';
require_once '../../Modelos/ModeloViaje.php';

$idCooperativa = $_GET['idCooperativa'];

$datosCoop = ControladoresViajes::CtrlGruposCooperativa($idCooperativa);

$gruposCoop = array();

// Agregar la opción por defecto
$opcionPorDefecto = array(
    "grupo" => "Seleccionar Grupo",
    "id" => "disabled",
);
$gruposCoop[] = $opcionPorDefecto;

// Recorrer los datos y agregar las opciones basadas en los datos recibidos
foreach ($datosCoop as $grupo) {
    $nuevaOpcion = array(
        "grupo" => $grupo['grupo'],
        "id" => $grupo['id'],
    );
    $gruposCoop[] = $nuevaOpcion;
}

echo json_encode($gruposCoop);
