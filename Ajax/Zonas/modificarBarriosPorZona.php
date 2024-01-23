<?php
    include_once("../../Controladores/ControladorGestor.php");
    include_once("../../Modelos/ModeloGestor.php");

    $arrayBarriosDeZona = $_POST['zona'];

    $modificarBarrioDeZona=ControladorGestor::ctrRegistrarZona($arrayBarriosDeZona); 
    echo json_encode($modificarBarrioDeZona);
