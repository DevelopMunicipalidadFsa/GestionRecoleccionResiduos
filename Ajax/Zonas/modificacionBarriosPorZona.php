<?php
    include_once("../../Controladores/ControladorGestor.php");
    include_once("../../Modelos/ModeloGestor.php");

    $nroZona = $_POST['nroZona'];
    
    $id = ControladorGestor::obtenerIdZonaPorNro($nroZona);

    $modificarBarriosPorZona = ControladorGestor::CtrModificarBarriosPorZona($nroZona);

    $respuesta = array(
        'nroZona' => $nroZona,
        'idZona' => $id,
        'barrios' => $modificarBarriosPorZona
    );

    echo json_encode($respuesta);
?>
