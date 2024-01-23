<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingresar - Municipalidad de la Ciudad de Formosa</title>
    <link rel="shortcut icon" type="image/x-icon" style="border-radius: 50% !important" href="../Librerias/img/logoMunicipalidadFsa.png" />
    <link rel="stylesheet" href="../Librerias/Bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Librerias/FontAwesome/css/fontawesome_v6.4.2_css_all.css">
    <link rel="stylesheet" href="../Librerias/EstilosCSS/EstiloLogin.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
</head>

<body>


    <form action="login.php" method="get" id="login"></form>
    <div class="LogoMuni p-2">
        <h4 class="text-white">
            <img src="../Librerias/img/original.png" width="55px" height="60px"> <span class="fw-bold">Municipalidad de Formosa</span>
            | <span class="boldNo">Gestión Ambiental</span>
        </h4>
    </div>
    <div class="login-dark">
        <form method="post" action="validarLogin.php">
            <center>
                <img class="logoLogin" src="../Librerias/img/logoMunicipalidadFsa.png">
            </center>
            <h4 class="h4 text-center mt-0 text-dark">Iniciar sesión</h4>

            <input class="form-control mb-2" type="number" id="username" autocomplete="off" name="username" placeholder="Usuario" required>
            <div class="text-center" id="resultadoUsuario"></div>
            <div class="d-flex justify-content-center mt-2 mb-3" id="result-username"></div>
            <input class="form-control mb-2" type="password" name="clave" placeholder="Contraseña" required>
            <button class="btn btn-primary btn-block w-100 m-0 mb-2" type="submit"> Ingresar</button>
            <?php
            if (isset($_GET['err_user'])) { ?>
                <div class="toast show mt-2 err_user px-1 py-1" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header py-1">
                        <strong class="me-auto">Error de Logueo</strong>
                        <button form="login" type="submit" class="btn-close" data-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body py-1">
                        <span class="mensaje_err_user">El usuario o contraseña ingresados son incorrectos</span>
                    </div>
                </div>
            <?php }
            if (isset($_GET["SESSION_EXPIRED"])) { ?>
                <div class="toast show col-2 err_user px-1 py-1 text-danger" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header py-1 text-center">
                        <strong class="me-auto text-danger text-center">La sesión expiro</strong>
                        <button form="login" type="submit" class="btn-close" data-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body py-1">
                        <span class="mensaje_err_user">Vuelva a Ingresar</span>
                    </div>
                </div>
            <?php } ?>
            <img src='../Librerias/img/tuciudaddigitalciudad5.png' width='100%' height='95' style="image-rendering: pixelated;" />
        </form>
        <?php
        if (isset($_GET['SESSION_EXPIRED'])) {
            echo "<script>  
                                jQuery(function(){
                                    Swal.fire({
                                    icon: 'error',
                                    title: 'Su sesión expiró',
                                    text: 'Ha superado el tiempo de inactividad en el sitio',
                                    showConfirmButton: true, 
                                    confirmButtonText: 'Ok'
                                    }).then((result) => {
                                    /* Read more about isConfirmed, isDenied below */
                                        if (result.isConfirmed) {
                                            if(window.history.replaceState){
                                                window.history.replaceState(null, null, window.location.href );
                                            }
                                            window.location = 'login.php';
                                        }
                                    })
                                });
                            </script>";
        }
        ?>
    </div>
    <script rel="stylesheet" src="../Librerias/JQuery/jquery-3.7.1.min.js"></script>
    <script rel="stylesheet" src="../Librerias/FuncionesJS/scriptLogin.js"></script>

</body>

</html>