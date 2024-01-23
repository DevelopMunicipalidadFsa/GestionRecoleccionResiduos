<!-- <script src="../Librerias/JQuery/jquery-3.7.1.min.js"></script> -->
<script src="../../Librerias/JQuery/jquery-3.7.1.min.js"></script>
<script src="../../Librerias/Sweetalert2/js/sweetalert2.min.js"></script>

<style>
    .form-floating-css input {
        background: #EBF5FB !important;
        border: none !important;
        border-bottom: solid 2px #154360 !important;
        border-radius: 0px !important;
    }

    .form-floating-css textarea {
        background: #EBF5FB !important;
        border: none !important;
        border-bottom: solid 2px #154360 !important;
        border-radius: 0px !important;
    }

    .form-floating-css>.form-control:disabled~label::after,
    .form-floating-css>:disabled~label::after {
        background-color: transparent !important;
    }
</style>
<?php
require_once 'Controladores/ControladorCamiones.php';
require_once 'Modelos/ModelosCamiones.php';
include_once('camionesModales.php');

$idCamion = $_POST['idCamion'];

$a_chofer = ControladorCamiones::A_Choferes();
print_r($a_chofer);

$b_chofer = ControladorCamiones::CtrlBajaChofer();
print_r($b_chofer);

$act_chofer = ControladorCamiones::CtrlActivaChofer();
print_r($act_chofer);

$modificaCamion = ControladorCamiones::CtrlMcamion();
print_r($modificaCamion);

$CtrlMpersona = ControladorCamiones::CtrlMpersona();
print_r($CtrlMpersona);

$CtrlMcontacto = ControladorCamiones::CtrlMcontacto();
print_r($CtrlMcontacto);

$CtrlMdomicilio = ControladorCamiones::CtrlMdomicilio();
print_r($CtrlMdomicilio);


$Detalle = ControladorCamiones::CtrlCamionesDetalles($idCamion);

// print_r($Detalle);

$ListaChoferes = ControladorCamiones::CtrlListaChoferesCamion($idCamion);
// print_r($ListaChoferes);


$choferN = 0;


foreach ($Detalle as $camiones) {

    $idCamion = $camiones['idCamion'];
    $interno = $camiones['interno'];
    $dominio = $camiones['dominio'];
    $marca = $camiones['marca'];
    $modelo = $camiones['modelo'];
    $chasis = $camiones['chasis'];
    $idTipoPropietarios = $camiones['idTipoPropietarios'];
    $idTipoServicios = $camiones['idTipoServicios'];
    $idPropietario = $camiones['idPropietario'];
    $obs = $camiones['obs'];
    $idEstado = $camiones['idEstadoCamion'];
    $seguro = $camiones['seguro'];
    $vencimientoSeguro = $camiones['vencimientoSeguro'];
    $IdPersona = $camiones['IdPersona'];
    $apellidosNombres = $camiones['apellidosNombres'];
    $tipo_servicio = $camiones['tipo_servicio'];
    $desc_estado = $camiones['desc_estado'];

    $apellidosNombres = $camiones['apellidosNombres'];
    $dni = $camiones['dni'];
    $fechaNacimiento = $camiones['fechaNacimiento'];
    $Nacionalidad = $camiones['Nacionalidad']; //id
    $idDomicilio = $camiones['idDomicilio'];
    $idContactos = $camiones['idContactos'];
    $obs = $camiones['obs'];

    $celular1 = $camiones['celular1'];
    $celular2 = $camiones['celular2'];
    $mail = $camiones['mail'];

    $id_barrio = $camiones['id_barrio'];
    "<br>";
    $id_calle = $camiones['id_calle'];
    "<br>";


    $numero = $camiones['numero'];
    $mz = $camiones['mz'];
    $sector = $camiones['sector'];
    $parcela = $camiones['parcela'];
    $casa = $camiones['casa'];
    $torre = $camiones['torre'];
    $piso = $camiones['piso'];
    $dpto = $camiones['dpto'];
    $desc_calle = $camiones['desc_calle'];
    $desc_barrio = $camiones['desc_barrio'];
    $desc_nacionalidad = $camiones['desc_nacionalidad'];
}





?>


<div class="container-fluid p-2">
    <?php

    if ($desc_estado == "DATOS INCOMPLETOS") { ?>
        <div class="alert shadow border border-warning" role="alert">
            <strong>¡Atención!</strong> para finalizar la carga del vehiculo debe agregar al menos un chofer
        </div>
    <?php }

    ?>
    <a class="btn px-3 py-3 shadow bg-danger mr-2" href="camionesListado"><i class="fas fa-arrow-left"> </i> Volver</a>

    <button type="button" class="btn btn_modi_camion bg-warning px-3 py-3 shadow" title="Modifica Camion" id="btn_modi_camion" data-bs-toggle="modal" data-bs-target="#ModalM_camion" data-interno="<?php echo $interno ?>" data-idCamion="<?php echo $idCamion ?>" data-dominio="<?php echo $dominio ?>" data-modelo="<?php echo $modelo ?>" data-marca="<?php echo $marca ?>" data-chasis="<?php echo $chasis ?>" data-tipo_servicio="<?php echo $idTipoServicios ?>" data-seguro="<?php echo $seguro ?>" data-vencimiento_seguro="<?php echo $vencimientoSeguro ?>" data-descripcion_cam="<?php echo $obs ?>"><i class="fas fa-pencil"></i> Modificar Camion</button>

    <button type="button" class="btn btn_adm_choferes bg-success px-3 py-3 shadow ml-2" title="Agregar Chofer" id="btn_adm_choferes" data-bs-toggle="modal" data-bs-target="#ModalA_Chofer" data-interno="<?php echo $interno ?>" data-idCamion="<?php echo $idCamion ?>" data-dominio="<?php echo $dominio ?>"><i class="fas fa-user-plus"></i> Registrar nuevo chofer</button>

    <div class="row px-2">
        <div class="col-6 p-0">
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Detalles de la Unidad
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body border border-2 shadow border-top-0">
                            <div class="row">
                                <div class="col-2">
                                    <div class="form-floating form-floating-css mt-2">
                                        <input style="font-size: 11px;" disabled type="text" class="form-control form-control-sm fw-bold" id="interno" name="interno" value="<?php echo $interno ?>">
                                        <label for="interno" style="font-size: 13px; color: #154360;" class="fw-bold">#</label>
                                    </div>
                                </div>
                                <div class="col-5">
                                    <div class="form-floating form-floating-css mt-2">
                                        <input style="font-size: 11px;" disabled type="text" class="form-control form-control-sm fw-bold" name="dominio" id="dominio" value="<?php echo $dominio ?>">
                                        <label for="dominio" style="font-size: 13px; color: #154360;" class="fw-bold">Dominio</label>
                                    </div>
                                </div>
                                <div class="col-5">
                                    <div class="form-floating form-floating-css mt-2">
                                        <input style="font-size: 11px;" disabled type="text" class="form-control form-control-sm fw-bold" name="marca" id="marca" value="<?php echo $marca ?>">
                                        <label for="marca" style="font-size: 13px; color: #154360;" class="fw-bold">Marca</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-floating form-floating-css mt-2">
                                        <input style="font-size: 11px;" disabled type="text" class="form-control form-control-sm fw-bold" name="modelo" id="modelo" value="<?php echo $modelo ?>">
                                        <label for="modelo" style="font-size: 13px; color: #154360;" class="fw-bold">Modelo</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-floating form-floating-css mt-2">
                                        <input style="font-size: 11px;" disabled type="text" class="form-control form-control-sm fw-bold" id="estado_desc" name="estado_desc" value="<?php echo $desc_estado ?>">
                                        <label for="estado_desc" style="font-size: 13px; color: #154360;" class="fw-bold">Estado </label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-floating form-floating-css mt-2">
                                        <input style="font-size: 11px;" disabled type="text" class="form-control form-control-sm fw-bold" id="chasis" name="chasis" value="<?php echo $chasis ?>">
                                        <label for="chasis" style="font-size: 13px; color: #154360;" class="fw-bold">N° Chasis </label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-floating form-floating-css mt-2">
                                        <input style="font-size: 11px;" disabled type="text" class="form-control form-control-sm fw-bold" id="interno" value="<?php echo $tipo_servicio ?>">
                                        <label for="interno" style="font-size: 13px; color: #154360;" class="fw-bold">Tipo de servicio</label>

                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-floating form-floating-css mt-2">
                                        <input style="font-size: 11px;" disabled type="text" class="form-control form-control-sm fw-bold" id="seguro" name="seguro" value="<?php echo $seguro ?>">
                                        <label for="seguro" style="font-size: 13px; color: #154360;" class="fw-bold">Seguro</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-floating form-floating-css mt-2">
                                        <input style="font-size: 11px;" disabled type="text" class="form-control form-control-sm fw-bold" id="vencimiento_seguro" name="vencimiento_seguro" value="<?php echo $vencimientoSeguro ?>">
                                        <label for="vencimiento_seguro" style="font-size: 13px; color: #154360;" class="fw-bold">Vencimiento Seguro </label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating form-floating-css mt-2">
                                        <textarea style="font-size: 11px;" disabled class="fw-bold form-control form-control-sm" name="descripcion_cam" id="descripcion_cam" cols="30" rows="10" value=""><?php echo $obs ?></textarea>
                                        <label for="descripcion_cam" style="font-size: 13px; color: #154360;" class="fw-bold">Observaciones</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <?php if ($apellidosNombres == "Municipalidad de Formosa") { ?>
                                        <div class="alert alert-warning bg-warning mt-2" role="alert">
                                            <strong>¡Atención!</strong> El Vehiculo es propiedad de la Municipalidad de Formosa
                                        </div>

                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if ($apellidosNombres != "Municipalidad de Formosa") { ?>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Datos del Titular
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                            <div class="accordion-body border border-2 shadow border-top-0">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-floating form-floating-css mt-2">
                                            <input disabled style="font-size: 11px;" type="text" class="form-control form-control-sm fw-bold" id="nombre_completo" value="<?php echo $apellidosNombres ?>">
                                            <label style="font-size: 13px; color:#154360;" class="fw-bold" for="nombre_completo">Nombre Completo Titular </label>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-floating form-floating-css mt-2">
                                            <input disabled style="font-size: 11px;" type="text" class="form-control form-control-sm fw-bold" id="dni" value="<?php echo $dni ?>">
                                            <label style="font-size: 13px; color:#154360;" class="fw-bold" for="dni">Documento </label>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-floating form-floating-css mt-2">
                                            <input disabled style="font-size: 11px;" type="text" class="form-control form-control-sm fw-bold" value="<?php echo $desc_nacionalidad ?>">
                                            <label style="font-size: 13px; color:#154360;" class="fw-bold" for="dni">Nacionalidad </label>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-floating form-floating-css mt-2">
                                            <input disabled style="font-size: 11px;" type="text" class="form-control form-control-sm fw-bold" id="fecha_nac" value="<?php echo $fechaNacimiento ?>">
                                            <label style="font-size: 13px; color:#154360;" class="fw-bold" for="fecha_nac">Fecha de Nacimiento </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Domicilio
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                            <div class="accordion-body border border-2 shadow border-top-0">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-floating form-floating-css mt-2">
                                            <input disabled style="font-size: 11px;" type="text" class=" fw-bold form-control form-control-sm" id="" value="<?php echo $desc_barrio ?>">
                                            <label style="font-size: 13px; color:#154360;" class="fw-bold" for="">Barrio </label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-floating form-floating-css mt-2">
                                            <input disabled style="font-size: 11px;" type="text" class=" fw-bold form-control form-control-sm" id="telefono" value="<?php echo $desc_calle ?>">
                                            <label style="font-size: 13px; color:#154360;" class="fw-bold" for="telefono">Calle </label>
                                        </div>
                                    </div>

                                    <div class="col-3">
                                        <div class="form-floating form-floating-css mt-2">
                                            <input disabled style="font-size: 11px;" type="text" class=" fw-bold form-control form-control-sm" id="numero" name="numero_t" value="<?php echo $numero ?>">
                                            <label style="font-size: 13px; color:#154360;" class="fw-bold" for="numero">Número</label>
                                        </div>
                                    </div>

                                    <div class="col-3">
                                        <div class="form-floating form-floating-css mt-2">
                                            <input disabled style="font-size: 11px;" type="text" class=" fw-bold form-control form-control-sm" id="mz" name="mz_t" value="<?php echo $mz ?>">
                                            <label style="font-size: 13px; color:#154360;" class="fw-bold" for="mz">Mz</label>
                                        </div>
                                    </div>

                                    <div class="col-3">
                                        <div class="form-floating form-floating-css mt-2">
                                            <input disabled style="font-size: 11px;" type="text" class=" fw-bold form-control form-control-sm" id="sector" name="sector_t" value="<?php echo $sector ?>">
                                            <label style="font-size: 13px; color:#154360;" class="fw-bold" for="sector">Sector</label>
                                        </div>
                                    </div>

                                    <div class="col-3">
                                        <div class="form-floating form-floating-css mt-2">
                                            <input disabled style="font-size: 11px;" type="text" class=" fw-bold form-control form-control-sm" id="parcela" name="parcela_t" value="<?php echo $parcela ?>">
                                            <label style="font-size: 13px; color:#154360;" class="fw-bold" for="parcela">Parcela</label>
                                        </div>
                                    </div>

                                    <div class="col-3">
                                        <div class="form-floating form-floating-css mt-2">
                                            <input disabled style="font-size: 11px;" type="text" class=" fw-bold form-control form-control-sm" id="casa" name="casa_t" value="<?php echo $casa ?>">
                                            <label style="font-size: 13px; color:#154360;" class="fw-bold" for="casa">Casa</label>
                                        </div>
                                    </div>

                                    <div class="col-3">
                                        <div class="form-floating form-floating-css mt-2">
                                            <input disabled style="font-size: 11px;" type="text" class=" fw-bold form-control form-control-sm" id="torre" name="torre_t" value="<?php echo $torre ?>">
                                            <label style="font-size: 13px; color:#154360;" class="fw-bold" for="torre">Torre</label>
                                        </div>
                                    </div>

                                    <div class="col-3">
                                        <div class="form-floating form-floating-css mt-2">
                                            <input disabled style="font-size: 11px;" type="text" class=" fw-bold form-control form-control-sm" id="piso" name="piso_t" value="<?php echo $piso ?>">
                                            <label style="font-size: 13px; color:#154360;" class="fw-bold" for="piso">Piso</label>
                                        </div>
                                    </div>

                                    <div class="col-3">
                                        <div class="form-floating form-floating-css mt-2">
                                            <input disabled style="font-size: 11px;" type="text" class=" fw-bold form-control form-control-sm" id="dpto" name="dpto_t" value="<?php echo $dpto ?>">
                                            <label style="font-size: 13px; color:#154360;" class="fw-bold" for="dpto">Dpto</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading4">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
                                Contactos
                            </button>
                        </h2>
                        <div id="collapse4" class="accordion-collapse collapse" aria-labelledby="heading4" data-bs-parent="#accordionExample">
                            <div class="accordion-body border border-2 shadow border-top-0">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-floating form-floating-css mt-2">
                                            <input disabled style="font-size: 11px;" type="text" class="fw-bold form-control form-control-sm" id="telefono" value="<?php echo $celular1 ?>">
                                            <label class="fw-bold" style="font-size: 13px; color:#154360;" for="telefono">Telefono </label>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-floating form-floating-css mt-2">
                                            <input disabled style="font-size: 11px;" type="text" class="fw-bold form-control form-control-sm" id="telefono2" value="<?php echo $celular2 ?>">
                                            <label class="fw-bold" style="font-size: 13px; color:#154360;" for="telefono">Telefono 2</label>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-floating form-floating-css mt-2">
                                            <input disabled style="font-size: 11px;" type="text" class="fw-bold form-control form-control-sm" id="mail_t" value="<?php echo $mail ?>">
                                            <label class="fw-bold" style="font-size: 13px; color:#154360;" for="telefono">E-Mail</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>

            </div>
        </div>
        <div class="col-6">
            <div class="accordion" id="accordionExampleEncargado">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingChoferes">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseChoferes" aria-expanded="true" aria-controls="collapseChoferes">
                            Listado de Choferes/Encargados
                        </button>
                    </h2>
                    <div id="collapseChoferes" class="accordion-collapse collapse show" aria-labelledby="cabChoferes" data-bs-parent="#accordionExampleEncargado">
                        <div class="accordion-body">
                            <div class="accordion" id="accordionPanelsStayOpenExample">
                                <div class="accordion-item">
                                    <?php
                                    if (empty($ListaChoferes)) { ?>
                                        <div class="row text-center">
                                            <label class="py-3 px-3 bg-danger">AUN NO SE REGISTRARON CHOFERES</label>
                                        </div>
                                    <?php }

                                    foreach ($ListaChoferes as $choferes) {
                                        $apellidosNombres = $choferes['apellidosNombres'];
                                        $id = $choferes['id'];
                                        $dni = $choferes['dni'];
                                        $fechaNacimiento = $choferes['fechaNacimiento'];
                                        $Nacionalidad = $choferes['Nacionalidad'];
                                        $desc_nacionalidad = $choferes['desc_nacionalidad'];
                                        $idDomicilio = $choferes['idDomicilio'];
                                        "<br>";
                                        $idContactos = $choferes['idContactos'];
                                        "<br>";
                                        $obs = $choferes['obs'];
                                        $activo = $choferes['activo'];

                                        $fecVencimientoLicencia = $choferes['fecVencimientoLicencia'];
                                        $tipoLicencia = $choferes['tipoLicencia'];
                                        // $idCamion = $choferes['idCamion'];

                                        $contactoPersona = ControladorCamiones::CtrlContactosPersona($idContactos);
                                        $domicilioPersona = ControladorCamiones::CtrlDomicilioPersona($idDomicilio);

                                        // print_r($domicilioPersona);

                                        if (!empty($contactoPersona)) {
                                            $celular1 = $contactoPersona[0]['celular1'];
                                            $celular2 = $contactoPersona[0]['celular2'];
                                            $mail = $contactoPersona[0]['mail'];
                                        }

                                        if (!empty($domicilioPersona)) {
                                            $mz = $domicilioPersona[0]['mz'];
                                            $sector = $domicilioPersona[0]['sector'];
                                            $parcela = $domicilioPersona[0]['parcela'];
                                            $numero = $domicilioPersona[0]['numero'];
                                            $casa = $domicilioPersona[0]['casa'];
                                            $torre = $domicilioPersona[0]['torre'];
                                            $piso = $domicilioPersona[0]['piso'];
                                            $dpto = $domicilioPersona[0]['dpto'];
                                            $desc_calle = $domicilioPersona[0]['desc_calle'];
                                            $desc_barrio = $domicilioPersona[0]['desc_barrio'];
                                            $barrio = $domicilioPersona[0]['barrio'];
                                            "<br>";
                                            $calle = $domicilioPersona[0]['calle'];
                                            "<br>";
                                        }
                                        // exit;


                                        $choferN++
                                    ?>

                                        <h2 class="accordion-header mb-2" id="panelsStayOpen-headingChf1<?php echo $id ?>">
                                            <button class="accordion-button fw-bold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseChf1<?php echo $id ?>" aria-expanded="false" aria-controls="panelsStayOpen-collapseChf1<?php echo $id ?>">
                                                <div class="col-6 px-0 text-left" style="font-size: 11px;">
                                                    #<?php echo $choferN ?> <?php echo $apellidosNombres ?>
                                                </div>
                                                <div class="col-6 text-left px-0" style="font-size: 11px;">
                                                    Vto. Licencia <?php echo $fecVencimientoLicencia ?>
                                                </div>

                                            </button>
                                        </h2>
                                        <div id="panelsStayOpen-collapseChf1<?php echo $id ?>" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingChf1<?php echo $id ?>">
                                            <div class="accordion-body border border-2 shadow border-top-0">
                                                <div class="row">
                                                    <div class="col-3 text-center">
                                                        <button class="btn btn_modi_persona btn-sm bg-dark w-100 text-center fw-bold text-warning" title="Modificar Chofer" id="btn_modi_persona" data-bs-toggle="modal" data-bs-target="#ModalM_persona" id_persona_chofer="<?php echo $id ?>" id_camion="<?php echo $idCamion ?>" val_apellidosNombres="<?php echo $apellidosNombres ?>" val_dni="<?php echo $dni ?>" val_fechaNacimiento="<?php echo $fechaNacimiento ?>" val_Nacionalidad="<?php echo $Nacionalidad ?>" val_obs="<?php echo $obs ?>" fecVencimientoLicencia="<?php echo $fecVencimientoLicencia ?>"><i class="fas fa-pencil"></i> Editar</button>
                                                    </div>
                                                    <div class="col-3 text-center">
                                                        <button class="btn btn_modi_domicilio btn-sm bg-dark w-100 text-center fw-bold text-warning" title="Modificar Domicilio" id="btn_modi_domicilio" data-bs-toggle="modal" data-bs-target="#ModalM_domicilio" val_idCamion_dom="<?php echo $idCamion ?>" val_idDomicilio="<?php echo $idDomicilio ?>" val_idBarrio_dom="<?php echo $barrio ?>" val_idCalle_dom="<?php echo $calle ?>" val_nro="<?php echo $numero ?>" val_mz="<?php echo $mz ?>" val_sector="<?php echo $sector  ?>" val_parcela="<?php echo $parcela ?>" val_casa="<?php echo $casa ?>" val_torre="<?php echo $torre ?>" val_piso="<?php echo $piso ?>" val_depto="<?php echo $dpto ?>"><i class="fas fa-home"></i> Domicilio</button>
                                                    </div>
                                                    <div class="col-3 text-center">
                                                        <button class="btn btn_modi_contacto btn-sm bg-dark w-100 text-center fw-bold text-warning" title="Modificar Contactos" id="btn_modi_contacto" data-bs-toggle="modal" data-bs-target="#ModalM_contacto" val_idCamion="<?php echo $idCamion ?>" val_idContacto="<?php echo $idContactos ?>" val_celular1="<?php echo $celular1 ?>" val_celular2="<?php echo $celular2 ?>" val_mail="<?php echo $mail ?>"><i class="fas fa-phone"></i> Contactos</button>
                                                    </div>
                                                    <div class="col-3 text-center">
                                                        <button class="btn btn_baja_chofer btn-sm bg-dark w-100 text-center fw-bold text-danger" title="Eliminar Chofer" id="btn_baja_chofer" data-bs-toggle="modal" data-bs-target="#ModalB_Chofer" data-idChofer="<?php echo $id ?>" data-idCamion="<?php echo $idCamion ?>" data-dominio="<?php echo $dominio ?>"><i class="fas fa-trash"></i> Borrar</button>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-floating form-floating-css mt-2">
                                                            <input disabled style="font-size: 11px;" type="text" class="form-control form-control-sm fw-bold" id="nombre_completo" value="<?php echo $apellidosNombres ?>">
                                                            <label style="font-size: 13px; color:#154360;" class="fw-bold" for="nombre_completo">Nombre Completo</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-6">
                                                        <div class="form-floating form-floating-css mt-2">
                                                            <input disabled style="font-size: 11px;" type="text" class="form-control form-control-sm fw-bold" id="dni" value="<?php echo $dni ?>">
                                                            <label style="font-size: 13px; color:#154360;" class="fw-bold" for="dni">Documento </label>
                                                        </div>
                                                    </div>

                                                    <div class="col-6">
                                                        <div class="form-floating form-floating-css mt-2">
                                                            <input disabled style="font-size: 11px;" type="text" class="form-control form-control-sm fw-bold" value="<?php echo $desc_nacionalidad ?>">
                                                            <label style="font-size: 13px; color:#154360;" class="fw-bold" for="dni">Nacionalidad </label>
                                                        </div>
                                                    </div>

                                                    <div class="col-6">
                                                        <div class="form-floating form-floating-css mt-2">
                                                            <input disabled style="font-size: 11px;" type="text" class="form-control form-control-sm fw-bold" id="fecha_nac" value="<?php echo $fechaNacimiento ?>">
                                                            <label style="font-size: 13px; color:#154360;" class="fw-bold" for="fecha_nac">Fecha de Nacimiento </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            <?php } ?>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



</div>

</div>


<!-- // $numero = $dom['numero'];
                  


                    // $celular1 = $cont['celular1'];
                    // $celular2 = $cont['celular2'];
                    // $mail = $cont['mail']; -->