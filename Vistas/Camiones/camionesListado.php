<script src="../Librerias/JQuery/jquery-3.7.1.min.js"></script>
<?php
require_once 'Controladores/ControladorCamiones.php';
require_once 'Modelos/ModelosCamiones.php';

$a_camion = ControladorCamiones::A_Camiones();
print_r($a_camion);


$b_camion = ControladorCamiones::CtrlBajaCamion();
print_r($b_camion);

$a_chofer = ControladorCamiones::A_Choferes();
print_r($a_chofer);


$ListarCamiones = ControladorCamiones::CtrlListarCamiones();
// print_r($ListarCamiones);
$ListarCamionesInactivos = ControladorCamiones::CtrlListarCamionesInactivos();
// print_r($ListarCamiones);

?>

<div class="container-fluid">
    <!-- <h5 class="text-left fw-bold" style="font-size: 14px;">LISTADO DE CAMIONES</h5> -->
    <ul class="nav nav-tabs">
        <li class="nav-item" role="presentation">
            <button class="nav-link active fw-bold" id="detTitular-tab" data-bs-toggle="tab" data-bs-target="#detActivos" type="button" role="tab" aria-controls="detActivos" aria-selected="false" style="font-size: 14px;">LISTADO DE CAMIONES</button>
        </li>
        <!-- <li class="nav-item" role="presentation">
            <button class="nav-link" id="detInactivos-tab" data-bs-toggle="tab" data-bs-target="#detInactivos" type="button" role="tab" aria-controls="detInactivos" aria-selected="false">Camiones Inactivos</button>
        </li> -->
    </ul>

    <div class="tab-content">
        <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div class="text-end mb-2 mt-3">
                <button type="button" class="btn btn-primary shadow align-self-lg-end mb-2 px-4 py-3 fw-bold" data-bs-toggle="modal" data-bs-target="#nuevo_camion" style="font-size: 14px;">
                    Registrar Camion
                    <i class="fa-sharp fa-solid fa-truck-field"></i>
                </button>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title fw-bold m-0">CAMIONES INGRESADOS</h3>
                </div>
                <div class="card-body">
                    <table id="CamionesActivosList" class="table table-bordered table-striped mt-3">
                        <thead>
                            <tr>
                                <th class="text-center fw-bold" style="width: 4%;">Interno</th>
                                <th class="text-center fw-bold">Propietario</th>
                                <th class="text-center fw-bold">Acción</th>
                                <th class="text-center fw-bold">Dominio</th>
                                <th class="text-center fw-bold">Tipo Unidad</th>
                                <th class="text-center fw-bold">Estado</th>
                                <!-- <th class="text-center fw-bold">Encargados</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($ListarCamiones as $camiones) {


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
                                $idEstado = $camiones['idEstado'];


                            ?>

                                <tr>
                                    <?php if ($idEstado == 7) { ?>
                                        <td class="text-center fw-bold"><?php echo $interno ?></td>
                                    <?php } elseif ($idEstado == 12) { ?>
                                        <td class=" text-center fw-bold"><?php echo $interno ?></td>
                                    <?php } else { ?>
                                        <td class="text-center fw-bold"><?php echo $interno ?></td>
                                    <?php } ?>
                                    <td><?php echo $apellidosNombres ?></td>
                                    <td class="text-center">
                                        <form action="camionesDetalles" method="POST" id="camionesDetalles<?php echo $idCamion ?>">
                                            <input type="hidden" name="idCamion" value="<?php echo $camiones['idCamion']; ?>">
                                        </form>

                                        <!-- <a href="camionesDetalles?idCamion=<?php echo $camiones['idCamion']; ?>">camioncito</a> -->


                                        <button type="submit" class="btn btn-sm btn-outline-primary " title="Detalle del Camion" form="camionesDetalles<?php echo $idCamion ?>"><i class="far fa-list-alt"></i></button>
                                        <button type="button" class="btn btn-sm btn-outline-danger btn_baja_camion" title="Borrar Camion" id="#btn_baja_camion" data-bs-toggle="modal" data-bs-target="#ModalB_Camion" baja-idCamion="<?php echo $idCamion ?>" baja-dominio="<?php echo $dominio ?>"><i class="fas fa-trash"></i></button>

                                        <!-- <button type="button" class="btn btn-sm btn-outline-primary btn_adm_choferes" title="Agregar Chofer" id="#btn_adm_choferes" data-bs-toggle="modal" data-bs-target="#ModalA_Chofer" data-interno="<?php echo $interno ?>" data-idCamion="<?php echo $idCamion ?>" data-dominio="<?php echo $dominio ?>"><i class="fas fa-user-plus"></i> Registrar nuevo chofer</button> -->
                                    </td>
                                    <td class="text-center"><?php echo $dominio ?></td>
                                    <td class="text-center"><?php echo $tipo_servicio ?></td>
                                    <td class="text-center"><?php echo $desc_estado ?></td>
                                    <!-- <td class="text-center"><button type="button" class="btn btn-outline-primary btn-sm" title="Ver Encargados" id="#" data-bs-toggle="modal" data-bs-target="#">Ver choferes/Encargados</button></td> -->

                                </tr>
                            <?php } ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>



    </div>





    <?php include_once('camionesModales.php') ?>