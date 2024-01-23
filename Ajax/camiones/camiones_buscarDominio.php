<?php
require_once '../../Controladores/ControladorCamiones.php';
require_once '../../Modelos/ModelosCamiones.php';


$dominio = $_POST['dominio'];


$ValidaExistencia = ModelosCamiones::MdlConsultCamionExistencia($dominio);



if (!empty($ValidaExistencia)) {
    echo json_encode("camion_existe");
} else {
    $buscaCamion = ControladorCamiones::ctrlbuscarDominio($dominio);



    if (empty($buscaCamion)) {
        echo json_encode("no se encontro dominio");
    } else {
        foreach ($buscaCamion as $Camion) {
            $idpat = $Camion['idpat'];
            $patente   = $Camion['patente'];
            $patreg    = $Camion['patreg'];
            $modeloy2k = $Camion['modeloy2k'];
            $FechaAlta = $Camion['FechaAlta'];
            $ObsAlta   = $Camion['ObsAlta'];
            $FechaBaja = $Camion['FechaBaja'];
            $NroExpte  = $Camion['NroExpte'];
            $ObsBaja   = $Camion['ObsBaja'];
            $altaprovi = $Camion['altaprovi'];
            $desucerp  = $Camion['desucerp'];
            $marca = $Camion['marca'];
            $modelob   = trim($Camion['modelob']);
            $tipo  = $Camion['tipo'];
            $descrip   = $Camion['descrip'];
            $detalle   = $Camion['detalle'];
            $cuim  = $Camion['cuim'];
            $Orden = $Camion['Orden'];
            $f_vig_desde   = $Camion['f_vig_desde'];
            $NOMRAZ    = $Camion['NOMRAZ'];
            $DNI   = $Camion['DNI'];
            $Porcentaje    = $Camion['Porcentaje'];
            $Barrio    = $Camion['Barrio'];
            $Calle = $Camion['Calle'];
            $altura    = $Camion['altura'];
            $mz    = $Camion['mz'];
            $sector    = $Camion['sector'];
            $parcela   = $Camion['parcela'];
            $torre = $Camion['torre'];
            $piso  = $Camion['piso'];
            $dpto  = $Camion['dpto'];
            $casa  = $Camion['casa'];
            $domicilio = $Camion['domicilio'];
        }

        $ctrlFiltraPersonaContribuyente = ControladorCamiones::ctrlFiltraPersonaContribuyente($DNI);



        foreach ($ctrlFiltraPersonaContribuyente as $dataPersona) {
            $Id_contribuyente = $dataPersona['Id'];
            $Contribuyente = $dataPersona['Contribuyente'];
            $FechaNacimiento = $dataPersona['FechaNacimiento'];
            $Sexo = $dataPersona['Sexo'];
            $Mail = $dataPersona['Mail'];
            $Telefono = $dataPersona['Telefono'];
            $FechaAlta = $dataPersona['FechaAlta'];
            $NroDni = $dataPersona['NroDni'];
            $IdNacionalidad = $dataPersona['IdNacionalidad'];
        }

        $DomicilioContribuyente = ControladorCamiones::CtrlBuscaDomicilioContribuyente($Id_contribuyente);

        if (!empty($DomicilioContribuyente)) {
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

            $NuevaFechaNacimiento = date("d/m/Y", strtotime($FechaNacimiento));

            $datosDominio = array(
                "mensaje" => "tiene_domicilio",
                "dominio" => "$patente",
                "marca" => "$marca",
                "modelo" => "$modelob",
                "tipo_servicio" => "",
                "capacidad" => "",
                "acoplado" => "",
                "nombre_completo" => "$Contribuyente",
                "dni" => "$NroDni",
                "direccion" => "$domicilio",
                "telefono" => "$Telefono",
                "id_nacionalidad" => "$IdNacionalidad",
                "id_contribuyente" => "$Id_contribuyente",
                "fecha_nacimiento" => "$NuevaFechaNacimiento",

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

            echo json_encode($datosDominio);
        } else {
            // $NuevaFechaNacimiento = date("d/m/Y", strtotime($FechaNacimiento));

            $datosDominio = array(
                "mensaje" => "SinDomicilio",
                "dominio" => "$patente",
                "marca" => "$marca",
                "modelo" => "$modelob",
                "tipo_servicio" => "",
                "capacidad" => "",
                "acoplado" => "",
                "nombre_completo" => "$Contribuyente",
                "dni" => "$NroDni",
                "direccion" => "$domicilio",
                "telefono" => "$Telefono",
                "id_nacionalidad" => "$IdNacionalidad",
                "id_contribuyente" => "$Id_contribuyente",
                "fecha_nacimiento" => "$FechaNacimiento",

                // "barrio" => "",
                // "calle" => "",
                // "numero" => "",
                // "mz" => "",
                // "sector" => "",
                // "parcela" => "",
                // "casa" => "",
                // "torre" => "",
                // "piso" => "",
                // "dpto" => "",
            );

            echo json_encode($datosDominio);
        }
    }
}
