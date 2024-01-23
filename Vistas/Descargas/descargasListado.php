<?php
require_once 'Controladores/ControladorViaje.php';
require_once 'Modelos/ModeloViaje.php';


$AltaServicio = ControladoresViajes::AltaServicio();
print_r($AltaServicio);

$ListaServicio = ControladoresViajes::CtrlListarServicios();
?>

<div class="container-fluid">
  <!-- Nav tabs -->
  <ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link active fw-bold" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true" style="font-size: 14px;">
        LISTADO DE DESCARGAS
      </button>
    </li>
    <!-- <li class="nav-item" role="presentation">
      <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">
        Profile
      </button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="messages-tab" data-bs-toggle="tab" data-bs-target="#messages" type="button" role="tab" aria-controls="messages" aria-selected="false">
        Messages
      </button>
    </li> -->
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
      <div class="tab-content">
        <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
          <div class="text-end mb-2 mt-2">
            <button type="button" class="btn btn-primary px-4 py-3 align-self-lg-end fw-bold" data-bs-toggle="modal" data-bs-target="#nuevoServicio" style="font-size: 14px;">
              Agregar Descarga
              <i class="fa-sharp fa-solid fa-truck-field"></i>
            </button>
          </div>
          <div class="card">
            <div class="card-header">
              <h3 class="card-title fw-bold m-0">DESCARGAS ACTIVAS ACTUALMENTE</h3>
            </div>
            <div class="card-body">
              <table id="ListaDescarga" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th style="font-size: 13px;">Interno</th>
                    <th style="font-size: 13px;">Administrar</th>
                    <th style="font-size: 13px;">Dominio</th>
                    <th style="font-size: 13px;">Chofer</th>
                    <th style="font-size: 13px;">Zona/Sector</th>
                    <th style="font-size: 13px;">Turno</th>
                    <th style="font-size: 13px;">Estado</th>
                    <th style="font-size: 13px;">Ing SP</th>
                    <th style="font-size: 13px;">Egr SP</th>
                    <th style="font-size: 13px;">Ing VM</th>
                    <th style="font-size: 13px;">Egr VM</th>
                    <th style="font-size: 13px;">Cooperativa</th>
                    <th style="font-size: 13px;">Grupo</th>
                    <th style="font-size: 13px;">Fecha</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($ListaServicio as $servicio) {


                    $fechaAlta = date('d-m-Y', strtotime($servicio['fecha']));

                    if ($servicio['ingresoSP'] != NULL) {
                      $ingresoSP = date('H:i', strtotime($servicio['ingresoSP']));
                    } else {
                      $ingresoSP = "--:--";
                    }

                    if ($servicio['egresoSP'] != NULL) {
                      $egresoSP = date('H:i', strtotime($servicio['egresoSP']));
                    } else {
                      $egresoSP = "--:--";
                    }

                    if ($servicio['ingresoVM'] != NULL) {
                      $ingresoVM = date('H:i', strtotime($servicio['ingresoVM']));
                    } else {
                      $ingresoVM = "--:--";
                    }

                    if ($servicio['egresoVM'] != NULL) {
                      $egresoVM = date('H:i', strtotime($servicio['egresoVM']));
                    } else {
                      $egresoVM = "--:--";
                    }



                  ?>
                    <tr>
                      <td class="fw-bold" style="font-size: 12px;"><?php echo $servicio['interno'] ?></td>
                      <td class="fw-bold text-center" style="font-size: 12px;">
                        <a href="descargasDetalle" class="btnDetalleServicio"><i class="fa-solid fa-gear"></i></a>
                        <!-- <button type="button" class="btnDetalleServicio" title="Administrar"><i class="fa-solid fa-gear"></i></button> -->
                      </td>
                      <td class="fw-bold" style="font-size: 12px;"><?php echo $servicio['dominio'] ?></td>
                      <td class="fw-bold" style="font-size: 12px;"><?php echo $servicio['apellidosNombres'] ?></td>
                      <td class="fw-bold" style="font-size: 12px;"><?php echo $servicio['descripcion'] . " " . $servicio['nroZona'] ?></td>
                      <td class="fw-bold" style="font-size: 12px;"><?php echo $servicio['turno'] ?></td>
                      <td class="fw-bold text-center" style="font-size: 12px;"><span class="badge text-bg-secondary"><?php echo $servicio['detalle'] ?></span></td>
                      <td class="fw-bold" style="font-size: 12px;"><i class="fa-regular fa-clock"></i> <?php echo $ingresoSP ?></td>
                      <td class="fw-bold" style="font-size: 12px;"><i class="fa-regular fa-clock"></i> <?php echo $egresoSP ?></td>
                      <td class="fw-bold" style="font-size: 12px;"><i class="fa-regular fa-clock"></i> <?php echo $ingresoVM ?></td>
                      <td class="fw-bold" style="font-size: 12px;"><i class="fa-regular fa-clock"></i> <?php echo $egresoVM ?></td>
                      <td class="fw-bold" style="font-size: 12px;"><?php echo $servicio['razonSocial'] ?></td>
                      <td class="fw-bold" style="font-size: 12px;"><?php echo "GRUPO " . $servicio['grupo'] ?></td>
                      <td class="fw-bold" style="font-size: 12px;"><?php echo $fechaAlta ?></td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <!-- <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        profile
      </div>
      <div class="tab-pane" id="messages" role="tabpanel" aria-labelledby="messages-tab">
        messages
      </div> -->
    </div>

  </div>

  <!-- Modal Alta de Descarga-->
  <?php include_once('descargasModales.php') ?>