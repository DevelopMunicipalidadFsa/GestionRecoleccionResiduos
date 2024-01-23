<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<link rel="shortcut icon" type="image/x-icon" style="border-radius: 50% !important" href="../Librerias/img/logoMunicipalidadFsa.png" />
<title>Tu Ciudad Digital - Sistema de Gestion Ambiental</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
<link rel="stylesheet" href="../Librerias/Sweetalert2/css/sweetalert2.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css">
<link href="https://kit-pro.fontawesome.com/releases/v5.15.4/css/pro.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="../Librerias/Sweetalert2/js/sweetalert2.all.min.js" type="text/javascript"></script>
<?php

require_once 'Controladores/ControladorGestor.php';
require_once 'Modelos/ModeloGestor.php';
//Se abre el código php para lo que es el inicio de la sesión
//Se reanuda la sesion que se abrió en ValidaLogin.php

if (isset($_POST['username']) && isset($_POST['clave'])) {


	$usu = $_POST['username'];
	$pass = $_POST['clave'];

	$logueoRta = ControladorGestor::CtrIngresoUsu($usu, "$pass");
	if ($logueoRta['rta'] == 'OK') {
		$respuesta = ControladorGestor::CtrDatosUsu($usu);
		print_r($respuesta);
		if (isset($respuesta[0]["codusu"])) {
			// Si los datos coinciden, se crea una sesión para el usuario
			// Comienza la sesión
			session_start();

			//defino la sesión que demuestra que el usuario está autorizado
			// Llamamos al modelo que trae fecha y hora del servidor
			$items2 = date("j-n-Y H:i:s",time());
			$date = new DateTime($items2, new DateTimeZone('America/Argentina/Buenos_Aires'));
			date_default_timezone_set('America/Argentina/Buenos_Aires');
			$zonahoraria = date_default_timezone_get();
			$items2=date("j-n-Y H:i:s",time());

			$_SESSION["ultimoAcceso"]= $items2;
			//defino la fecha y hora de inicio de sesión en formato aaaa-mm-dd hh:mm:ss
			$_SESSION['nombre1'] = $respuesta[0]["nombre"];
			$_SESSION['codusu1'] = $respuesta[0]["codusu"];
			$_SESSION['Dependencia1'] = $respuesta[0]["Dependencia"];
			$_SESSION['Detalle1'] = $respuesta[0]["Detalle"];

			//niveles de usuarios:  1-ADMINISTRADOR || 2-SUPERVISOR || 3-OPERADOR
			$_SESSION['nivel'] = $respuesta[0]["nivel"];
			$_SESSION['validarIngreso'] = "ok";
			//Redirecciona a la página principal
			header("Location:./descargasListado");
		} else {
			echo "<script>	
								jQuery(function(){
									Swal.fire({
										icon: 'error',
										title: '¡Error!',
										text: 'Verificar datos ingresados',
										showConfirmButton: true,
          								allowOutsideClick: false, 
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
		} // end if($respuesta[0]["Cuit"] == true) ELSE
	} else {
		echo "<script>	
							jQuery(function(){
								Swal.fire({
									icon: 'error',
									title: '¡Error!',
									text: '" . $logueoRta['rta'] . "',
									showConfirmButton: true,
          							allowOutsideClick: false, 									
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
	} //$logueoRta['rta']=='OK'

} else {
	echo "<script>	
			jQuery(function(){
				Swal.fire({
					icon: 'error',
					title: '¡Error!',
					text: 'Debe Mandar un parametro válido',
					showConfirmButton: true,
					allowOutsideClick: false, 
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
} //end if(isset($json->message))
