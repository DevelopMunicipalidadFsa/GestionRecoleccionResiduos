<?php
    include_once("../../Controladores/ControladorGestor.php");
    include_once("../../Modelos/ModeloGestor.php");

    $barrioZona = $_POST['barrioZona'];

    $insertarBarrioZona=ControladorGestor::ctrRegistrarBarriosPorZona($barrioZona); 
    echo json_encode($insertarBarrioZona);
?>

