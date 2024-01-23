<?php
include_once "Controladores/ControladorCamiones.php";
include_once "Modelos/ModelosCamiones.php";


$nacionalidades = ControladorCamiones::CtrlNacionalidades();
$barrios = ControladorCamiones::CtrlBuscarBarrios();
$calles = ControladorCamiones::ctrBuscarCalles();

?>

<style>
    .select2-container {
        box-sizing: border-box;
        display: inline-block;
        /* margin: 10px; */
        /* margin-left: 10px; */
        margin-right: -1000px;
        position: relative;
        /* float: left; */
        font-weight: bold;
        width: 100% !important;
        vertical-align: middle;
        z-index: 9999 !important;
    }

    .select2-container .select2-selection--single {
        height: 3.5rem !important;
        padding: .375rem .75rem !important;
        font-size: 1rem !important;
        line-height: 1.5 !important;
        color: #495057 !important;
        background-color: #fff !important;
        border: 1px solid #ced4da !important;
        border-radius: .25rem !important;
    }

    .select2-container .select2-selection--single .select2-selection__rendered {
        display: block;
        padding-left: 11px;
        padding-right: 20px;
        margin-top: 0px !important;
        font-size: 15px !important;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .select2-dropdown {
        background-color: white;
        border: 1px solid #aaa;
        border-radius: 4px;
        box-sizing: border-box;
        display: block;
        position: absolute;
        left: -100000px;
        width: 100%;
        z-index: 1151;
    }
</style>

<!-- ESTILOS CHECKBOX -->
<style>
    input[type="checkbox"] {
        position: relative;
        appearance: none;
        width: 40px;
        height: 20px;
        background: #ccc;
        border-radius: 50px;
        box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.2);
        cursor: pointer;
        transition: 0.4s;
        top: 5px;
        margin-top: 5px;
        margin-left: 10px;
    }

    input:checked[type="checkbox"] {
        background: #3a7326;

    }

    input[type="checkbox"]::after {
        position: absolute;
        content: "";
        width: 20px;
        height: 20px;
        top: 0;
        left: 0;
        background: #fff;
        border-radius: 50%;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        transform: scale(1.1);
        transition: 0.4s;
        top: 0px;
        border: solid 1px silver;
    }

    input:checked[type="checkbox"]::after {
        left: 50%;
    }

    .tog1 {
        cursor: pointer;
    }
</style>

<div class="modal fade" id="nuevo_camion" aria-labelledby="nuevo_camion" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">Registrar un Camion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="#" id="formFiltroCamion" name="AltaCamion" novalidate onsubmit="return validarFormulario('formFiltroCamion', event)">
                <div class="modal-body">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation" id="btnTabCamion">
                            <button class="nav-link active" id="camion-tab" data-bs-toggle="tab" data-bs-target="#camion" type="button" role="tab" aria-controls="camion" aria-selected="true">Camion</button>
                        </li>
                        <li class="nav-item" role="presentation" id="btnTabTitular">
                            <button class="nav-link" id="titular-tab" data-bs-toggle="tab" data-bs-target="#titular" type="button" role="tab" aria-controls="titular" aria-selected="false">Titular</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <div class="check-box">
                                <input type="checkbox" id="chofer_titular" value="1" name="chofer_titular" onclick="ValidaChoferTitular()" form="formFiltroCamion">
                                <label for="chofer_titular" class="fw-bold tog1" style="font-size: 11px;">EL TITULAR ES CHOFER</label>
                            </div>
                        </li>
                        <li class="nav-item" role="presentation">
                            <div class="check-box">
                                <input type="checkbox" id="propiedad_muni" name="propiedad_muni" value="1" onclick="validaPropiedadCamion()" form="formFiltroCamion">
                                <label for="propiedad_muni" class="fw-bold tog1" style="font-size: 11px;">ES PROPIEDAD DE LA MUNICIPALIDAD</label>
                            </div>
                        </li>
                    </ul>

                    <!-- Tab panes -->

                    <div class="tab-content p-3 border border-1">
                        <div class="tab-pane active" id="camion" role="tabpanel" aria-labelledby="camion-tab">
                            <div class="row">

                                <h5 class="text-center p-1 text-white fw-bold rounded back-blue">Ingrese los datos del Camion</h5>

                                <div class="alert alert-primary bg-danger alert-dismissible fade show py-3 mb-1" role="alert" id="MsjCampos" style="display: none;">
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    <span class="fw-bold">Debe completar todos los campos</span>
                                </div>


                                <div class="col-10">
                                    <div class="form-floating mb-2">
                                        <input type="text" class="form-control" id="dom_buscar" placeholder="" autocomplete="off">
                                        <label for="patente">Buscar una patente</label>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-floating mb-2">
                                        <button type="button" id="btnBuscarCamion" class="btn btn-success p-3 fw-bold w-100"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                                <div class="col-12" id="alertDominio" style="display: none;">
                                    <div class="zalert alert-light border border-danger border-1 text-danger" role="alert">
                                        El dominio ingresado es incorrecto o no existe.
                                    </div>
                                </div>

                                <div class="col-12" id="alertDominioExiste" style="display: none;">
                                    <div class="alert alert-light border border-danger border-1 text-danger" role="alert">
                                        El dominio ingresado ya está registrado.
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="dominio" id="dominio" form="formFiltroCamion" required>
                                        <label for="dominio">Dominio <span class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="modelo" id="modelo" form="formFiltroCamion" required>
                                        <label for="modelo">Modelo <span class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="marca" id="marca" form="formFiltroCamion" required>
                                        <label for="marca">Marca <span class="text-danger">*</span></label>
                                    </div>
                                </div>


                                <div class="col-6">
                                    <div class="form-floating mb-2">
                                        <input type="text" class="form-control" id="chasis" name="chasis" value="" form="formFiltroCamion" required>
                                        <label for="chasis">N° Chasis <span class="text-danger">*</span></label>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-floating mb-2">
                                        <select class="form-select form-select-lg fs-6" id="tipo_servicio" name="tipo_servicio" form="formFiltroCamion" required>
                                            <option selected disabled>Seleccionar</option>
                                            <option value="1">Chasis</option>
                                            <option value="2">Bateas</option>
                                            <option value="3">Balancin</option>
                                            <option value="4">Retroexcavadora</option>
                                            <option value="5">Compactador</option>
                                        </select>
                                        <label class="form-label">Tipo de Servicio <span class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-floating mb-2">
                                        <input type="number" class="form-control" id="interno" name="interno" form="formFiltroCamion">
                                        <label for="interno">N° Interno </label>
                                        <!-- <div class="valida-interno-ok" id="valida-interno-ok">
                                            Inerno valido
                                        </div> -->
                                        <div class="valida-interno-err text-danger" id="valida-interno-err" style="display: none;">
                                            El interno ingresado ya existe, intente con otro
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-floating mb-2">
                                        <input type="text" class="form-control" id="seguro" name="seguro" form="formFiltroCamion" required>
                                        <label for="seguro">Seguro <span class="text-danger">*</span></label>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="alert alert-primary bg-danger alert-dismissible fade show py-1 mb-1" role="alert" id="MsjVencimientoSeguro" style="display: none; font-size: 11px;">
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="margin-top: -13px;"></button>
                                        <span class="fw-bold">La fecha de vencimiento del seguro se encuentra expirada</span>
                                    </div>
                                    <div class="form-floating mb-2">
                                        <input type="date" class="form-control" id="vencimiento_seguro" name="vencimiento_seguro" form="formFiltroCamion" required>
                                        <label for="vencimiento_seguro">Vencimiento Seguro <span class="text-danger">*</span></label>
                                    </div>

                                </div>

                                <div class="col-12">
                                    <div class="form-floating mb-2">
                                        <textarea class="form-control" name="descripcion_cam" id="descripcion_cam" cols="30" rows="10" form="formFiltroCamion"></textarea>
                                        <label for="descripcion_cam">Observaciones</label>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="tab-pane" id="titular" role="tabpanel" aria-labelledby="titular-tab">
                            <div class="row">
                                <h5 class="text-center p-1 text-white fw-bold rounded back-blue">Ingrese el titular del dominio</h5>

                                <!-- <div class="alert alert-primary bg-danger alert-dismissible fade show py-3 mb-1" role="alert" id="MsjVencimientoLicencia" style="display: none;">
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    <span class="fw-bold" id="spanCargarMensaje"></span>
                                </div> -->

                                <div class="col-10">
                                    <div class="form-floating mb-2">
                                        <input type="number" class="form-control" id="doc_titular" placeholder="" autocomplete="off">
                                        <label for="patente">Buscar una persona (DNI)</label>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-floating mb-2">
                                        <button type="button" id="btn_buscar_titular" class="btn btn-success p-3 fw-bold w-100"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>

                                <div class="col-12" id="alertDniTitular" style="display: none;">
                                    <div class="alert alert-light border border-danger border-1 text-danger" role="alert">
                                        El dni ingresado no cumple con la cantidad minima de carácteres.
                                    </div>
                                </div>

                                <div class="col-12" id="alertDniFalseTitular" style="display: none;">
                                    <div class="alert alert-light border border-danger border-1 text-danger" role="alert">
                                        El dni ingresado es incorrecto o no existe.
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="nombre_completo" name="nombre_t" form="formFiltroCamion" required>
                                        <label for="nombre_completo">Nombre Completo Titular <span class="text-danger">*</span></label>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="dni" name="dni_t" form="formFiltroCamion" required>
                                        <label for="dni">DNI <span class="text-danger">*</span></label>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="alert alert-primary bg-danger alert-dismissible fade show py-1 mb-1" role="alert" id="MsjMayorEdad" style="display: none; font-size: 11px">
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="margin-top: -13px;"></button>
                                        <span class="fw-bold">El Titular debe ser mayor de edad</span>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="date" class="form-control" id="fecha_nac" name="fecha_nac_t" form="formFiltroCamion" required>
                                        <label for="fecha_nac">Fecha de Nacimiento <span class="text-danger">*</span></label>
                                    </div>

                                </div>

                                <div class="col-6" style="display: none;" id="ocultarTipoChofer">
                                    <div class="form-floating mb-3">
                                        <select class="form-control fw-bold form-select" id="id_tipo_chofer" name="id_tipo_chofer" form="formFiltroCamion">
                                            <option selected disabled>Seleccione tipo de chofer</option>
                                            <option value="1">Personal Municipal</option>
                                            <option value="2">Personal Monotributista</option>
                                        </select>
                                        <label for="id_tipo_chofer">Tipo de Chofer <span class="text-danger">*</span></label>
                                    </div>
                                </div>

                                <div class="col-6" id="OcultarTipoLicenciaTitular" style="display: none;">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="tipo_licencia_titular" name="tipo_licencia_titular" form="formFiltroCamion">
                                        <label for="tipo_licencia_titular">Tipo Licencia ej(A.11) <span class="text-danger">*</span></label>
                                    </div>
                                </div>

                                <div class="col-6" id="OcultarVencimientoLicenciaTitular" style="display: none;">
                                    <div class="alert alert-primary bg-danger alert-dismissible fade show py-1 mb-1" role="alert" id="MsjVencimientoLicencia" style="display: none; font-size: 11px">
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="margin-top: -13px;"></button>
                                        <span class="fw-bold">La fecha de vencimiento de la licencia se encuentra expirada</span>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="date" class="form-control" id="vencimiento_licencia_titular" name="vencimiento_licencia_titular" form="formFiltroCamion">
                                        <label for="vencimiento_licencia_titular">Vencimiento Licencia <span class="text-danger">*</span></label>
                                    </div>

                                </div>

                                <div class="col-6">
                                    <div class="form-floating mb-3">
                                        <select class="form-control fw-bold form-select" id="id_nacionalidad" name="nacionalidad_titular" required form="formFiltroCamion">
                                            <option selected disabled>Nacionalidades</option>
                                            <?php foreach ($nacionalidades as  $value) { ?>
                                                <option value="<?php echo $value[0]; ?>"><?php echo $value[1]; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                        <label for="floatingInputValue">Nacionalidad <span class="text-danger">*</span></label>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="telefono" name="telefono_t" form="formFiltroCamion" required>
                                        <label for="telefono">Telefono <span class="text-danger">*</span></label>
                                    </div>

                                </div>

                                <div class="col-6">
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="telefono2" name="telefono2_t" form="formFiltroCamion">
                                        <label for="telefono">Telefono 2</label>
                                    </div>
                                </div>

                                <!-- <div class="col-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="direccion" name="direccion_t" form="formFiltroCamion" required>
                                        <label for="direccion">Dirección <span class="text-danger">*</span></label>
                                    </div>
                                </div> -->

                                <div class="col-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="mail_t" name="mail_t" form="formFiltroCamion">
                                        <label for="telefono">E-Mail</label>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-floating mb-2">
                                        <textarea class="form-control" name="Obs_t" id="Obs_t" cols="30" rows="10" form="formFiltroCamion"></textarea>
                                        <label for="Obs_t">Observaciones del titular</label>
                                    </div>
                                </div>


                                <div class="col-6">
                                    <div class="form-floating mb-3">
                                        <select class="form-control fw-bold form-select" id="id_barrio_t" name="barrio_titular" required form="formFiltroCamion">
                                            <option selected disabled>Seleccione un Barrio</option>
                                            <?php foreach ($barrios as  $value) { ?>
                                                <option value="<?php echo $value[0]; ?>"><?php echo $value[1]; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                        <label for="floatingInputValue">Barrios <span class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-floating mb-3">
                                        <select class="form-control fw-bold form-select" id="id_calle_t" name="calle_t" required form="formFiltroCamion">
                                            <option selected disabled>Seleccione una Calle</option>
                                            <?php foreach ($calles as  $value) { ?>
                                                <option value="<?php echo $value[0]; ?>"><?php echo $value[1]; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                        <label for="floatingInputValue">Calles <span class="text-danger">*</span></label>
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="numero" name="numero_t" form="formFiltroCamion" oninput="limitarCaracteres('numero', 5)">
                                        <label for="numero">Número</label>
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="mz" name="mz_t" form="formFiltroCamion" oninput="limitarCaracteres('mz', 5)">
                                        <label for="mz">Mz</label>
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="sector" name="sector_t" form="formFiltroCamion" oninput="limitarCaracteres('sector', 5)">
                                        <label for="sector">Sector</label>
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="parcela" name="parcela_t" form="formFiltroCamion" oninput="limitarCaracteres('parcela', 5)">
                                        <label for="parcela">Parcela</label>
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="casa" name="casa_t" form="formFiltroCamion" oninput="limitarCaracteres('casa', 5)">
                                        <label for="casa">Casa</label>
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="torre" name="torre_t" form="formFiltroCamion" oninput="limitarCaracteres('torre', 10)">
                                        <label for="torre">Torre</label>
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="piso" name="piso_t" form="formFiltroCamion" oninput="limitarCaracteres('piso', 10)">
                                        <label for="piso">Piso</label>
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="dpto" name="dpto_t" form="formFiltroCamion" oninput="limitarCaracteres('dpto', 10)">
                                        <label for="dpto">Dpto</label>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-floating mb-2">
                                        <textarea class="form-control" name="obs_dom" id="obs_dom" cols="30" rows="10" form="formFiltroCamion"></textarea>
                                        <label for="obs_dom">Observaciones del domicilio</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </form>
        </div>
        <div class="modal-footer">

            <div class="p-1 bd-highlight">
                <button type="button" class="btn btn-warning" onclick="limpiarCampos()">Limpiar Formulario</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary" form="formFiltroCamion" name="altaCamion">Guardar</button>
            </div>

        </div>
    </div>
</div>
</div>

<div class="modal fade" id="ModalA_Chofer" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">Asignar un Chofer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form method="POST" action="#" id="altaChoferes" name="A_CHOFER" novalidate onsubmit="return validarFormulario('altaChoferes', event)">
                        <div class=" row" id="registros">
                            <h5 class="text-center p-1 text-white fw-bold rounded back-blue">Ingrese el Chofer o Encargado</h5>

                            <div class="col-10">
                                <div class="form-floating mb-2">
                                    <input type="number" class="form-control" id="doc_chofer" placeholder="" autocomplete="off">
                                    <label for="patente">Buscar una persona (DNI)</label>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-floating mb-2">
                                    <button type="button" id="btn_buscar_chofer" class="btn btn-success p-3 fw-bold w-100"><i class="fas fa-search"></i></button>
                                </div>
                            </div>

                            <div class="alert alert-primary bg-danger alert-dismissible fade show py-3 mb-1" role="alert" id="MsjCampos" style="display: none;">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                <span class="fw-bold">Debe completar todos los campos</span>
                            </div>

                            <div class="col-12" id="alertExisteChoferxCamion" style="display: none;">
                                <div class="alert alert-light border border-danger border-1 text-danger" role="alert">
                                    La persona ingresada a esta registrada como chofer.
                                </div>
                            </div>

                            <div class="col-12" id="alertDniIncorrecto" style="display: none;">
                                <div class="alert alert-light border border-danger border-1 text-danger" role="alert">
                                    El número ingresado no cumple con la cantidad minima para el dni.
                                </div>
                            </div>


                            <input type="hidden" name="idCamion" id="idCamion" form="altaChoferes">

                            <input type="hidden" name="interno" id="dataInterno" form="altaChoferes">

                            <input type="hidden" name="dominio" id="datadominio" form="altaChoferes">

                            <div class="col-12">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="nombre_c_chofer" name="nombre_c_chofer" form="altaChoferes" required>
                                    <label for="nombre_c_chofer">Nombre Completo Chofer <span class="text-danger">*</span></label>
                                </div>
                            </div>


                            <div class="col-6">
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" id="dni_ch" name="dni_ch" form="altaChoferes" required>
                                    <label for="dni_ch">DNI <span class="text-danger">*</span></label>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-floating mb-3">
                                    <input type="date" class="form-control" id="fecha_nacimiento_ch" name="fecha_nacimiento_ch" form="altaChoferes" required>
                                    <label for="fecha_nacimiento_ch">Fecha de Nacimiento <span class="text-danger">*</span></label>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-floating mb-3">
                                    <select class="form-control fw-bold form-select" id="id_nacionalidad_ch" name="nacionalidad_ch" form="altaChoferes" required>
                                        <option selected disabled>Nacionalidades</option>
                                        <?php foreach ($nacionalidades as  $value) { ?>
                                            <option value="<?php echo $value[0]; ?>"><?php echo $value[1]; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                    <label for="floatingInputValue">Nacionalidad</label>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-floating mb-2">
                                    <select class="form-select form-select-lg fs-6" id="tipo_chofer" name="tipo_chofer" form="altaChoferes" required>
                                        <option selected disabled>Seleccionar</option>
                                        <option value="1">Personal Municipal</option>
                                        <option value="2">Personal Monotributista</option>
                                    </select>
                                    <label class="form-label">Tipo de Chofer <span class="text-danger">*</span></label>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" id="telefono_ch" name="telefono_ch" form="altaChoferes" required>
                                    <label for="telefono_ch">Telefono <span class="text-danger">*</span></label>
                                </div>
                                <div class="alert alert-primary bg-danger alert-dismissible fade show py-1 mb-1" role="alert" id="MsjTelerror" style="display: none; font-size: 11px;">
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="margin-top: -13px;"></button>
                                    <span class="fw-bold">El telofono no cumple con los caracteres minimos para ser aceptado</span>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" id="telefono2_ch" name="telefono2_ch" form="altaChoferes">
                                    <label for="telefono2_ch">Telefono 2</label>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="mail_ch" name="mail_ch" form="altaChoferes">
                                    <label for="mail_ch">E-Mail</label>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="tipo_licencia" name="tipo_licencia" form="altaChoferes" required>
                                    <label for="tipo_licencia">Tipo Licencia ej(A.11) <span class="text-danger">*</span></label>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-floating mb-3">
                                    <input type="date" class="form-control" id="vencimiento_licencia" name="vencimiento_licencia" form="altaChoferes" required>
                                    <label for="vencimiento_licencia">Vencimiento Licencia <span class="text-danger">*</span></label>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-floating mb-2">
                                    <textarea class="form-control" name="observaciones_ch" id="observaciones_ch" cols="30" rows="10" form="formFiltroCamion"></textarea>
                                    <label for="observaciones_ch">Observaciones</label>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-floating mb-3">
                                    <select class="form-control fw-bold form-select" id="id_barrio_chofer" name="barrio_chofer" required form="altaChoferes">
                                        <option selected disabled>Seleccione un Barrio</option>
                                        <?php foreach ($barrios as  $value) { ?>
                                            <option value="<?php echo $value[0]; ?>"><?php echo $value[1]; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                    <label for="floatingInputValue">Barrios <span class="text-danger">*</span></label>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-floating mb-3">
                                    <select class="form-control fw-bold form-select" id="id_calle_chofer" name="calle_chofer" required form="altaChoferes">
                                        <option selected disabled>Seleccione una Calle</option>
                                        <?php foreach ($calles as  $value) { ?>
                                            <option value="<?php echo $value[0]; ?>"><?php echo $value[1]; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                    <label for="floatingInputValue">Calles <span class="text-danger">*</span></label>
                                </div>
                            </div>


                            <div class="col-3">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="numero_ch" name="numero_ch" form="altaChoferes" oninput="limitarCaracteres('numero_ch', 5)">
                                    <label for="numero_ch">Número</label>
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="mz_ch" name="mz_ch" form="altaChoferes" oninput="limitarCaracteres('mz_ch', 5)">
                                    <label for="mz_ch">Mz</label>
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="sector_ch" name="sector_ch" form="altaChoferes" oninput="limitarCaracteres('sector_ch', 5)">
                                    <label for="sector_ch">Sector</label>
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="parcela_ch" name="parcela_ch" form="altaChoferes" oninput="limitarCaracteres('parcela_ch', 5)">
                                    <label for="parcela_ch">Parcela</label>
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="casa_ch" name="casa_ch" form="altaChoferes" oninput="limitarCaracteres('casa_ch', 5)">
                                    <label for="casa_ch">Casa</label>
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="torre_ch" name="torre_ch" form="altaChoferes" oninput="limitarCaracteres('torre_ch', 10)">
                                    <label for="torre_ch">Torre</label>
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="piso_ch" name="piso_ch" form="altaChoferes" oninput="limitarCaracteres('piso_ch', 10)">
                                    <label for="piso_ch">Piso</label>
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="dpto_ch" name="dpto_ch" form="altaChoferes" oninput="limitarCaracteres('dpto_ch', 10)">
                                    <label for="dpto_ch">Dpto</label>
                                </div>
                            </div>

                        </div>
                    </form>
                    <!-- <div class="row">
                        <div class="col-4">
                            <div class="form-floating w-100 mb-2">
                                <button type="button" onclick="nuevoRegistro()" class="btn btn-primary fs-6 w-100">Agregar Chofer <i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary" form="altaChoferes" name="A_CHOFER">Guardar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ModalB_Camion" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">Borrar Camion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="#" method="post" id="BajaCamion">
                    <h3>Está Seguro que desea borrar el camion?</h3>

                    <input type="hidden" name="idCamion" id="bajaidCamion" form="BajaCamion">
                    <input type="hidden" name="dominio" id="bajadominio" form="BajaCamion">

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-danger" name="ConfirmacionBajaCamion" form="BajaCamion">Confirmar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ModalDet_Camion" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-x-
    l" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">Detalle Camion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- <form action="#" method="post" id="BajaCamion">

                </form> -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <!-- <button type="submit" class="btn btn-danger">Confirmar</button> -->
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ModalB_Chofer" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">Eliminar Chofer o Encargado</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="#" method="post" id="BajaChofer">
                    <h3>Está Seguro que desea eliminar el chofer?</h3>

                    <input type="hidden" name="idCamion" id="idBajaCamion" form="BajaChofer">
                    <input type="hidden" name="idChofer" id="bajaidChofer" form="BajaChofer">

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-danger" name="ConfirmacionBajaChofer" form="BajaChofer">Confirmar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ModalR_Chofer" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">Activar chofer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="#" method="post" id="ActivarChofer">
                    <h3>Está Seguro que desea volver a acivar el chofer?</h3>

                    <input type="hidden" name="idCamion" id="idActCamion" form="ActivarChofer">
                    <input type="hidden" name="idChofer" id="idActChofer" form="ActivarChofer">

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-success" name="ConfirmacionActivarChofer" form="ActivarChofer">Confirmar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ModalM_persona" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">Modificar datos del Encargado</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row" action="#" method="post" id="modificaPersona" onsubmit="return ValidaFormularioModiPersona()">

                    <input type="hidden" name="idPersona" id="id_persona_chofer">
                    <input type="hidden" name="idCamion" id="id_camion">

                    <div class="col-12">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="val_apellidosNombres" name="apellidosNombres" form="modificaPersona" required>
                            <label for="val_apellidosNombres">Nombre Completo Chofer <span class="text-danger">*</span></label>
                        </div>
                    </div>



                    <div class="col-6">
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" id="val_dni" name="dni" form="modificaPersona" required>
                            <label for="val_dni">DNI <span class="text-danger">*</span></label>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-floating mb-3">
                            <input type="date" class="form-control" id="val_fechaNacimiento" name="fechaNacimiento" form="modificaPersona" required>
                            <label for="val_fechaNacimiento">Fecha de Nacimiento <span class="text-danger">*</span></label>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-floating mb-3">
                            <select class="form-control fw-bold form-select" id="val_Nacionalidad" name="Nacionalidad" form="modificaPersona" required>
                                <option selected disabled>Nacionalidades</option>
                                <?php foreach ($nacionalidades as  $value) { ?>
                                    <option value="<?php echo $value[0]; ?>"><?php echo $value[1]; ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <label for="val_Nacionalidad">Nacionalidad <span class="text-danger">*</span></label>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-floating mb-2">
                            <input type="date" class="form-control" id="val_fecVencimientoLicencia" name="vencimiento_licencia" form="modificaPersona" required>
                            <label for="val_fecVencimientoLicencia">Vencimiento de la licencia <span class="text-danger">*</span></label>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-floating mb-2">
                            <textarea class="form-control" name="obs" id="val_obs" cols="30" rows="10" form="modificaPersona"></textarea>
                            <label for="val_obs">Observaciones</label>
                        </div>
                    </div>




                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-success" name="modificaPersona" form="modificaPersona">Confirmar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ModalM_contacto" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">Modificar Contacto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="#" method="post" id="modificaContacto">

                    <input type="hidden" name="idCamion" id="val_idCamion">
                    <input type="hidden" name="idContacto" id="val_idContacto">

                    <div class="col-12">
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" id="val_celular1" name="celular1" form="modificaContacto" required>
                            <label for="val_celular1">Telefono <span class="text-danger">*</span></label>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" id="val_celular2" name="celular2" form="modificaContacto">
                            <label for="val_celular2">Telefono 2</label>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="val_mail" name="mail" form="modificaContacto">
                            <label for="val_mail">E-Mail</label>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-success" name="modificaContacto" form="modificaContacto">Confirmar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ModalM_domicilio" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">Modificar Domicilio del Encargado</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row" action="#" method="post" id="modificaDomicilio">

                    <input type="hidden" name="idCamion" id="val_idCamion_dom">
                    <input type="hidden" name="idDomicilio" id="val_idDomicilio">

                    <div class="col-6">
                        <div class="form-floating mb-3">
                            <select class="form-control fw-bold form-select" id="val_idBarrio" name="idBarrio" required form="modificaDomicilio">
                                <option selected disabled>Seleccione un Barrio</option>
                                <?php foreach ($barrios as  $value) { ?>
                                    <option value="<?php echo $value[0]; ?>"><?php echo $value[1]; ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <label for="val_idBarrio">Barrios <span class="text-danger">*</span></label>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-floating mb-3">
                            <select class="form-control fw-bold form-select" id="val_idCalle" name="idCalle" required form="modificaDomicilio">
                                <option selected disabled>Seleccione una Calle</option>
                                <?php foreach ($calles as  $value) { ?>
                                    <option value="<?php echo $value[0]; ?>"><?php echo $value[1]; ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <label for="val_idCalle">Calles <span class="text-danger">*</span></label>
                        </div>
                    </div>


                    <div class="col-3">
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" id="val_nro_dom" name="numero" form="modificaDomicilio" maxlength="5">
                            <label for="val_nro">Número</label>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" id="val_mz" name="mz" form="modificaDomicilio" maxlength="5">
                            <label for="val_mz">Mz</label>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" id="val_sector" name="sector" form="modificaDomicilio" maxlength="5">
                            <label for="val_sector">Sector</label>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" id="val_parcela" name="parcela" form="modificaDomicilio" maxlength="5">
                            <label for="val_parcela">Parcela</label>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" id="val_casa" name="casa" form="modificaDomicilio" maxlength="5">
                            <label for="val_casa">Casa</label>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" id="val_torre" name="torre" form="modificaDomicilio" maxlength="10">
                            <label for="val_torre">Torre</label>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" id="val_piso" name="piso" form="modificaDomicilio" maxlength="10">
                            <label for="val_piso">Piso</label>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" id="val_depto" name="dpto" form="modificaDomicilio" maxlength="10">
                            <label for="val_depto">Dpto</label>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-success" name="modificaDomicilio" form="modificaDomicilio" maxlength="3">Confirmar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ModalM_camion" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">Modificar Datos del camion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row" action="#" method="post" id="modificaCamion" onsubmit="return ValidaVencimientoSeguro()">


                    <div class="col-2">
                        <div class="form-floating form-floating-css mb-3">
                            <input type="text" class="form-control" name="idCamion" id="modi_idCamion" form="modificaCamion" readonly>
                            <label for="idCamion">ID</label>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-floating form-floating-css mb-3">
                            <input type="text" class="form-control" name="dominio" id="modi_dominio" form="modificaCamion" disabled>
                            <label for="dominio">Dominio</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-floating form-floating-css mb-3">
                            <input type="text" class="form-control" name="modelo" id="modi_modelo" form="modificaCamion" disabled>
                            <label for="modelo">Modelo</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-floating form-floating-css mb-3">
                            <input type="text" class="form-control" name="marca" id="modi_marca" form="modificaCamion" disabled>
                            <label for="marca">Marca</label>
                        </div>
                    </div>


                    <div class="col-6">
                        <div class="form-floating form-floating-css mb-2">
                            <input type="text" class="form-control" id="modi_chasis" name="chasis" value="" form="modificaCamion" required>
                            <label for="chasis">N° Chasis <span class="text-danger">*</span></label>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-floating form-floating-css form-floating-css-select mb-2">
                            <select class="form-select form-select-lg fs-6" id="modi_tipo_servicio" name="tipo_servicio" form="modificaCamion" required>
                                <option selected disabled>Seleccionar</option>
                                <option value="1">Batea</option>
                                <option value="2">Balancines</option>
                                <option value="3">Portacontenedores</option>
                                <option value="4">Compactador</option>
                            </select>
                            <label class="form-label">Tipo de Servicio <span class="text-danger">*</span></label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-floating form-floating-css mb-2">
                            <input type="number" class="form-control" id="modi_interno" name="interno" form="modificaCamion">
                            <label for="interno">N° Interno </label>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-floating form-floating-css mb-2">
                            <input type="text" class="form-control" id="modi_seguro" name="seguro" form="modificaCamion" required>
                            <label for="seguro">Seguro <span class="text-danger">*</span></label>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-floating form-floating-css mb-2">
                            <input type="date" class="form-control" id="modi_vencimiento_seguro" name="vencimiento_seguro" form="modificaCamion" required>
                            <label for="vencimiento_seguro">Vencimiento Seguro <span class="text-danger">*</span></label>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-floating form-floating-css mb-2">
                            <textarea class="form-control" name="descripcion_cam" id="modi_descripcion_cam" cols="30" rows="10" form="modificaCamion"></textarea>
                            <label for="descripcion_cam">Observaciones</label>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-success" name="modificaCamion" form="modificaCamion">Confirmar</button>
            </div>
        </div>
    </div>
</div>