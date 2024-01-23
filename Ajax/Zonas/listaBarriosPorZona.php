<?php
include_once("../../Controladores/ControladorGestor.php");
include_once("../../Modelos/ModeloGestor.php");

$listadoBarriosPorZona = ControladorGestor::CtrMostrarBarriosPorZona();
$listado = json_encode($listadoBarriosPorZona);

echo $listado;
// json_encode($listadoBarriosPorZona);
