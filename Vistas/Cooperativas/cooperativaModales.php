<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
      <div class="modal-header bs-info-bg-subtle">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">FORMULARIO DE ALTA DE COOPERATIVA</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <!-- MODAL COOPERATIVA -->

            <ul class="nav nav-tabs border-0" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link d-flex bd-highlight active fw-bold" id="paso1-tab" data-bs-toggle="tab" data-bs-target="#paso1" type="button" role="button" aria-controls="home" aria-selected="true" disabled> <i class="d-none mt-1 mx-2"></i> COOPERATIVA </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link d-flex bd-highlight fw-bold" id="paso2-tab" data-bs-toggle="tab" data-bs-target="#paso2" type="button" role="button" aria-controls="profile" aria-selected="false" disabled><i class="d-none mt-1 mx-2"></i>PRESIDENTE COOPERATIVA</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link d-flex bd-highlight fw-bold" id="paso3-tab" data-bs-toggle="tab" data-bs-target="#paso3" type="button" role="button" aria-controls="contact" aria-selected="false" disabled><i class="d-none mt-1 mx-2"></i>PERSONAL DE COOPERATIVA</button>
                </li>
            </ul>
        <form id="FormContribu">


            <div class="tab-content p-2 rounded shadow py-3 px-3" id="myTabContent" style="border: solid 1px #ebebeb">
                <div class="tab-pane fade elemento-activo show active" id="paso1" role="tabpanel" aria-labelledby="paso1-tab">
                    <div class="row">
                        <div class="col-12 d-none" id="msj1">
                            <div class="alert border border-danger text-danger shadow" role="alert">
                                <i class="fas fa-exclamation-triangle"></i> Para continuar debe completar todos los campos requeridos que estan marcados <b class="text-danger">(*)</b>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 mb-2">
                            <div class="form-floating mb-2">
                                <input type="text" class="form-control required" id="razonSocial" name="razonSocial" required>
                                <label for="RazonSocial">RAZÓN SOCIAL <b class="text-danger">(*)</b></label>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 mb-2">
                            <div class="form-floating mb-2">
                                <input type="number" class="form-control required" id="cuitCuil" name="cuitCuil" required>
                                <label for="cuitCuil">CUIT - CUIL <b class="text-danger">(*)</b></label>
                                <small class="text-danger">Números sin guiones</small>
                            </div>
                        </div>

                        <!-- SECCION DE DATOS DE DOMICILIO -->
                        <div class="col-12 p-2 mb-3 rounded text-center bg-dark bg-gradient">DOMICILIO</div>

                        <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 mb-2"> 
                            <div class="form-floating mb-2">
                                <select class="form-select required" id="barrio" name="barrio" aria-label="barrio" required>
                                    <option selected>Abrir el menu de selección</option>
                                    <?php $listadoBarrio = ControladorGestor::CtrListadoBarrios(); 
                                          foreach ($listadoBarrio as $barrio):
                                    ?>
                                    <option id="<?=$barrio["Id"]?>"><?=$barrio["Detalle"]?></option>
                                    <?php endforeach;?>
                                </select>
                                <label for="barrio">BARRIO <b class="text-danger">(*)</b></label>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-5 col-sm-10 col-xs-10 mb-2">
                            <div class="form-floating mb-2">
                                <select class="form-select" id="calle" name="calle" aria-label="calle">
                                    <option selected>Abrir el menu de selección</option>
                                    <?php $listadoCalle = ControladorGestor::CtrListadoCalle(); 
                                          foreach ($listadoCalle as $Calle):
                                    ?>
                                    <option id="<?=$Calle["Id"]?>"><?=$Calle["Detalle"]?></option>
                                    <?php endforeach;?>
                                </select>
                                <label for="calle">CALLE</label>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 mb-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="altura" name="altura">
                                <label for="altura">ALTURA</label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-2 col-xs-2 mb-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="manzana" name="manzana">
                                <label for="manzana">MANZANA</label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 mb-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="sector" name="sector">
                                <label for="sector">SECTOR</label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 mb-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="parcela" name="parcela">
                                <label for="parcela">PARCELA</label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 mb-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="casa" name="casa">
                                <label for="casa">CASA</label>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 mb-3 mb-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="torre" name="torre">
                                <label for="torre">TORRE</label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 mb-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="piso" name="piso">
                                <label for="piso">PISO</label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 mb-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="departamento" name="departamento">
                                <label for="departamento">DEPARTAMENTO</label>
                            </div>
                        </div>

                        <!-- SECCION DE DATOS DE DOMICILIO -->
                        <div class="col-12 p-2 mb-3 rounded text-center bg-dark bg-gradient">CONTACTO</div>

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 mb-3">
                            <div class="form-floating">
                                <input type="email" class="form-control" id="email" name="email">
                                <label for="email">EMAIL</label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 mb-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="celular" name="celular">
                                <label for="celular">CELULAR <b class="text-danger">(*)</b></label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 mb-3 mb-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="celularAlternativo" name="celularAlternativo">
                                <label for="celularAlternativo">CELULAR ALTERNATIVO</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="paso2" role="tabpanel" aria-labelledby="paso2-tab">
                    <div class="row">
                        <div class="col-12 d-none" id="msj2">
                            <div class="alert border border-danger text-danger shadow" role="alert">
                                <i class="fas fa-exclamation-triangle"></i> Para continuar debe completar todos los campos requeridos que estan marcados <b class="text-danger">(*)</b>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-floating mb-3">
                                <input type="search" class="form-control" id="dni" name="dni" onkeyup="buscarPersonas(this)">
                                <label for="dni">DNI</label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="apellidoNombre" name="apellidoName">
                                <label for="nombre">Nombre Completo</label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="fechaNacimiento" name="fechaNacimiento">
                                <label for="nombre">Fecha de Nacimiento</label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="telefono">
                                <label for="telefono">Telefono</label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="email">
                                <label for="email">Dirección</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="paso3" role="tabpanel" aria-labelledby="paso3-tab">
                    <div class="row">
                        <div class="col-12 d-none" id="msj3">
                            <div class="alert border border-danger text-danger shadow" role="alert">
                                <i class="fas fa-exclamation-triangle"></i> Para continuar debe completar todos los campos requeridos que estan marcados <b class="text-danger">(*)</b>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check mt-3 mb-3">
                                <input class="form-check-input" type="checkbox" value="" id="eschofertitular" onclick="ValidarChoferTitular()">
                                <label class="form-check-label" for="eschofertitular">
                                    Es titular y chofer
                                </label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="dni-chofer">
                                <label for="dni-chofer">DNI</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="nombre-chofer">
                                <label for="nombre-chofer">Nombre Completo</label>
                            </div>

                        </div>
                        <div class="col-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="tel-chofer">
                                <label for="tel-chofer">Telefono</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="mail-chofer">
                                <label for="mail-chofer">Dirección</label>
                            </div>
                        </div>
                    </div>
                </div>
        </form>
            </div>
        </div>
        <div class="modal-footer d-flex bd-highlight">
            <div class="p-1 flex-grow-1 bd-highlight">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar <i class="fas fa-times"></i></button>
            </div>
            <div class="p-1 bd-highlight">
                <button type="button" id="back" class="btn btn-danger" onClick="ValidarBack()" disabled><i class="fas fa-arrow-left"></i> Atras </button>
            </div>
            <div class="p-1 bd-highlight">

                <button type="button" id="next" class="btn btn-success" onClick="ValidarNext()"> Siguiente <i class="fas fa-arrow-right"></i></button>
                <button type="button" class="btn btn-success" id="save" style="display: none;" onClick="ValidarSave()">Guardar <i class="fas fa-save"></i></button>
            </div>
        </div>
    </div>
</div>
<script>
    // $('#single-select-field').select2( {
    //     theme: "bootstrap-5",
    //     dropdownParent: $('#staticBackdrop'),
    //     width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
    //     placeholder: $( this ).data( 'placeholder' ),
    // } );
</script>