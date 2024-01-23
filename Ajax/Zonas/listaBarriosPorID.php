<?php
    include_once("../../Controladores/ControladorGestor.php");
    include_once("../../Modelos/ModeloGestor.php");

    $nroZona = $_POST['nroZona'];
    $listadoBarriosPorID = ControladorGestor::CtrMostrarBarriosPorID($nroZona);
    $listado = json_encode($listadoBarriosPorID);

    echo $listado;
?>