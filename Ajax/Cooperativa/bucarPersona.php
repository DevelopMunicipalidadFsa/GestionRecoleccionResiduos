<?php
    include_once("../../Controladores/ControladorGestor.php");
    include_once("../../Modelos/ModeloGestor.php");

    $buscarPersona = ControladorGestor::CtrBuscarPersonas($_POST["dni"]);
    // $datosPersona = json_encode($buscarPersona);
 
    print_r(json_encode($buscarPersona));