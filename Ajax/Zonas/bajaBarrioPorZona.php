<?php
    include_once("../../Controladores/ControladorGestor.php");
    include_once("../../Modelos/ModeloGestor.php");

    $idBarrio = $_POST['idBarrio'];
    $bajaBarrioPorZona = ControladorGestor::CtrBajaBarrioPorZona($idBarrio);
    $bajaBarrio = json_encode($bajaBarrioPorZona);

    echo $bajaBarrio;
