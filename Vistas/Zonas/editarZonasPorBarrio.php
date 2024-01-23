<div class="modal fade" id="modalModificarZona" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalModificarZonaLabel" aria-hidden="true" data-nroZona="">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <!-- Encabezado del modal -->
            <div class="modal-header">
                <h5 class="modal-title" id="modalModificarZonaLabel">Modificar Zona</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>

            <form name="ModificarDatos" action="" method="POST" id="FormBarrioPorZona">

            <!-- Cuerpo del modal -->
            <div class="modal-body">

                <!-- Tabla para mostrar los barrios seleccionados -->
                <table id="tablaBarriosXZonaModificar" class="table table-bordered table-striped">
                    <thead>
                        <tr class="text-center">
                            <th>Barrio</th>
                            <th>Borrar</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>

                <!-- Nuevo select para seleccionar barrios -->
                <div class="row">
                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="form-floating">
                                    <select class="form-select required Barrio" onChange="validarBarrio(this.value)" id="codBarrioModificar" aria-label="barrio" required>
                                        <option disabled selected>Abrir el menú de selección</option>
                                        <?php
                                        $listadoBarrio = ControladorGestor::CtrListadoBarrios();
                                        foreach ($listadoBarrio as $barrio):
                                        ?>
                                            <option value="<?= $barrio["Id"]; ?>"><?= $barrio["Detalle"] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <label for="barrio">BARRIO <b class="text-danger">(*)</b></label>
                                </div>
                                <button type="button" class="btn btn-info" id="agregarBarrioBoton" onclick="agregarBarrioModificar()"><i class="fa-solid fa-square-check fa-xl"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pie del modal -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary d-none" id="botonGuardarCambios" onclick="validarRegistroAltaModificacion()">Guardar Cambios</button>
            </div>

            </form>
        </div>
    </div>
</div>


