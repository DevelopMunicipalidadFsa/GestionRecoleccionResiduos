<?php
session_start();

if (!isset($_SESSION['validarIngreso'])) {

    echo '<script>window.location = "login.php";</script>';
    return;
} else {
    if ($_SESSION['validarIngreso'] != "ok") {

        echo '<script>window.location = "login.php";</script>';
        return;
    }
}
// validamos tambien si estuvo cierto tiempo en inactividad para cerrar sesion
$fechaGuardada = $_SESSION["ultimoAcceso"];
$items2 = date("j-n-Y H:i:s", time());
$date = new DateTime($items2, new DateTimeZone('America/Argentina/Buenos_Aires'));
date_default_timezone_set('America/Argentina/Buenos_Aires');
$zonahoraria = date_default_timezone_get();
$items2 = date("j-n-Y H:i:s", time());
$ahora = $items2;
$tiempo_transcurrido = (strtotime($ahora) - strtotime($fechaGuardada));

//comparamos el tiempo transcurrido
if ($tiempo_transcurrido >= 3000) {
    //si pasaron 10 minutos o más
    session_destroy(); // destruyo la sesión
    header("Location: login.php?SESSION_EXPIRED");
    // //sino, actualizo la fecha de la sesión
} else {
    $_SESSION["ultimoAcceso"] = $ahora;
    $_SESSION["ultimoAcceso"];
}
?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestión de Descargas - Municipalidad de la Ciudad de Formosa</title>
    <link rel="shortcut icon" type="image/x-icon" style="border-radius: 50% !important" href="../Librerias/img/logoMunicipalidadFsa.png" />

    <!-- FUENTE MONTSERRAT CDN -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="../Librerias/Bootstrap/css/bootstrap.min.css">
    <!-- font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/v4-shims.js" integrity="sha512-RNv6jlbGXQqj0vGGjx6DcZ9kf/mH7BAwssf9HRxWU15LTXJClKIgpHH/PAT6vNIWGFJQWy34oP6bCpBFlrR7dA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/solid.min.js" integrity="sha512-s6yNeC6faUgveCQocceGXVia7ciAebyTH7hRNazwZa2FHhnxX22qaGeb9d3a8PUKdnoHo3T3bYI/0ZOjmgWkNg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/regular.min.js" integrity="sha512-kSAGSlODsZwG7bMv/Hydyvybjk+WOz4oEqQiWYwpCxQ7/7yXMFynr2QrvNc2myZW/7wyi0IF2TXZZWMeg8AGhw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- fuente -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <!-- datatable -->
    <!-- <link rel="stylesheet" href="../Librerias/datatable/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../Librerias/datatable/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../Librerias/datatable/datatables-buttons/css/buttons.bootstrap4.min.css"> -->
    <!-- estilos personalizados -->
    <link rel="stylesheet" href="../Librerias/EstilosCSS/adminlte.min.css">
    <link rel="stylesheet" href="../Librerias/EstilosCSS/Estilo.css">
    <link rel="stylesheet" href="../Librerias/EstilosCSS/Rutas.css">
    <link rel="stylesheet" href="../Librerias/EstilosCSS/EstilosGenerales.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="../Librerias/Sweetalert2/css/sweetalert2.min.css">
    <script src="../Librerias/Sweetalert2/js/sweetalert2.min.js"></script>
    <!-- jQuery -->
    <script src="../Librerias/JQuery/jquery.min.js"></script>
    <!-- select2 -->
    <link rel="stylesheet" href="../Librerias/Select2/css/select2.min.css">


    <link rel="stylesheet" href="../Librerias/Bootstrap/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="../Librerias/EstilosCSS/Rutas.css"> -->
    <link rel="stylesheet" href="../Librerias/EstilosCSS/EstilosGenerales.css">
    <link rel="stylesheet" href="../Librerias/Sweetalert2/css/sweetalert2.min.css">
    <link rel="stylesheet" href="../Librerias/Select2/css/select2.min.css">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <!-- <link rel="stylesheet" href="../Librerias/datatable/rutaDataTable/jquery.dataTables.css"> -->



</head>

<body onunload="javascript:cerrarSession()">
    <header>
        <?php include_once('nav.php') ?>
    </header>


    <!-- INICIO NAV -->
    <section class="container-fluid">
        <div class="row">
            <div class="col-md-2 p-0">
                <?php include_once('menu.php') ?>
            </div>
            <div class="col-md-10 p-2 vistaModulos" id="Ajuste">
                <?php
                if (isset($_GET['pagina'])) {
                    // Esta seccion va a ser para todas las funcionalidades de descargas
                    if (
                        $_GET['pagina'] == "descargasListado" ||
                        $_GET['pagina'] == "descargasDetalle" ||
                        $_GET['pagina'] == "descargasAdministrar"
                    ) {
                        include_once "Vistas/Descargas/" . $_GET['pagina'] . ".php";
                    } else if (
                        $_GET['pagina'] == "cooperativaListado" ||
                        $_GET['pagina'] == "cooperativaGrupos" ||
                        $_GET['pagina'] == ""
                    ) {
                        include_once "Vistas/Cooperativas/" . $_GET['pagina'] . ".php";
                    } else if (
                        $_GET['pagina'] == "camionesListado" ||
                        $_GET['pagina'] == "camionesDetalles" ||
                        $_GET['pagina'] == ""
                    ) {
                        include_once "Vistas/camiones/" . $_GET['pagina'] . ".php";
                    } else if (
                        $_GET['pagina'] == "zonasListado" ||
                        $_GET['pagina'] == "detalleBarriosxZona" ||
                        $_GET['pagina'] == ""
                    ) {
                        include_once "Vistas/Zonas/" . $_GET['pagina'] . ".php";
                    } else {
                        include_once "Vistas/error404.php";
                    }
                } else {
                    include_once "Vistas/error404.php";
                }
                ?>
            </div>
        </div>
        <!-- FIN NAV -->
    </section>
    <main>
    </main>

    <!-- Libreria de Bootstrap-->
    <script src="../Librerias/Bootstrap/js/bootstrap.min.js"></script>

    <script src="../Librerias/jszip/jszip.min.js"></script>
    <script src="../Librerias/pdfmake/pdfmake.min.js"></script>
    <script src="../Librerias/pdfmake/vfs_fonts.js"></script>

    <script src="../Librerias/Select2/js/select2.min.js"></script>

    <script src="../Librerias/FuncionesJS/script.js"></script>
    <script src="../Librerias/FuncionesJS/RutasJS.js"></script>
    <script src="../Librerias/JQuery/jquery.min.js"></script>
    <script src="../Librerias/JQuery/jquery-3.7.1.min.js"></script>
    <script src="../Librerias/FuncionesJS/camionesJS.js"></script>
    <script src="../Librerias/FuncionesJS/descargasJsEmi.js"></script>

    <script src="../Librerias/Sweetalert2/js/sweetalert2.all.min.js"></script>
    <script src="../Librerias/Select2/js/select2.full.min.js"></script>
    <script src="../Librerias/Select2/js/select2.min.js"></script>




    <!-- <script src="../../Librerias/datatable/rutaDataTable/jquery.dataTables.js"></script> -->
    <!-- <script src="../../Librerias/datatable/rutaDataTable/es-ES.json"></script> -->
    <script src="https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>




    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
    <!-- DataTables  & Plugins -->
    <!-- <script src="../Librerias/datatable/datatables/jquery.dataTables.min.js"></script>
    <script src="../Librerias/datatable/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../Librerias/datatable/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../Librerias/datatable/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="../Librerias/datatable/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../Librerias/datatable/datatables-buttons/js/buttons.bootstrap4.min.js"></script> -->
    <!-- <script src="../Librerias/datatable/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="../Librerias/datatable/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="../Librerias/datatable/datatables-buttons/js/buttons.colVis.min.js"></script> -->
    <!-- Select2 -->
    <!-- Scripts personalizados -->
    <!-- <script src="../Librerias/FuncionesJS/descargasJsEmi.js"></script> -->

</body>

</html>