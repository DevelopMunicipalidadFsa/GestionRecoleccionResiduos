
<h1 class="text-center">LISTADO DE COOPERATIVAS</h1>
<div class="text-end mb-2">
  <!-- Button modal -->
  <button type="button" class="btn btn-outline-primary align-self-lg-end" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
    Agregar Cooperativa
    <i class="fa-solid fa-users"></i>
  </button>
  <!-- /.Button modal -->
</div>
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Litado de cooperativas.</h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <!-- tabla de descargas -->
    <table id="example1" class="table table-bordered table-striped">
      <thead>
        <tr class="text-center">
          <th>Razon Social</th>
          <th>Detalle</th>
          <th>CUIT - CUIL</th>
          <th>Teléfono</th>
          <th>Responsable</th>
          <th>DNI</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="text-center">125</td>
          <td class="text-center"><button type="button" class="btn btn-outline-primary" title="Detalle"><i class="fa-solid fa-list"></i></button></td>
          <td>99-54564121-0</td>
          <td>3704034567</td>
          <td>MARTINEZ ANDRES</td>
          <td>40235687</td>
        </tr>
        <tr>
          <td class="text-center">126</td>
          <td class="text-center"><button type="button" class="btn btn-outline-primary" title="Detalle"><i class="fa-solid fa-list"></i></button></td>
          <td>75-12354788-1</td>
          <td>3704124568</td>
          <td>PEREZ JUAN</td>
          <td>25897654</td>          
        </tr>
        <tr>
          <td class="text-center">127</td>
          <td class="text-center"><button type="button" class="btn btn-outline-primary" title="Detalle"><i class="fa-solid fa-list"></i></button></td>
          <td>20-38577190-9</td>
          <td>3704897521</td>
          <td>PALACIOS MAURO</td>
          <td>115487963</td>
        </tr>
      </tbody>
    </table>
    <!-- /.tabla de descargas -->
  </div>
  <!-- /.card-body -->
</div>
<script src="../Librerias/FuncionesJS/scriptCooperativas.js"></script>
<!-- Modal Alta de Descarga-->
<?php include_once('cooperativaModales.php') ?>