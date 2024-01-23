<?php
    include_once("../../Controladores/ControladorGestor.php");
    include_once("../../Modelos/ModeloGestor.php");

    $listadoBarrio = ControladorGestor::CtrListadoBarrios();
    // $listadoBarrio = json_encode($listadoBarrio);
    
    $response = array();

    // Leer los datos de MySQL
    foreach($listadoBarrio as $pro){
        $response[] = array(
        "id" => $pro['Id'],
        "text" => $pro['Detalle']
        );
    }

echo json_encode($response);
    // print_r($listadoBarrio);