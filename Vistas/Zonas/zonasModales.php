<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
        <div class="modal-header bs-info-bg-subtle">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">FORMULARIO DE ALTA DE ZONAS</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form name="RegistrarDatos" action="" method="POST" id="FormZona">

        <div class="modal-body">

            <div class="row">

                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <div class="form-group">
                    <div class="form-floating mb-2">
                        <?php $nroZona = ControladorGestor::CtrMostrarNroZona(); 
                            foreach ($nroZona as $nro):?>
                            <input type="number" class="form-control required" value="<?php echo $nro[0]; ?>" readonly>
                        <?php endforeach;?>
                         <label for="Zona">ZONA <b class="text-danger">(*)</b></label>
                    </div>
                </div>
                </div>

                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                <div class="form-group">
                    <div class="input-group">
                        <div class="form-floating">
                            <select class="form-select required Barrio" onChange="validarBarrio(this.value)" id="codBarrio" aria-label="barrio" required>
                                <option disabled selected>Abrir el menú de selección</option>
                                <?php $listadoBarrio = ControladorGestor::CtrListadoBarrios(); 
                                    foreach ($listadoBarrio as $barrio):
                                ?>
                                <option value="<?= $barrio["Id"];?>"><?=$barrio["Detalle"]?></option>
                                <?php endforeach;?>
                            </select>
                                <label for="barrio">BARRIO <b class="text-danger">(*)</b></label>
                        </div>
                        <button type="button" class="btn btn-info" id="botonAgregar" onclick="agregarBarrio()"><i class="fa-solid fa-square-check fa-xl"></i></button>
                    </div>
                </div>
                </div>

            </div>

        </div>

        <div class="modal-body d-flex justify-content-center">

                <table id="tablaBarriosXZona" class="table table-bordered table-striped">
                    <thead>
                        <tr class="text-center">
                            <th>Barrio</th>
                            <th>Borrar</th>
                        </tr>
                    </thead>
                  <tbody>
                    <tr>
                        
                    </tr>
                  </tbody>
                </table>
        </div>

        <div class="modal-footer d-flex bd-highlight">
            <div class="p-1 flex-grow-1 bd-highlight">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar </button>
            </div>
            <div class="p-1 bd-highlight">

                <button type="button" name="registrar" class="btn btn-success" id="btnGuardar" onclick="insertarRegistro()" disabled> Guardar <i class="fas fa-save"></i></button>

            </div>
        </div>

        </form>

    </div>
    </div>
</div>
