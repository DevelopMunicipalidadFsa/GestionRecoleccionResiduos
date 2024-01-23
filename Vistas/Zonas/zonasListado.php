<!-- <script src="../Librerias/JQuery/jquery-3.7.1.min.js"></script> -->
<!-- <script src="../../../Librerias/JQuery/jquery-3.7.1.min.js"></script> -->
<div class="container-fluid">
  <!-- Nav tabs -->
  <ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link active fw-bold" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true" style="font-size: 14px;">
        LISTADO DE ZONAS
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


  <div class="tab-content">
    <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
      <div class="text-end mb-2 mt-2">
        <button type="button" class="btn btn-primary shadow align-self-lg-end mb-2 px-4 py-3 fw-bold" data-bs-toggle="modal" data-bs-target="#staticBackdrop" style="font-size: 14px;">
          Agregar Zona
          <i class="fa-solid fa-users"></i>
        </button>
      </div>
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Listado de Zonas</h3>
        </div>
        <div class="card-body">
          <table id="tablaBarriosPorZonas" class="table table-bordered table-striped">
            <thead>
              <tr class="text-center">
                <th class="text-center">Número</th>
                <th class="text-center">Sector/Zona</th>
                <th>Acción</th>
              </tr>
            </thead>
            <tbody class="text-center">
            </tbody>
          </table>
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


  <h5 class="text-left">LISTADO DE ZONAS</h5>

</div>

<script src="../Librerias/FuncionesJS/scriptZonas.js"></script>
<!-- Modal Alta de Zonas-->
<?php include_once('zonasModales.php'); ?>
<?php include_once('barriosPorZona.php'); ?>
<?php include_once('editarZonasPorBarrio.php'); ?>