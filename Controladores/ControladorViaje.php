<?php
// require_once 'Modelos/ModelosCamiones.php';
// error_reporting(0);
class ControladoresViajes
{
    /*=============================================
	  LISTA COOPERATIVAS	
	 =============================================*/
    public function CtrlCooperativas()
    {
        $rta = ModelosViajes::MdlBuscarCooperativas();

        return $rta;
    }

    public function CtrlValidaCooperativas($idCooperativa)
    {
        $rta = ModelosViajes::MdlValidaCooperativas($idCooperativa);

        return $rta;
    }

    /*=============================================
	  LISTA COOPERATIVAS	
	 =============================================*/
    public function CtrlGruposCooperativa($idCooperativa)
    {
        $rta = ModelosViajes::MdlGruposCooperativa($idCooperativa);

        return $rta;
    }


    /*=============================================
	  LISTA COOPERATIVAS	
	 =============================================*/
    public function CtrlPersonasGrupo($idGrupo)
    {
        $rta = ModelosViajes::MdlPersonasGrupo($idGrupo);

        return $rta;
    }

    public function CtrlListarZonas()
    {
        $rta = ModelosViajes::MdlListarZonas();

        return $rta;
    }

    public function CtrlListarTiposServicios()
    {
        $rta = ModelosViajes::MdlListarTiposServicios();

        return $rta;
    }

    static public function CtrlListarCamionesViaje()
    {

        $respuesta = ModelosViajes::MdlListarCamionesViaje();
        return $respuesta;
    }

    static public function CtrlValidaCamionServicio($id_camion, $fecha)
    {

        $respuesta = ModelosViajes::MdlValidaCamionServicio($id_camion, $fecha);
        return $respuesta;
    }

    static public function CtrlValidaCooperativaServicio($idCooperativa, $fecha)
    {

        $respuesta = ModelosViajes::MdlValidaCooperativaServicio($idCooperativa, $fecha);
        return $respuesta;
    }

    static public function CtrlListarServicios()
    {

        $respuesta = ModelosViajes::MdlListarServicios();
        return $respuesta;
    }



    public function AltaServicio()
    {
        if (isset($_POST['confirmaAltaServicio'])) {
            // echo "alta Servicio";

            $fechaActual = date('d-m-Y');

            if (isset($_POST['id_camion_select'])) {
                $id_camion = $_POST['id_camion_select'];
            } else {
                $id_camion = $_POST['id_camion'];
            }

            $id_chofer = $_POST['choferCamion'];
            $idTurno = $_POST['idTurno'];
            $id_zona = $_POST['id_zona'];
            $idGrupoCooperativa = $_POST['id_grupo'];
            $id_tipo_servicio = $_POST['id_tipo_servicio'];
            $id_cooperativa = $_POST['id_cooperativa'];

            // VARIABLES DETALLE

            $usuario = $_SESSION['codusu1'];
            $extraerGrupo = ModelosViajes::MdlPersonasGrupo($idGrupoCooperativa);


            for ($i = 0; $i < count($extraerGrupo); $i++) {
                $personal = $extraerGrupo[$i][0];

                $spa_asistencia = ModelosViajes::SPA_Asistencia($personal, 0, NULL, $usuario);
            }


            for ($j = 0; $j < count($_POST["asistenciaEquipo"]); $j++) {
                $presente = $_POST["asistenciaEquipo"][$j];

                $actualizaAsis = ModelosViajes::SPA_AsistenciaActiva($presente);
            }





            // $spa_asistencia = ModelosViajes::SPA_Asistencia($ausentes, 0, NULL, $usuario);
            $SPA_Servicio = ModelosViajes::SPA_Servicio($id_camion, $id_chofer, $idTurno, $id_zona, $id_tipo_servicio, $id_cooperativa, $idGrupoCooperativa, $usuario);
            if ($SPA_Servicio == "SUCCESS") {
                echo "<script>	
                        jQuery(function(){
                            Swal.fire({
                                icon: 'success',
                                //title: '¡Muy bien!',
                                text: 'Servicio Creado Correctamente',
                                showConfirmButton: true,
                                }).then((result) => {
                                    //document.camionesDetalles.submit();
                                    location.href = 'descargasListado';
                            })
                        });
                    </script>";
            } else {
                echo "<script>	
                        jQuery(function(){
                            Swal.fire({
                                icon: 'error',
                                title: '¡Error al crear el servicio!',
                                text: 'No se pudo procesar (ER001), consulte con el administrador',
                                showConfirmButton: true
                                }).then((result) => {
                                    location.href = 'descargasListado';
                                    //document.camionesDetalles.submit();
                            })
                        });
                </script>";
            }
        }
    }
}
