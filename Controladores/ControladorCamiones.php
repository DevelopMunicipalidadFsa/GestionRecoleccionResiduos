<?php
// require_once 'Modelos/ModelosCamiones.php';
// error_reporting(0);
class ControladorCamiones
{

    /*=============================================
	  FILTRO DE BUSQUEDA DE DOMINIO  	
	 =============================================*/
    public function CtrlBuscarDominio($dominio)
    {
        $rta = ModelosCamiones::mdlBuscarDominio($dominio);

        return $rta;
    }

    /*=============================================
	  FILTRO DE BUSQUEDA DE PERSONA/PROPIETARIO  	
	 =============================================*/
    public function ctrlFiltraPersonaContribuyente($dni)
    {
        $rta = ModelosCamiones::mdlFiltraPersonaContribuyente($dni);

        return $rta;
    }

    /*=============================================
	  FILTRA SI EXISTE LA PERSONAS EN PERSONASTIPOSPERSONA PERSONA INGRESADO EN LA BD GESTION AMBIENTAL  	 	
	 =============================================*/
    static public function CtrlValidaTipoPersona($dni, $idTipoPersona)
    {

        $respuesta = ModelosCamiones::MdlValidaTipoPersona($dni, $idTipoPersona);
        return $respuesta;
    }


    /*=============================================
	  LISTA NACIONALIDADES	
	 =============================================*/
    public function CtrlNacionalidades()
    {
        $rta = ModelosCamiones::MdlBuscarNacionalidades();

        return $rta;
    }

    /*=============================================
	  BUSQUEDA DE DOMICILIO DE CONTRIBUYENTE 	
	 =============================================*/
    public function CtrlBuscaDomicilioContribuyente($id_contribuyente)
    {
        $rta = ModelosCamiones::MdlBuscaDomicilioContribuyente($id_contribuyente);

        return $rta;
    }

    /*=============================================
	  LISTA BARRIOS	
	 =============================================*/
    static public function CtrlBuscarBarrios()
    {

        $respuesta = ModelosCamiones::MdlBuscarBarrios();
        return $respuesta;
    }
    /*=============================================
	  LISTA CALLES  	
	 =============================================*/
    static public function ctrBuscarCalles()
    {

        $respuesta = ModelosCamiones::mdlBuscarCalles();
        return $respuesta;
    }

    /*=============================================
	  LISTA LOS CAMIONES REGISTRADOS 	
	 =============================================*/
    static public function CtrlListarCamiones()
    {

        $respuesta = ModelosCamiones::MdlListarCamiones();
        return $respuesta;
    }

    /*=============================================
	  LISTA LOS CAMIONES CON ESTADO INACTIVO
	 =============================================*/
    static public function CtrlListarCamionesInactivos()
    {

        $respuesta = ModelosCamiones::MdlListarCamionesInactivos();
        return $respuesta;
    }


    /*=============================================
	  LISTA TODA LA INFORMACION DEL CAMION FILTRADO 	
	 =============================================*/
    static public function CtrlCamionesDetalles($id_camion)
    {

        $respuesta = ModelosCamiones::MdlCamionesDetalles($id_camion);
        return $respuesta;
    }

    /*=============================================
	  VALIDA SI EL NUMERO DE INTERNO YA ESTA INGRESADO  	
	 =============================================*/
    static public function CtrlValidaInterno($interno)
    {

        $respuesta = ModelosCamiones::MdlValidaInterno($interno);
        return $respuesta;
    }

    /*=============================================
	  FILTRA EL DOMICILIO DE LA PERSONA INGRESADO EN LA BD GESTION AMBIENTAL  	
	 =============================================*/
    static public function CtrlDomicilioPersona($id_persona)
    {

        $respuesta = ModelosCamiones::MdlDomicilioPersona($id_persona);
        return $respuesta;
    }

    /*=============================================
	  FILTRA EL CONTACTO DE LA PERSONA INGRESADO EN LA BD GESTION AMBIENTAL  	 	
	 =============================================*/
    public function CtrlContactosPersona($id_persona)
    {

        $respuesta = ModelosCamiones::MdlContactosPersona($id_persona);
        return $respuesta;
    }

    /*=============================================
	  FILTRA EL LISTADO DE CHOFERES INGRESADO DE UN CAMION  	 	
	 =============================================*/
    static public function CtrlListaChoferesCamion($id_camion)
    {

        $respuesta = ModelosCamiones::MdlListarChoferesCamion($id_camion);
        return $respuesta;
    }

    /*=============================================
	  FILTRO DE BUSQUEDA DE PERSONA/PROPIETARIO  	
	 =============================================*/
    public function CtrlValidaPersona($dni)
    {
        $rta = ModelosCamiones::MdlValidaPersona($dni);

        return $rta;
    }

    /*=============================================
	  FILTRA EL CONTACTO DE LA PERSONA INGRESADO EN LA BD GESTION AMBIENTAL  	 	
	 =============================================*/
    static public function CtrlConsultaExistenciaPersona($dni, $idTipoPersona)
    {

        $respuesta = ModelosCamiones::MdlConsultaExistenciaPersona($dni, $idTipoPersona);
        return $respuesta;
    }

    /*=============================================
	  VALIDACION PARA SABER SI UN CHOFER YA ESTA ASIGNADO A UN CAMION  	 	
	 =============================================*/
    static public function CtrlConsultaExistenciaChoferxCamion($id_persona, $idCamion)
    {

        $respuesta = ModelosCamiones::MdlConsultaExistenciaChoferxCamion($id_persona, $idCamion);
        return $respuesta;
    }

    static public function CtrlDatosPersona($dni)
    {

        $respuesta = ModelosCamiones::MdlDatosPersona($dni);
        return $respuesta;
    }

    /*=============================================
	  PROCEDIMIENTO PARA MODIFICAR DATOS DE UNA PERSONA 	 	
	 =============================================*/
    static public function CtrlMpersona()
    {
        if (isset($_POST['modificaPersona'])) {
            $apellidosNombres = $_POST['apellidosNombres'];
            $dni = $_POST['dni'];
            $fechaNacimiento = $_POST['fechaNacimiento'];
            $Nacionalidad = $_POST['Nacionalidad'];
            $obs = $_POST['obs'];
            $idPersona = $_POST['idPersona'];
            $idCamion = $_POST['idCamion'];

            $Mpersona = ModelosCamiones::MdlMpersona($apellidosNombres, $dni, $fechaNacimiento, $Nacionalidad, $obs, $idPersona);

            echo '<form action="camionesDetalles" method="post" name="camionesDetalles" id="camionesDetalles">
                <input type="hidden" name="idCamion" value="' . $idCamion, '">
            </form>';

            if ($Mpersona == true) {
                echo "<script>	
               
                jQuery(function(){
                    Swal.fire({
                        icon: 'success',
                        title: '¡Muy bien!',
                        text: 'Registro Modificado',
                        showConfirmButton: true,
                        }).then((result) => {
                            document.camionesDetalles.submit();
                            // location.href = 'camionesListado';
                    })
                });
           
            </script>";
            } else {
                echo "<script>	
                    jQuery(function(){
                        Swal.fire({
                            icon: 'error',
                            title: '¡Algo no anda bien!',
                            text: 'No se pudo procesar (ER009), consulte con el administrador',
                            showConfirmButton: true
                            }).then((result) => {
                                // location.href = 'camionesListado';
                                document.camionesDetalles.submit();
                        })
                    });
            </script>";
            }
        }
    }


    /*=============================================
	  PROCEDIMIENTOS PARA MODIFICAR DATOS DE UN CAMION 	 	
	 =============================================*/
    static public function CtrlMcamion()
    {
        if (isset($_POST['modificaCamion'])) {
            // echo "<br>";
            // echo $dominio = $_POST['dominio'];
            // echo "<br>";
            // echo $modelo = $_POST['modelo'];
            // echo "<br>";
            // echo $marca = $_POST['marca'];
            $idCamion = $_POST['idCamion'];
            "<br>";
            $chasis = $_POST['chasis'];
            "<br>";
            $tipo_servicio = $_POST['tipo_servicio'];
            "<br>";
            $interno = $_POST['interno'];
            "<br>";
            $seguro = $_POST['seguro'];
            "<br>";
            $vencimiento_seguro = $_POST['vencimiento_seguro'];
            "<br>";
            $descripcion_cam = $_POST['descripcion_cam'];
            "<br>";


            $modiCamion = ModelosCamiones::MdlMcamion($idCamion, $chasis, $tipo_servicio, $interno, $seguro, $vencimiento_seguro, $descripcion_cam);

            echo '<form action="camionesDetalles" method="post" name="camionesDetalles" id="camionesDetalles">
                <input type="hidden" name="idCamion" value="' . $idCamion . '">
            </form>';

            if ($modiCamion == true) {
                echo "<script>	
               
            jQuery(function(){
                Swal.fire({
                    icon: 'success',
                    title: '¡Muy bien!',
                    text: 'Registro Modificado',
                    showConfirmButton: true,
                    }).then((result) => {
                        document.camionesDetalles.submit();
                        // location.href = 'camionesListado';
                })
            });
       
        </script>";
            } else {
                echo "<script>	
                jQuery(function(){
                    Swal.fire({
                        icon: 'error',
                        title: '¡Algo no anda bien!',
                        text: 'No se pudo procesar (ER010), consulte con el administrador',
                        showConfirmButton: true
                        }).then((result) => {
                            // location.href = 'camionesListado';
                            document.camionesDetalles.submit();
                    })
                });
        </script>";
            }
        }
    }

    /*=============================================
	  PROCEDIMIENTO PARA MODIFICAR DATOS DE CONTACTO DE UNA PERSONA  	 	
	 =============================================*/
    static public function CtrlMcontacto()
    {
        if (isset($_POST['modificaContacto'])) {
            $celular1 = $_POST['celular1'];
            $celular2 = $_POST['celular2'];
            $mail = $_POST['mail'];
            $idContacto = $_POST['idContacto'];
            $idCamion = $_POST['idCamion'];

            $Mcontacto = ModelosCamiones::MdlMcontacto($celular1, $celular2, $mail, $idContacto);

            echo '<form action="camionesDetalles" method="post" name="camionesDetalles" id="camionesDetalles">
                <input type="hidden" name="idCamion" value="' . $idCamion . '">
            </form>';

            if ($Mcontacto == true) {
                echo "<script>	
               
            jQuery(function(){
                Swal.fire({
                    icon: 'success',
                    title: '¡Muy bien!',
                    text: 'Registro Modificado',
                    showConfirmButton: true,
                    }).then((result) => {
                        document.camionesDetalles.submit();
                        // location.href = 'camionesListado';
                })
            });
       
        </script>";
            } else {
                echo "<script>	
                jQuery(function(){
                    Swal.fire({
                        icon: 'error',
                        title: '¡Algo no anda bien!',
                        text: 'No se pudo procesar (ER008), consulte con el administrador',
                        showConfirmButton: true
                        }).then((result) => {
                            // location.href = 'camionesListado';
                            document.camionesDetalles.submit();
                    })
                });
        </script>";
            }
        }
    }

    /*=============================================
	  PROCEDIMIENTO PARA MODIFICAR DATOS DE DOMICILIO DE UNA PERSONA  	 	
	 =============================================*/
    static public function CtrlMdomicilio()
    {
        if (isset($_POST['modificaDomicilio'])) {
            $idBarrio = $_POST['idBarrio'];
            $idCalle = $_POST['idCalle'];
            $numero = $_POST['numero'];
            $mz = $_POST['mz'];
            $sector = $_POST['sector'];
            $parcela = $_POST['parcela'];
            $casa = $_POST['casa'];
            $torre = $_POST['torre'];
            $piso = $_POST['piso'];
            $dpto = $_POST['dpto'];
            $idDomicilio = $_POST['idDomicilio'];
            $idCamion = $_POST['idCamion'];

            $Mdomicilio = ModelosCamiones::MdlMdomicilio($idBarrio, $idCalle, $numero, $mz, $sector, $parcela, $casa, $torre, $piso, $dpto, $idDomicilio);

            echo '<form action="camionesDetalles" method="post" name="camionesDetalles" id="camionesDetalles">
                <input type="hidden" name="idCamion" value="' . $idCamion . '">
            </form>';

            if ($Mdomicilio == true) {
                echo "<script>	
               
                    jQuery(function(){
                        Swal.fire({
                            icon: 'success',
                            title: '¡Muy bien!',
                            text: 'Registro Modificado',
                            showConfirmButton: true,
                            }).then((result) => {
                                document.camionesDetalles.submit();
                                // location.href = 'camionesListado';
                        })
                    });
               
                </script>";
            } else {
                echo "<script>	
                        jQuery(function(){
                            Swal.fire({
                                icon: 'error',
                                title: '¡Algo no anda bien!',
                                text: 'No se pudo procesar (ER007), consulte con el administrador',
                                showConfirmButton: true
                                }).then((result) => {
                                    // location.href = 'camionesListado';
                                    document.camionesDetalles.submit();
                            })
                        });
                </script>";
            }
        }
    }

    /*=============================================
	  PROCEDIMIENTO PARA VOLVER A HABILITAR A UN CHOFER DE UN CAMION  	 	
	 =============================================*/
    public function CtrlActivaChofer()
    {

        if (isset($_POST['ConfirmacionActivarChofer'])) {

            $idChofer = $_POST['idChofer'];
            $idCamion = $_POST['idCamion'];
            $estadoChofer = True;


            echo '<form action="camionesDetalles" method="post" name="camionesDetalles" id="camionesDetalles">
                <input type="hidden" name="idCamion" value="' . $idCamion . '">
            </form>';


            $bajaChofer = ModelosCamiones::MdlActualizaEstadoChofer($idChofer, $idCamion, $estadoChofer); //mensaje error (ER006)
            if ($bajaChofer == true) {
                echo "<script>	
               
                    jQuery(function(){
                        Swal.fire({
                            icon: 'success',
                            title: '¡Muy bien!',
                            text: 'Chofer reactivado',
                            showConfirmButton: true,
                            }).then((result) => {
                                document.camionesDetalles.submit();
                                // location.href = 'camionesListado';
                        })
                    });
               
                </script>";
            } else {
                echo "<script>	
                        jQuery(function(){
                            Swal.fire({
                                icon: 'error',
                                title: '¡Algo no anda bien!',
                                text: 'No se pudo procesar (ER006), consulte con el administrador',
                                showConfirmButton: true
                                }).then((result) => {
                                    // location.href = 'camionesListado';
                                    document.camionesDetalles.submit();
                            })
                        });
                </script>";
            }
        }
    }


    public function CtrlActivaCamion()
    {

        if (isset($_POST['ConfirmacionActivarCamion'])) {

            $idChofer = $_POST['idChofer'];
            $idCamion = $_POST['idCamion'];
            $estadoChofer = True;


            echo '<form action="camionesDetalles" method="post" name="camionesDetalles" id="camionesDetalles">
                <input type="hidden" name="idCamion" value="' . $idCamion . '">
            </form>';


            $bajaChofer = ModelosCamiones::MdlActualizaEstadoChofer($idChofer, $idCamion, $estadoChofer); //mensaje error (ER006)
            if ($bajaChofer == true) {
                echo "<script>	
               
                    jQuery(function(){
                        Swal.fire({
                            icon: 'success',
                            title: '¡Muy bien!',
                            text: 'Chofer reactivado',
                            showConfirmButton: true,
                            }).then((result) => {
                                document.camionesDetalles.submit();
                                // location.href = 'camionesListado';
                        })
                    });
               
                </script>";
            } else {
                echo "<script>	
                        jQuery(function(){
                            Swal.fire({
                                icon: 'error',
                                title: '¡Algo no anda bien!',
                                text: 'No se pudo procesar (ER006), consulte con el administrador',
                                showConfirmButton: true
                                }).then((result) => {
                                    // location.href = 'camionesListado';
                                    document.camionesDetalles.submit();
                            })
                        });
                </script>";
            }
        }
    }

    /*=============================================
	  PROCEDIMIENTO PARA DAR DE BAJA A UN CHOFER DE UN CAMION	
	 =============================================*/
    public function CtrlBajaChofer()
    {

        if (isset($_POST['ConfirmacionBajaChofer'])) {

            $idChofer = $_POST['idChofer'];
            $idCamion = $_POST['idCamion'];
            $estadoChofer = False;


            echo '<form action="camionesDetalles" method="post" name="camionesDetalles" id="camionesDetalles">
                <input type="hidden" name="idCamion" value="' . $idCamion . '">
            </form>';

            $bajaChofer = ModelosCamiones::MdlActualizaEstadoChofer($idChofer, $idCamion, $estadoChofer);
            if ($bajaChofer == true) {
                echo "<script>	
               
                    jQuery(function(){
                        Swal.fire({
                            icon: 'success',
                            title: '¡Muy bien!',
                            text: 'Chofer dado de Baja',
                            showConfirmButton: true,
                            }).then((result) => {
                                document.camionesDetalles.submit();
                                // location.href = 'camionesListado';
                        })
                    });
               
                </script>";
            } else {
                echo "<script>	
                        jQuery(function(){
                            Swal.fire({
                                icon: 'error',
                                title: '¡Algo no anda bien!',
                                text: 'No se pudo procesar la baja (ER004), consulte con el administrador',
                                showConfirmButton: true
                                }).then((result) => {
                                    // location.href = 'camionesListado';
                                    document.camionesDetalles.submit();
                            })
                        });
                </script>";
            }
        }
    }

    /*=============================================
	  PROCEDIMIENTO PARA DAR DE BAJA A UN CAMION  	 	
	 =============================================*/
    public function CtrlBajaCamion()
    {

        if (isset($_POST['ConfirmacionBajaCamion'])) {

            $idCamion = $_POST['idCamion'];
            // $dominio = $_POST['dominio'];
            $estadoCamion = 12;


            echo '<form action="camionesDetalles" method="post" name="camionesDetalles" id="camionesDetalles">
                <input type="hidden" name="idCamion" value="' . $idCamion . '">
            </form>';

            $bajaCamion = ModelosCamiones::MdlActualizaEstadoCamion($idCamion, $estadoCamion);
            if ($bajaCamion == true) {
                echo "<script>	
                    jQuery(function(){
                        Swal.fire({
                            icon: 'success',
                            title: '¡Muy bien!',
                            text: 'Camion dado de Baja',
                            showConfirmButton: true,
                            }).then((result) => {
                                // document.ListadoCamiones.submit();
                                location.href = 'camionesListado';
                        })
                    });
               
                </script>";
            } else {
                echo "<script>	
                        jQuery(function(){
                            Swal.fire({
                                icon: 'error',
                                title: '¡Algo no anda bien!',
                                text: 'No se pudo procesar la baja (ER003), consulte con el administrador',
                                showConfirmButton: true
                                }).then((result) => {
                                    location.href = 'camionesListado';
                                    // document.ListadoCamiones.submit();
                            })
                        });
                </script>";
            }
        }
    }


    /*=============================================
	  PROCEDIMIENTO PARA CREAR UN NUEVO CAMION  	 	
	 =============================================*/
    public function A_Camiones()
    {
        if (isset($_POST['altaCamion'])) {


            $interno = $_POST['interno'];
            $dominio = $_POST['dominio'];
            $marca = $_POST['marca'];
            $modelo = $_POST['modelo'];
            $chasis = $_POST['chasis'];
            $idTipoPropietario = 1;
            $tipo_servicio = $_POST['tipo_servicio'];
            $descripcion_cam = $_POST['descripcion_cam'];
            $idEstado = 7;
            $vencimiento_seguro = $_POST['vencimiento_seguro'];
            // $capacidad = $_POST['capacidad'];
            $seguro = $_POST['seguro'];


            // //SECCION TITULAR
            $nombre_t = $_POST['nombre_t'];
            $dni_t = $_POST['dni_t'];
            $fecha_nac_t = $_POST['fecha_nac_t'];
            // $nacionalidad_titular = $_POST['nacionalidad_titular'];
            if (isset($_POST['nacionalidad_titular'])) {
                $nacionalidad_titular = $_POST['nacionalidad_titular'];
            } else {
                $nacionalidad_titular = 1;
            }
            $telefono_t = $_POST['telefono_t'];
            $telefono2_t = $_POST['telefono2_t'];
            // $direccion_t = $_POST['direccion_t'];
            // $id_barrio_t = $_POST['barrio_titular'];
            if (isset($_POST['barrio_titular'])) {
                $id_barrio_t = $_POST['barrio_titular'];
            } else {
                $id_barrio_t = 1;
            }
            $id_calle_t = $_POST['calle_t'];
            $numero_t = $_POST['numero_t'];
            $mz_t = $_POST['mz_t'];
            $sector_t = $_POST['sector_t'];
            $parcela_t = $_POST['parcela_t'];
            $casa_t = $_POST['casa_t'];
            $torre_t = $_POST['torre_t'];
            $piso_t = $_POST['piso_t'];
            $dpto_t = $_POST['dpto_t'];
            $mail_t = $_POST['mail_t'];
            $Obs_t = $_POST['Obs_t'];
            $obs_dom = $_POST['obs_dom'];
            $idTiposPersona = 1;

            if (isset($_POST['chofer_titular']) && $_POST['chofer_titular'] == '1') {
                $id_tipo_chofer = $_POST['id_tipo_chofer'];
                $tipo_licencia_titular = $_POST['tipo_licencia_titular'];
                $vencimiento_licencia_titular = $_POST['vencimiento_licencia_titular'];
                $idTiposPersona = 2;
                $id_persona = null;
                $idEstado = 11;

                $ValidaPersona = ModelosCamiones::MdlValidaPersona($dni_t);
                if (!empty($ValidaPersona)) {
                    foreach ($ValidaPersona as $dataPersona) {
                        $id_persona = $dataPersona['id'];
                    }
                }

                $SPA_Personas = ModelosCamiones::SPA_Camion_Titular_chofer($id_barrio_t, $id_calle_t, $numero_t, $mz_t, $sector_t, $parcela_t, $casa_t, $torre_t, $piso_t, $dpto_t, $telefono_t, $telefono2_t, $mail_t, $nombre_t, $dni_t, $fecha_nac_t, $nacionalidad_titular, $Obs_t, $idTiposPersona, $interno, $dominio, $marca, $modelo, $chasis, $idTipoPropietario, $tipo_servicio, $descripcion_cam, $idEstado, $vencimiento_seguro, $seguro, $id_persona, $obs_dom, $id_tipo_chofer, $tipo_licencia_titular, $vencimiento_licencia_titular);
            } else {


                $id_tipo_chofer = null;

                if (isset($_POST['propiedad_muni']) && $_POST['propiedad_muni'] == '1') {

                    $SPA_Personas = ModelosCamiones::SPA_Camion_municipal($interno, $dominio, $marca, $modelo, $chasis, 2, $tipo_servicio, $descripcion_cam, $idEstado, $seguro, $vencimiento_seguro);
                } else {
                    $id_persona = null;

                    $ValidaPersona = ModelosCamiones::MdlValidaPersona($dni_t);
                    if (!empty($ValidaPersona)) {
                        foreach ($ValidaPersona as $dataPersona) {
                            $id_persona = $dataPersona['id'];
                        }
                    }

                    $SPA_Personas = ModelosCamiones::SPA_Camion_Titular($id_barrio_t, $id_calle_t, $numero_t, $mz_t, $sector_t, $parcela_t, $casa_t, $torre_t, $piso_t, $dpto_t, $telefono_t, $telefono2_t, $mail_t, $nombre_t, $dni_t, $fecha_nac_t, $nacionalidad_titular, $Obs_t, $idTiposPersona, $interno, $dominio, $marca, $modelo, $chasis, $idTipoPropietario, $tipo_servicio, $descripcion_cam, $idEstado, $vencimiento_seguro, $seguro, $id_persona, $obs_dom);
                }
            }


            echo '<form action="camionesListado" method="post" name="ListadoCamiones"></form>';


            if ($SPA_Personas == "SUCCESS") {
                echo "<script>	
               
                    jQuery(function(){
                        Swal.fire({
                            icon: 'success',
                            title: '¡Muy bien!',
                            text: 'Camion Registrado',
                            showConfirmButton: true,
                            }).then((result) => {
                                // document.ListadoCamiones.submit();
                                location.href = 'camionesListado';
                        })
                    });
               
                </script>";
                return;
            } else {
                echo "<script>	
                        jQuery(function(){
                            Swal.fire({
                                icon: 'error',
                                title: '¡Algo no anda bien!',
                                text: 'No se pudo guardar, consulte con el administrador',
                                showConfirmButton: true
                                }).then((result) => {
                                    location.href = 'camionesListado';
                                    // document.ListadoCamiones.submit();
                            })
                        });
                </script>";
            }
        }
    }

    /*=============================================
	  PROCEDIMIENTO PARA CREAR UN NUEVO CHOFER DE UN CAMION  	 	
	 =============================================*/
    public function A_Choferes()
    {

        if (isset($_POST['A_CHOFER'])) {
            // echo "ADD CHOFER";

            // $barrio_ch = $_POST['barrio_chofer'];
            // $calle_ch = $_POST['calle_chofer'];
            // $numero_ch = $_POST['numero_ch'];
            // $mz_ch = $_POST['mz_ch'];
            // $sector_ch = $_POST['sector_ch'];
            // $parcela_ch = $_POST['parcela_ch'];
            // $casa_ch = $_POST['casa_ch'];
            // $torre_ch = $_POST['torre_ch'];
            // $piso_ch = $_POST['piso_ch'];
            // $dpto_ch = $_POST['dpto_ch'];

            if (empty($_POST['barrio_chofer'])) {
                $barrio_ch = 'NULL';
            }

            if (empty($_POST['numero_ch']) || $_POST['numero_ch'] == ' ') {
                $numero_ch = 'NULL';
            } else {
                $numero_ch = trim($_POST['numero_ch']);
            }

            if (empty($_POST['mz_ch'])) {
                $mz_ch = 'NULL';
            } else {
                $mz_ch = trim($_POST['mz_ch']);
            }

            if (empty($_POST['sector_ch']) || $_POST['sector_ch'] == ' ') {
                $sector_ch = 'NULL';
            } else {
                $sector_ch = trim($_POST['sector_ch']);
            }

            if (empty($_POST['parcela_ch']) || $_POST['parcela_ch'] == ' ') {
                $parcela_ch = 'NULL';
            } else {
                $parcela_ch = trim($_POST['parcela_ch']);
            }

            if (empty($_POST['casa_ch']) || $_POST['casa_ch'] == ' ') {
                $casa_ch = 'NULL';
            } else {
                $casa_ch = trim($_POST['casa_ch']);
            }

            if (empty($_POST['torre_ch']) || $_POST['torre_ch'] == ' ') {
                $torre_ch = 'NULL';
            } else {
                $torre_ch = trim($_POST['torre_ch']);
            }

            if (empty($_POST['piso_ch']) || $_POST['piso_ch'] == ' ') {
                $piso_ch = 'NULL';
            } else {
                $piso_ch = trim($_POST['piso_ch']);
            }

            if (empty($_POST['dpto_ch']) || $_POST['dpto_ch'] == ' ') {
                $dpto_ch = 'NULL';
            } else {
                $dpto_ch = trim($_POST['dpto_ch']);
            }



            $barrio_ch = trim($_POST['barrio_chofer']) ?? NULL;
            $calle_ch = trim($_POST['calle_chofer']) ?? NULL;
            // $numero_ch = trim($_POST['numero_ch']) ?? NULL;
            // $mz_ch = trim($_POST['mz_ch']) ?? NULL;
            // $sector_ch = trim($_POST['sector_ch']) ?? NULL;
            // $parcela_ch = trim($_POST['parcela_ch']) ?? NULL;
            // $casa_ch = trim($_POST['casa_ch']) ?? NULL;
            // $torre_ch = trim($_POST['torre_ch']) ?? NULL;
            // $piso_ch = trim($_POST['piso_ch']) ?? NULL;
            // $dpto_ch = trim($_POST['dpto_ch']) ?? NULL;


            $tipo_chofer = $_POST['tipo_chofer'];


            // $telefono_ch = $_POST['telefono_ch'];

            if (empty($_POST['telefono_ch']) || $_POST['telefono_ch'] == ' ') {
                $telefono_ch = 'NULL';
            } else {
                $telefono_ch = trim($_POST['telefono_ch']);
            }


            // $telefono2_ch = $_POST['telefono2_ch'];

            if (empty($_POST['telefono2_ch']) || $_POST['telefono2_ch'] == ' ') {
                $telefono2_ch = 'NULL';
            } else {
                $telefono2_ch = trim($_POST['telefono2_ch']);
            }


            if (empty($_POST['mail_ch']) || $_POST['mail_ch'] == ' ') {
                $mail_ch = 'NULL';
            } else {
                $mail_ch = trim($_POST['mail_ch']);
            }


            // $mail_ch = $_POST['mail_ch'];


            $nombre_c_chofer = $_POST['nombre_c_chofer'];
            $dni_ch = $_POST['dni_ch'];
            $fecha_nacimiento_ch = $_POST['fecha_nacimiento_ch'];
            $nacionalidad_ch = $_POST['nacionalidad_ch'];
            $observaciones_ch = $_POST['observaciones_ch'] ?? "SIN OBSERVACIONES";
            $id_tipo_persona_ch = 2;


            $idCamion = $_POST['idCamion'];
            $tipo_licencia = $_POST['tipo_licencia'];
            $vencimiento_licencia = $_POST['vencimiento_licencia'];

            $nuevoEstadoCamion = 11; //11 ACTIVO - 12 INACTIVO - 7 DATOS INCOMPLETOS - 8 DATOS COMPLETOS

            $idTipoPersona = 2; // 1 TITULAR - 2 CHOFER


            /*==========================================================================================
               PROCEDIMIENTO EN CASO DE QUE SE INTENTE ASIGNAR UNA PERSONA QUE YA EXISTE EN BASE DE DATOS
            ==========================================================================================*/

            echo "<form action='camionesDetalles' method='post' name='camionesDetalles' id='camionesDetalles'>
                <input type='hidden' name='idCamion' value='" . $idCamion . "'>
                </form>";


            $MdlValidaPersona = ModelosCamiones::MdlValidaPersona($dni_ch);
            if (!empty($MdlValidaPersona)) {  //si la persona existe en base de datos se extrae el id

                foreach ($MdlValidaPersona as $data) {
                    $id_persona = $data['id'];
                }

                // se consulta si la persona ya esta asignada como chofer 
                $MdlValidaTipoPersona = ModelosCamiones::MdlValidaTipoPersona($id_persona, $idTipoPersona);

                if (empty($MdlValidaTipoPersona)) { //si la persona no esta asignada como chofer se inserta en la tabla PersonasTiposPersona

                    $MdlInsertaPersonaTipoPersona = ModelosCamiones::MdlInsertaPersonaTipoPersona($id_persona, $idTipoPersona);

                    if ($MdlInsertaPersonaTipoPersona == false) {
                        echo "<script>	
                                    jQuery(function(){
                                        Swal.fire({
                                            icon: 'error',
                                            title: '¡Algo no anda bien!',
                                            text: 'No se pudo guardar (ER002), consulte con el administrador',
                                            showConfirmButton: true
                                            }).then((result) => {
                                                document.camionesDetalles.submit();
                                        })
                                    });
                            </script>";
                    } else {
                        // SI SE INSERTA A LA PERSONA Y EL TIPO CORRECTAMENTE 
                        // PROCEDE A INSERTAR A LA PERSONA COMO CHOFER DE UN CAMION (VALIDA EN EL SP "SPA_Chofer");
                        $SPA_Chofer = ModelosCamiones::SPA_Chofer($barrio_ch, $calle_ch, $numero_ch, $mz_ch, $sector_ch, $parcela_ch, $casa_ch, $torre_ch, $piso_ch, $dpto_ch, $telefono_ch, $telefono2_ch, $mail_ch, $nombre_c_chofer, $dni_ch, $fecha_nacimiento_ch, $nacionalidad_ch, $observaciones_ch, $id_tipo_persona_ch, $idCamion, $tipo_licencia, $vencimiento_licencia, $id_persona, $tipo_chofer);

                        if ($SPA_Chofer == "ERROR") { // SI NO SE INSERTA CORRECTAMENTE EL CHOFER/CAMION
                            echo "<script>	
                                        jQuery(function(){
                                            Swal.fire({
                                                icon: 'error',
                                                title: '¡Algo no anda bien!',
                                                text: 'No se pudo guardar (ER003), consulte con el administrador',
                                                showConfirmButton: true
                                                }).then((result) => {
                                                    document.camionesDetalles.submit();
                                            })
                                        });
                                </script>";
                        } else { // SI SE INSERTA CORRECTAMENTE EL CHOFER/CAMION 
                            $MdlActualizaEstadoCamion = ModelosCamiones::MdlActualizaEstadoCamion($idCamion, $nuevoEstadoCamion);
                            // como ultimo paso se actualiza el estado del camion para que pase a activo ya que tiene un chofer registrado
                            if ($MdlActualizaEstadoCamion == true) {
                                echo "<script>	
                                        jQuery(function(){
                                            Swal.fire({
                                                icon: 'success',
                                                title: '¡Muy bien!',
                                                text: 'Chofer Registrado Correctamente',
                                                showConfirmButton: true,
                                                }).then((result) => {
                                                    document.camionesDetalles.submit();
                                                    // location.href = 'camionesListado';
                                            })
                                        });
                                    </script>";
                            } else {
                                //cuando se trata de un error a la hora de insertar le coloco por ejemplo una numeracion (ER004) para que me ayude a identificar mejor de donde viene el error
                                echo "<script>	
                                            jQuery(function(){
                                                Swal.fire({
                                                    icon: 'error',
                                                    title: '¡Algo no anda bien!',
                                                    text: 'No se pudo guardar (ER004), consulte con el administrador',
                                                    showConfirmButton: true
                                                    }).then((result) => {
                                                        document.camionesDetalles.submit();
                                                })
                                            });
                                    </script>";
                            }
                        }
                    }
                } else {
                    $SPA_Chofer = ModelosCamiones::SPA_Chofer($barrio_ch, $calle_ch, $numero_ch, $mz_ch, $sector_ch, $parcela_ch, $casa_ch, $torre_ch, $piso_ch, $dpto_ch, $telefono_ch, $telefono2_ch, $mail_ch, $nombre_c_chofer, $dni_ch, $fecha_nacimiento_ch, $nacionalidad_ch, $observaciones_ch, $id_tipo_persona_ch, $idCamion, $tipo_licencia, $vencimiento_licencia, $id_persona, $tipo_chofer);

                    if ($SPA_Chofer == "ERROR") { // SI NO SE INSERTA CORRECTAMENTE EL CHOFER/CAMION
                        echo "<script>	
                                        jQuery(function(){
                                            Swal.fire({
                                                icon: 'error',
                                                title: '¡Algo no anda bien!',
                                                text: 'No se pudo guardar (ER003), consulte con el administrador',
                                                showConfirmButton: true
                                                }).then((result) => {
                                                    document.camionesDetalles.submit();
                                            })
                                        });
                                </script>";
                    } else { // SI SE INSERTA CORRECTAMENTE EL CHOFER/CAMION 
                        $MdlActualizaEstadoCamion = ModelosCamiones::MdlActualizaEstadoCamion($idCamion, $nuevoEstadoCamion);
                        // como ultimo paso se actualiza el estado del camion para que pase a activo ya que tiene un chofer registrado
                        if ($MdlActualizaEstadoCamion == true) {
                            echo "<script>	
                                    jQuery(function(){
                                        Swal.fire({
                                            icon: 'success',
                                            title: '¡Muy bien!',
                                            text: 'Chofer Registrado Correctamente',
                                            showConfirmButton: true,
                                            }).then((result) => {
                                                document.camionesDetalles.submit();
                                                // location.href = 'camionesListado';
                                        })
                                    });
                                </script>";
                        } else {
                            //cuando se trata de un error a la hora de insertar le coloco por ejemplo una numeracion (ER004) para que me ayude a identificar mejor de donde viene el error
                            echo "<script>	
                                        jQuery(function(){
                                            Swal.fire({
                                                icon: 'error',
                                                title: '¡Algo no anda bien!',
                                                text: 'No se pudo guardar (ER004), consulte con el administrador',
                                                showConfirmButton: true
                                                }).then((result) => {
                                                    document.camionesDetalles.submit();
                                            })
                                        });
                                </script>";
                        }
                    }
                }

                /*==========================================================================================
                FIN DEL PROCEDIMIENTO EN CASO DE QUE SE INTENTE ASIGNAR UNA PERSONA QUE YA EXISTE EN BASE DE DATOS
                 ==========================================================================================*/
            } else { //si la persona ingresada no existe en base de datos
                /*==========================================================================================
                    INICIO PROCEDIMIENTO EN CASO DE QUE SE INTENTE ASIGNAR UNA PERSONA QUE NO EXISTE EN BASE DE DATOS
                 ==========================================================================================*/

                $id_persona = 'NULL'; // se manda id persona nulo para validar en el procedimiento

                $SPA_Chofer = ModelosCamiones::SPA_Chofer($barrio_ch, $calle_ch, $numero_ch, $mz_ch, $sector_ch, $parcela_ch, $casa_ch, $torre_ch, $piso_ch, $dpto_ch, $telefono_ch, $telefono2_ch, $mail_ch, $nombre_c_chofer, $dni_ch, $fecha_nacimiento_ch, $nacionalidad_ch, $observaciones_ch, $id_tipo_persona_ch, $idCamion, $tipo_licencia, $vencimiento_licencia, $id_persona, $tipo_chofer);

                if ($SPA_Chofer == "SUCCESS") { // si se da de alta al chofer correctamente se cambia el estado a activo
                    $MdlActualizaEstadoCamion = ModelosCamiones::MdlActualizaEstadoCamion($idCamion, $nuevoEstadoCamion); //mensaje de error (ER001)
                    if ($MdlActualizaEstadoCamion == true) {
                        echo "<script>	
                                    jQuery(function(){
                                        Swal.fire({
                                            icon: 'success',
                                            title: '¡Muy bien!',
                                            text: 'Chofer Registrado Correctamente',
                                            showConfirmButton: true,
                                            }).then((result) => {
                                                document.camionesDetalles.submit();
                                                // location.href = 'camionesListado';
                                        })
                                    });
                                </script>";
                        return;
                    } else {
                        echo "<script>	
                                    jQuery(function(){
                                        Swal.fire({
                                            icon: 'error',
                                            title: '¡Algo no anda bien!',
                                            text: 'No se pudo guardar (ER005), consulte con el administrador',
                                            showConfirmButton: true
                                            }).then((result) => {
                                                // location.href = 'camionesListado';
                                                document.camionesDetalles.submit();
                                        })
                                    });
                            </script>";
                    }
                } else {
                    echo "<script>	
                                jQuery(function(){
                                    Swal.fire({
                                        icon: 'error',
                                        title: '¡Algo no anda bien!',
                                        text: 'No se pudo guardar (ER002), consulte con el administrador',
                                        showConfirmButton: true
                                        }).then((result) => {
                                            // location.href = 'camionesListado';
                                            document.camionesDetalles.submit();
                                    })
                                });
                        </script>";
                }
            }
        }
    }
}
