<?php
    include_once("../../Controladores/ControladorGestor.php");
    include_once("../../Modelos/ModeloGestor.php");

    $idBarrio = $_POST['idBarrio'];
    $validarBarrioPorZona = ControladorGestor::CtrValidarBarrioPorZona($idBarrio);
    $validarBarrio = json_encode($validarBarrioPorZona);

    echo $validarBarrio;
