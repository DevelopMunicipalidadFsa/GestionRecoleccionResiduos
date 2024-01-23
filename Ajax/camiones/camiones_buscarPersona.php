<?php
require_once '../../Controladores/ControladorCamiones.php';
require_once '../../Modelos/ModelosCamiones.php';


$dni = $_POST['dni'];

$ctrlFiltraPersonaContribuyente = ControladorCamiones::ctrlFiltraPersonaContribuyente($dni);

if (empty($ctrlFiltraPersonaContribuyente)) {
    echo json_encode("error_dni");
} else {
    foreach ($ctrlFiltraPersonaContribuyente as $dataPropietario) {
        $Id_contribuyente = $dataPropietario['Id'];
        $Contribuyente = $dataPropietario['Contribuyente'];
        $FechaNacimiento = $dataPropietario['FechaNacimiento'];
        $Sexo = $dataPropietario['Sexo'];
        $Mail = $dataPropietario['Mail'];
        $Telefono = $dataPropietario['Telefono'];
        $FechaAlta = $dataPropietario['FechaAlta'];
        $NroDni = $dataPropietario['NroDni'];
        $IdNacionalidad = $dataPropietario['IdNacionalidad'];

        $NuevaFechaNacimiento = date("d/m/Y", strtotime($FechaNacimiento));
    }

    // $CtrlValidaPersona = ControladorCamiones::CtrlValidaPersona($NroDni);

    // $ValidaExistenciPersona = ControladorCamiones::CtrlValidaTipoPersona($NroDni, 2);

    // if (empty($CtrlValidaPersona)) {

    //SI NO EXISTE LA PERSONA SE DEBE CREAR 
    $DomicilioContribuyente = ControladorCamiones::CtrlBuscaDomicilioContribuyente($Id_contribuyente);

    foreach ($DomicilioContribuyente as $dataDomicilio) {
        $Domicilio = $dataDomicilio['Domicilio'];
        $Altura = $dataDomicilio['Altura'];
        $Piso = $dataDomicilio['Piso'];
        $Dpto = $dataDomicilio['Dpto'];
        $Mz = $dataDomicilio['Mz'];
        $Torre = $dataDomicilio['Torre'];
        $Casa = $dataDomicilio['Casa'];
        $Sector = $dataDomicilio['Sector'];
        $Parcela = $dataDomicilio['Parcela'];
        $Barrio = $dataDomicilio['Barrio'];
        $Calle = $dataDomicilio['Calle'];
        $CodBar = $dataDomicilio['CodBar'];
        $CodCal = $dataDomicilio['CodCal'];
    }


    $datosChoferes = array(
        "nombre_completo" => "$Contribuyente",
        "dni" => "$NroDni",
        "telefono" => "$Telefono",
        "fecha_nacimiento" => "$NuevaFechaNacimiento",
        "id_contribuyente" => "$Id_contribuyente",
        "id_nacionalidad" => "$IdNacionalidad",


        "direccion" => "$Domicilio",
        "barrio" => "$CodBar",
        "calle" => "$CodCal",
        "numero" => "",
        "mz" => "$Mz",
        "sector" => "$Sector",
        "parcela" => "$Parcela",
        "casa" => "$Casa",
        "torre" => "$Torre",
        "piso" => "$Piso",
        "dpto" => "$Dpto",
    );

    echo json_encode($datosChoferes);
    // } else {
    //     //SI EXISTE LA PERSONA SE CONSULTA SI YA EXISTE COMO CHOFER DEL CAMION
    //     foreach ($CtrlValidaPersona as $persona) {
    //         $id_persona = $persona['id'];
    //     }

    //     $ChoferxCamion = ControladorCamiones::CtrlConsultaExistenciaChoferxCamion($id_persona, $idCamion);


    //     if (empty($ChoferxCamion)) {
    //         $DomicilioContribuyente = ControladorCamiones::CtrlBuscaDomicilioContribuyente($Id_contribuyente);

    //         foreach ($DomicilioContribuyente as $dataDomicilio) {
    //             $Domicilio = $dataDomicilio['Domicilio'];
    //             $Altura = $dataDomicilio['Altura'];
    //             $Piso = $dataDomicilio['Piso'];
    //             $Dpto = $dataDomicilio['Dpto'];
    //             $Mz = $dataDomicilio['Mz'];
    //             $Torre = $dataDomicilio['Torre'];
    //             $Casa = $dataDomicilio['Casa'];
    //             $Sector = $dataDomicilio['Sector'];
    //             $Parcela = $dataDomicilio['Parcela'];
    //             $Barrio = $dataDomicilio['Barrio'];
    //             $Calle = $dataDomicilio['Calle'];
    //             $CodBar = $dataDomicilio['CodBar'];
    //             $CodCal = $dataDomicilio['CodCal'];
    //         }


    //         $datosChoferes = array(
    //             "nombre_completo" => "$Contribuyente",
    //             "dni" => "$NroDni",
    //             "telefono" => "$Telefono",
    //             "fecha_nacimiento" => "$NuevaFechaNacimiento",
    //             "id_contribuyente" => "$Id_contribuyente",
    //             "id_nacionalidad" => "$IdNacionalidad",


    //             "direccion" => "$Domicilio",
    //             "barrio" => "$CodBar",
    //             "calle" => "$CodCal",
    //             "numero" => "",
    //             "mz" => "$Mz",
    //             "sector" => "$Sector",
    //             "parcela" => "$Parcela",
    //             "casa" => "$Casa",
    //             "torre" => "$Torre",
    //             "piso" => "$Piso",
    //             "dpto" => "$Dpto",
    //         );

    //         echo json_encode($datosChoferes);
    //     } else {
    //         echo json_encode('chofer_existe');
    //     }
    // }
}



    // print_r($CamionesBuscaPropietario);
