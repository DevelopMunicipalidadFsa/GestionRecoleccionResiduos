<?php
require_once '../../Controladores/ControladorViaje.php';
require_once '../../Modelos/ModeloViaje.php';

$idGrupo = $_POST['idGrupo'];


$datosEquipo = ControladoresViajes::CtrlPersonasGrupo($idGrupo);

// $choferesCamiones = array();
// foreach ($datosEquipo as $chofer) {
//     $choferesCamiones[] = array(
//         "id" => $chofer['id'],
//         "apellidosNombres" => $chofer['apellidosNombres'],
//         "dni" => $chofer['dni'],
//         "fechaNacimiento" => $chofer['fechaNacimiento'],
//     );
// } 
?>

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

<table class="table table-bordered table-striped">
    <thead>
        <th class=" text-center">Nombre y Apellido</th>
        <th class="text-center">Dni</th>
        <th class="text-center">Asistencia</th>
    </thead>


    <?php foreach ($datosEquipo as $equipo) { ?>
        <tbody>
            <td><?php echo $equipo['apellidosNombres']; ?></td>
            <td class="text-center"><?php echo $equipo['dni'] . "-" . $equipo['id']; ?></td>
            <td class="text-center"><input type="checkbox" id="CheckEquipo" name="asistenciaEquipo[]" form="AltaServicio" value="<?php echo $equipo['id'] ?>"></td>
        </tbody>
    <?php } ?>

</table>

<!-- echo json_encode($datosEquipo); -->