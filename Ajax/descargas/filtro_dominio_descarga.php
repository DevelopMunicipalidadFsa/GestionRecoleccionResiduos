<?php
require_once '../../Controladores/ControladorViaje.php';
require_once '../../Modelos/ModeloViaje.php';
require_once '../../Controladores/ControladorCamiones.php';
require_once '../../Modelos/ModelosCamiones.php';

$dominio = $_POST['dominio'];
$fechaActual = date('Y-m-d H:i:s');

// $datosEquipo = ControladoresViajes::CtrlPersonasGrupo($idGrupo);
$ValidaExistencia = ModelosCamiones::MdlConsultCamionExistencia($dominio);
foreach ($ValidaExistencia as $dominio) {
    $idDominio = $dominio['id'];
    $vencimientoSeguro = $dominio['vencimientoSeguro'];
}

if ($vencimientoSeguro < $fechaActual) {
    echo json_encode("seguro_vencido");
} else {
    echo json_encode($idDominio);
}
