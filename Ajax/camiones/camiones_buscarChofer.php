<?php
require_once '../../Controladores/ControladorCamiones.php';
require_once '../../Modelos/ModelosCamiones.php';


$dni = $_POST['dni'];
$idCamion = $_POST['idCamion'];

$CtrlDatosPersona = ControladorCamiones::CtrlDatosPersona($dni);
$ctrlFiltraPersonaContribuyente = ControladorCamiones::ctrlFiltraPersonaContribuyente($dni);


if (empty($CtrlDatosPersona)) {
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

        $CtrlValidaPersona = ControladorCamiones::CtrlValidaPersona($NroDni);

        // $ValidaExistenciPersona = ControladorCamiones::CtrlValidaTipoPersona($NroDni, 2);

        if (empty($CtrlValidaPersona)) {

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
        } else {
            //SI EXISTE LA PERSONA SE CONSULTA SI YA EXISTE COMO CHOFER DEL CAMION
            foreach ($CtrlValidaPersona as $persona) {
                $id_persona = $persona['id'];
            }

            $ChoferxCamion = ControladorCamiones::CtrlConsultaExistenciaChoferxCamion($id_persona, $idCamion);


            if (empty($ChoferxCamion)) {
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
            } else {
                echo json_encode('chofer_existe');
            }
        }
    }
} else {


    foreach ($CtrlDatosPersona as $datPers) {
        // $id_persona = $datPers['id'];
        // $Contribuyente = $datPers['apellidosNombres'];
        // $FechaNacimiento = $datPers['fechaNacimiento'];
        // $NroDni = $datPers['dni'];
        // $IdNacionalidad = $datPers['Nacionalidad'];

        $id_persona = $datPers['id']; //id persona
        $apellidosNombres = $datPers['apellidosNombres'];
        $dni = $datPers['dni'];
        $fechaNacimiento = $datPers['fechaNacimiento'];
        $Nacionalidad = $datPers['Nacionalidad'];
        $idDomicilio = $datPers['idDomicilio'];
        $idContactos = $datPers['idContactos'];
        $obs = $datPers['obs'];

        $id = $datPers['id']; //id contacto
        $celular1 = $datPers['celular1'];
        $celular2 = $datPers['celular2'];
        $mail = $datPers['mail'];

        $id = $datPers['id']; //id domicilio
        $barrio = $datPers['barrio'];
        $calle = $datPers['calle'];
        $numero = $datPers['numero'];
        $mz = $datPers['mz'];
        $sector = $datPers['sector'];
        $parcela = $datPers['parcela'];
        $casa = $datPers['casa'];
        $torre = $datPers['torre'];
        $piso = $datPers['piso'];
        $dpto = $datPers['dpto'];
        $observaciones = $datPers['observaciones'];


        $Id = $datPers['Id']; //nacionalidad	
        $Descripcion = $datPers['Descripcion']; //desc nacionalidad

        $tipoChofer = $datPers['tipoChofer'];
        $tipoLicencia = $datPers['tipoLicencia'];
        $fecVencimientoLicencia = $datPers['fecVencimientoLicencia'];

        $NuevaFechaNacimiento = date("d/m/Y", strtotime($fechaNacimiento));
    }

    $ChoferxCamion = ControladorCamiones::CtrlConsultaExistenciaChoferxCamion($id_persona, $idCamion);


    if (empty($ChoferxCamion)) {
        $datosChoferes = array(
            "infoPersona" => "GestionAmbiental",
            "nombre_completo" => "$apellidosNombres",
            "dni" => "$dni",
            "telefono" => "$celular1",
            "telefono2" => "$celular2",
            "mail" => "$mail",
            "fecha_nacimiento" => "$fechaNacimiento",
            // "id_contribuyente" => "$Id_contribuyente",
            "id_nacionalidad" => "$Nacionalidad",


            // "direccion" => "$Domicilio",
            "barrio" => "$barrio",
            "calle" => "$calle",
            "numero" => "$numero",
            "mz" => "$mz",
            "sector" => "$sector",
            "parcela" => "$parcela",
            "casa" => "$casa",
            "torre" => "$torre",
            "piso" => "$piso",
            "dpto" => "$dpto",

            "tipoChofer" => "$tipoChofer",
            "tipoLicencia" => "$tipoLicencia",
            "fecVencimientoLicencia" => "$fecVencimientoLicencia",
        );

        echo json_encode($datosChoferes);
    } else {
        echo json_encode('chofer_existe');
    }
}



    // print_r($CamionesBuscaPropietario);
