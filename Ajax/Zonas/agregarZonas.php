<?php
    include_once("../../Controladores/ControladorGestor.php");
    include_once("../../Modelos/ModeloGestor.php");

    $arrayBarriosXZona = $_POST['zona'];

    $insertarZona=ControladorGestor::ctrRegistrarZona($arrayBarriosXZona); 
    echo json_encode($insertarZona);
?>