<?php
include_once "Controladores/ControladorCamiones.php";
include_once "Controladores/ControladorViaje.php";
include_once "Modelos/ModelosCamiones.php";
include_once "Modelos/ModeloViaje.php";


$camionesActivos = ControladoresViajes::CtrlListarCamionesViaje();
$listadoCooperativas = ControladoresViajes::CtrlCooperativas();
$ListarZonas = ControladoresViajes::CtrlListarZonas();
$ListarTiposServicios = ControladoresViajes::CtrlListarTiposServicios();

$fechaActual = date('Y-m-d H:i:s');

// Separar la fecha en horas, minutos, día, mes y año
$hora = date('H', strtotime($fechaActual));
$minutos = date('i', strtotime($fechaActual));
$dia = date('d', strtotime($fechaActual));
$mes = date('m', strtotime($fechaActual));
$año = date('Y', strtotime($fechaActual));

$Hora = date('H:i');


?>
<style>
  #camionesSelect option {
    background-color: #ebebeb;
    color: #264873;
    font-weight: bold;
    padding-top: 5px !important;
    padding-bottom: 5px !important;
    cursor: pointer;

    /* Agrega cualquier otro estilo que desees */
  }

  #camionesSelect option:disabled {
    /* background-color: #ebebeb; */
    color: #EC7063;
    /* font-weight: bold; */
    padding-top: 5px !important;
    padding-bottom: 5px !important;
    /* Agrega cualquier otro estilo que desees */
  }

  #choferesCamion option {
    background-color: #ebebeb;
    color: #264873;
    font-weight: bold;
    padding-top: 5px !important;
    padding-bottom: 5px !important;
    cursor: pointer;

    /* Agrega cualquier otro estilo que desees */
  }

  #choferesCamion option:disabled {
    /* background-color: #ebebeb; */
    color: #EC7063;
    /* font-weight: bold; */
    padding-top: 5px !important;
    padding-bottom: 5px !important;
    /* Agrega cualquier otro estilo que desees */
  }

  #trueSer {
    color: #636363 !important;
  }
</style>



<div class="modal fade" id="nuevoServicio" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
      <div class="modal-header bs-info-bg-subtle">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">FORMULARIO DE ALTA DE DESCARGA</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="#" method="post" name="AltaServicio" id="AltaServicio">
          <div class="row mb-2">
            <div class="col-12">

              <?php if ($hora >= 6 && $hora < 13) {
                $idTurno = 1; ?>
                <div class="alert bg-success py-1 shadow-sm" role="alert">
                  <strong>Turno mañana</strong> - <?php echo $Hora ?>
                </div>
              <?php } else if ($hora >= 13 && $hora < 20) {
                $idTurno = 2; ?>
                <div class="alert bg-warning py-1 shadow-sm" role="alert">
                  <strong>Turno Tarde</strong> - <?php echo $Hora ?>
                </div>
              <?php } else {
                $idTurno = 3; ?>
                <div class="alert bg-warning py-1 shadow-sm" role="alert">
                  <strong>Turno Noche</strong> - <?php echo $Hora ?>
                </div>
              <?php } ?>
            </div>
            <div class="col-4">
              <span>Seleccione metodo de busqueda: </span>
            </div>
            <div class="col-4 mt-2">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="metodoFiltro" value="1" onchange="mostrarSeleccion()" id="listado" checked />
                <label class="form-check-label" for="listado" style="cursor: pointer;">Listado</label>
              </div>
            </div>
            <div class="col-4 mt-2">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="metodoFiltro" value="2" onchange="mostrarSeleccion()" id="buscador" />
                <label class="form-check-label" for="buscador" style="cursor: pointer;"> Buscador </label>
              </div>
            </div>

            <!-- <input type="text" name="emi" required form="AltaServicio"> -->

            <div class="col-12 mt-2" id="ocultaSelectDominio" style="display: block;">

              <div class="form-floating mb-3">
                <select class="form-control fw-bold form-select" id="camionesSelect" name="id_camion_select" form="AltaServicio">
                  <option selected disabled value="">Seleccione un dominio</option>

                  <?php
                  foreach ($camionesActivos as $camionAct) {
                    $valCamionServicio = ControladoresViajes::CtrlValidaCamionServicio($camionAct['idCamion'], $fechaActual);



                    if ($camionAct['vencimientoSeguro'] > $fechaActual) {
                      if ($camionAct['idEstado'] == 11) {
                        if (!empty($valCamionServicio)) { ?>
                          <option disabled id="trueSer" value=""><?php echo $camionAct['dominio'] ?> <span style="color: red !important;"></span>(vehiculo ya asignado)</option>
                        <?php } else {
                          $Interno = " - " . $camionAct['interno']; ?>
                          <option value="<?php echo $camionAct['idCamion'] ?>"><?php echo $camionAct['dominio'] . " - " . $camionAct['interno'] ?></option>
                      <?php
                        }
                      }
                    } else {

                      $Interno = " - " . $camionAct['interno'];  ?>
                      <option disabled value="<?php echo $camionAct['idCamion'] ?>"><?php echo $camionAct['dominio'] . $Interno ?> <span style="color: red !important;"></span>(seguro Vencido)</option>

                  <?php }
                  } ?>


                </select>
                <label for="camionesSelect">Dominio - Interno</label>
              </div>
            </div>

            <input type="hidden" name="idTurno" value="<?php echo $idTurno ?>">
            <div class="col-12 mt-2" id="ocultaBuscadorDominio" style="display: none;">

              <div class="row">
                <div class="col-10">
                  <div class="form-floating mb-2">
                    <input type="text" class="form-control" id="buscar_dom_descarga" name="id_camion_filtro" placeholder="" autocomplete="off" form="AltaServicio">
                    <label for="patente">Buscar una patente</label>
                  </div>
                  <input type="hidden" name="id_camion" id="CargaCamionFiltro" value="" form="AltaServicio">
                </div>
                <div class="col-2">
                  <div class="form-floating mb-2">
                    <button type="button" id="btnBuscarDomDescarga" class="btn btn-success p-3 fw-bold w-100"><i class="fas fa-search"></i></button>
                  </div>
                </div>
              </div>

            </div>
            <div class="col-12 mt-2" id="alertSeguroVencido" style="display: none;">
              <div class="alert alert-light border border-danger border-2 text-danger fw-bold" role="alert">
                El seguro del camion ingresado se encuentra expirado, para continuar regularice la situacion
              </div>
            </div>

            <div class="col-12 mt-2">
              <div class="form-floating mb-3">
                <select class="form-control fw-bold form-select" id="SelectTipoServicio" name="id_tipo_servicio" form="AltaServicio" required>
                  <option selected disabled value="">Seleccione un tipo de servicio</option>
                  <?php
                  foreach ($ListarTiposServicios as $servicio) { ?>
                    <option value="<?php echo $servicio['idTipoServicio'] ?>"><?php echo $servicio['detalle']  ?></option>
                  <?php } ?>
                </select>
                <label for="camionesSelect">Tipos de Servicio</label>
              </div>
            </div>


            <div class="col-6 mt-2">
              <div class="form-floating ">
                <select class="form-select" id="choferesCamion" name="choferCamion" aria-label="Floating label select example" form="AltaServicio" required>
                  <option disabled selected value="">Seleccionar</option>
                </select>
                <label for="choferesCamion">CHOFERES</label>
              </div>
            </div>


            <div class="col-6 mt-2">

              <div class="form-floating ">
                <select class="form-select" id="coopSelect" name="id_cooperativa" aria-label="Floating label select example" form="AltaServicio" required>
                  <option disabled selected value="">Seleccionar</option>
                  <?php
                  foreach ($listadoCooperativas as $coop) {
                  ?>
                    <option value="<?php echo $coop['id'] ?>"><?php echo $coop['razonSocial'] ?></option>
                  <?php }

                  ?>
                </select>
                <label for="coopSelect">COOPERATIVAS</label>
              </div>
              <div class="valida-interno-err text-danger px-1 py-1 rounded mb-1 fw-bold" id="valida-vencimiento-seg" style="display: none; font-size: 11px;">
                Atencion. El seguro de la cooperativa se encuentra vencido
              </div>
            </div>




            <div class="col-6 mt-2">
              <div class="form-floating ">
                <select class="form-select" id="GruposSelect" name="id_grupo" onchange="SelectGrupo()" aria-label="Floating label select example" form="AltaServicio" required>
                  <option disabled selected value="">Seleccionar</option>
                </select>
                <label for="GruposSelect">GRUPOS</label>
              </div>
            </div>

            <div class="col-6 mt-2">
              <div class="form-floating ">
                <select class="form-select" id="id_zona" name="id_zona" aria-label="Floating label select example" form="AltaServicio" required>
                  <option disabled selected value="">Seleccionar</option>
                  <?php
                  foreach ($ListarZonas as $zona) {
                  ?>
                    <option value="<?php echo $zona['id'] ?>"><?php echo $zona['nroZona'] ?></option>
                  <?php }

                  ?>
                </select>
                <label for="id_zona">ZONAS</label>
              </div>
            </div>

            <div class="col-12 mt-3">
              <div class="form-floating">
                <div class="row">

                  <div class="col-10 text-center">
                    <h5 class="mt-1" style="font-size: 14px;">LISTA DE PERSONAL DEL GRUPO SELECCIONADO</h5>
                  </div>
                </div>
              </div>
              <div id="tablaEquipo"></div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary" onclick="ValidaEquipo()" name="confirmaAltaServicio" form="AltaServicio">Crear Servicio</button>
      </div>
    </div>
  </div>
</div>

<!-- <div class="modal fade" id="nuevoServicio" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
      <div class="modal-header bs-info-bg-subtle">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">FORMULARIO DE ALTA DE DESCARGA</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row mb-2">
          <div class="col-12">
            <?php if ($hora > 12 && $hora < 15) { ?>
              <div class="alert bg-success" role="alert">
                <strong>Turno Tarde</strong> - <?php echo $Hora ?>
              </div>
            <?php } ?>
          </div>
          <div class="col-4">
            <span>Seleccione metodo de busqueda: </span>
          </div>
          <div class="col-4 mt-2">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="metodoFiltro" value="1" onchange="mostrarSeleccion()" id="listado" checked />
              <label class="form-check-label" for="listado" style="cursor: pointer;">Listado</label>
            </div>
          </div>
          <div class="col-4 mt-2">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="metodoFiltro" value="2" onchange="mostrarSeleccion()" id="buscador" />
              <label class="form-check-label" for="buscador" style="cursor: pointer;"> Buscador </label>
            </div>
          </div>


          <div class="col-12 mt-2" id="ocultaSelectDominio" style="display: block;">
            <div class="form-floating mb-3">
              <select class="form-control fw-bold form-select" id="camionesSelect" name="camionesSelect" form="formFiltroCamion">
                <option selected>Seleccione un dominio</option>

                <?php
                foreach ($camionesActivos as $camionAct) {
                  if ($camionAct['vencimientoSeguro'] > $fechaActual) {
                    if ($camionAct['idEstado'] == 11) {
                      $Interno = " - " . $camionAct['interno']; ?>
                      <option value="<?php echo $camionAct['idCamion'] ?>"><?php echo $camionAct['dominio'] . " - " . $camionAct['interno'] ?></option>
                    <?php }
                  } else {

                    $Interno = " - " . $camionAct['interno'];  ?>
                    <option disabled value="<?php echo $camionAct['idCamion'] ?>"><?php echo $camionAct['dominio'] . $Interno ?> <span style="color: red !important;"></span>(Seguro Vencido)</option>

                  <?php }

                  ?>

                <?php } ?>

              </select>
              <label for="camionesSelect">Dominio - Interno</label>
            </div>
          </div>


          <div class="col-12 mt-2" id="ocultaBuscadorDominio" style="display: none;">
            
            <div class="row">
              <div class="col-10">
                <div class="form-floating mb-2">
                  <input type="text" class="form-control" id="buscar_dom_descarga" placeholder="" autocomplete="off">
                  <label for="patente">Buscar una patente</label>
                </div>
              </div>
              <div class="col-2">
                <div class="form-floating mb-2">
                  <button type="button" id="btnBuscarDomDescarga" class="btn btn-success p-3 fw-bold w-100"><i class="fas fa-search"></i></button>
                </div>
              </div>
            </div>

          </div>
          <div class="col-12 mt-2" id="alertSeguroVencido" style="display: none;">
            <div class="alert alert-light border border-danger border-2 text-danger fw-bold" role="alert">
              El seguro del camion ingresado se encuentra expirado, para continuar regularice la situacion
            </div>
          </div>



          <div class="col-6 mt-2">
            <div class="form-floating ">
              <select class="form-select" id="choferesCamion" name="choferCamion" aria-label="Floating label select example">
                <option selected>Seleccionar</option>
              </select>
              <label for="choferesCamion">CHOFERES</label>
            </div>
          </div>


          <div class="col-6 mt-2">
            <div class="form-floating ">
              <select class="form-select" id="coopSelect" name="id_cooperativa" aria-label="Floating label select example">
                <option selected>Seleccionar</option>
                <?php
                foreach ($listadoCooperativas as $coop) {
                ?>
                  <option value="<?php echo $coop['id'] ?>"><?php echo $coop['razonSocial'] ?></option>
                <?php }

                ?>
              </select>
              <label for="coopSelect">COOPERATIVAS</label>
            </div>
            <div class="valida-interno-err bg-danger p-1 rounded mt-1 px-3 fw-bold" id="valida-vencimiento-seg" style="display: none; font-size: 11px;">
              Atencion. El seguro de la cooperativa se encuentra vencido
            </div>
          </div>



          <div class="col-6 mt-2">
            <div class="form-floating ">
              <select class="form-select" id="GruposSelect" name="id_grupo" onchange="SelectGrupo()" aria-label="Floating label select example">
                <option selected>Seleccionar</option>
              </select>
              <label for="GruposSelect">Grupos</label>
            </div>
          </div>

          <div class="col-6 mt-2">
            <div class="form-floating ">
              <select class="form-select" id="id_zona" name="id_zona" aria-label="Floating label select example">
                <option selected>Seleccionar</option>
                <?php
                foreach ($ListarZonas as $zona) {
                ?>
                  <option value="<?php echo $zona['id'] ?>"><?php echo $zona['nroZona'] ?></option>
                <?php }

                ?>
              </select>
              <label for="id_zona">ZONAS</label>
            </div>
          </div>

          <div class="col-12 mt-3">
            <div class="form-floating">
              <div class="row">

                <div class="col-10 text-center">
                  <h5 class="mt-1">LISTA DE PERSONAL DEL GRUPO SELECCIONADO</h5>
                </div>

              </div>
            </div>
            <div id="tablaEquipo"></div>
          </div>

          <div class="col-1 p-0 mt-2">

           
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary">Crear</button>
      </div>
    </div>
  </div>
</div> -->