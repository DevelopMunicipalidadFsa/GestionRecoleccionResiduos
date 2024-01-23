<?php

class ControladorGestor
{

    // static public function ctrLogin()
    // {

    //     if (isset($_POST['username']) && isset($_POST['clave'])) {

    //         $username = $_POST['username'];
    //         $clave    = $_POST['clave'];

    //         if ($username == true && $clave == true) {
    //             $respuesta = ModeloGestor::mdlLogin($username, $clave);
    //             return $respuesta;
    //         }
    //     }
    // }


    // static public function ctrUsuarioLogin()
    // {

    //     if (isset($_REQUEST['username'])) {

    //         $usuarioNombre = $_REQUEST['username'];

    //         if ($usuarioNombre == true) {
    //             $respuesta = ModeloGestor::mdlUsuarioLogin($usuarioNombre);
    //             return $respuesta;
    //         }
    //     }
    // }

    static public function CtrIngresoUsu($username, $clave)
    {
        // ID 264 es el de sistema de gestion ambiental
        $modulo = 264;
        $respuesta = ModeloGestor::mdlIngresoUsu($username, $clave, $modulo);
        return $respuesta;
    }

    /*=============================================
	 =            DATOS USUARIOS          		=
	 =============================================*/

    public function CtrDatosUsu($usu)
    {

        /* pasa el parametro $usu al modelo  ModelosSeguimientoExpedientes::mdlDatosUsu($usu,$modulo)*/
        $modulo = 264;

        $rta = ModeloGestor::mdlDatosUsu($usu, $modulo);

        return $rta;
    }

    /*=============================================
	 =            LISTADO BARRIOS          		  =
	 =============================================*/

    public function CtrListadoBarrios()
    {

        $listadoBarrios = ModeloGestor::mdlListadoBarrio();

        return $listadoBarrios;
    }

    /*=============================================
	 =            LISTADO CALLE         		=
	 =============================================*/

    public function CtrListadoCalle()
    {

        $listadoCalle = ModeloGestor::mdlListadoCalle();

        return $listadoCalle;
    }

    /*=============================================
	    =            BUSCAR PESONA        		=
	 =============================================*/

    public function CtrBuscarPersonas($dni)
    {

        $datosPersona = ModeloGestor::mdlBuscarPersonas($dni);

        return $datosPersona;
    }


    /*=============================================
        =            MOSTRAR ULTIMO NRO ZONA              =
     =============================================*/

    public function CtrMostrarNroZona()
    {

        $nroZona = ModeloGestor::mdlMostrarNroZona();

        return $nroZona;
    }


    /*=============================================
	    =            REGISTRAR ZONA       		=
	 =============================================*/

    static public function ctrRegistrarZona($arrayBarriosXZona)
    {

        $nuevoArray = array();

        foreach ($arrayBarriosXZona as $barrios) {

            if (!isset($nuevoArray[$barrios['name']])) {
                $nuevoArray[$barrios['name']] = array();
            }
            $myarray = $nuevoArray[$barrios['name']][] = (int)$barrios['value'];
        }
        $respuesta = ModeloGestor::mdlRegistrarZona($nuevoArray);
        return $respuesta;
    }


    /*=============================================
        =            MOSTRAR BARRIOS POR ZONAS              =
     =============================================*/

    public function CtrMostrarBarriosPorZona()
    {

        $listaBarriosPorZona = ModeloGestor::mdlMostrarBarriosPorZona();

        return $listaBarriosPorZona;
    }

    public function CtrValidarBarrioPorZona($idBarrio)
    {

        $ValidarBarrioPorZona = ModeloGestor::mdlValidarBarrioPorZona($idBarrio);

        return $ValidarBarrioPorZona;
    }

    public function CtrMostrarBarriosPorID($nroZona)
    {

        $listaBarriosPorZona = ModeloGestor::mdlMostrarBarriosPorID($nroZona);

        return $listaBarriosPorZona;
    }

    public function obtenerIdZonaPorNro($nroZona)
    {
        $idZona = ModeloGestor::mdlObtenerIdZonaPorNro($nroZona);
        return $idZona;
    }

    public function CtrModificarBarriosPorZona($nroZona)
    {

        $modificarBarriosPorZona = ModeloGestor::mdlModificarBarriosPorZona($nroZona);

        return $modificarBarriosPorZona;
    }

    public function CtrBajaBarrioPorZona($idBarrio)
    {

        $bajaBarrioPorZona = ModeloGestor::mdlBajaBarrioPorZona($idBarrio);

        return $bajaBarrioPorZona;
    }

    static public function ctrRegistrarBarriosPorZona($barrioZona)
    {

        $nuevoArray = array();

        foreach ($barrioZona as $elemento) {

            if ($elemento['name'] == 'idBarrioNuevo' || $elemento['name'] == 'idZonaNuevo') {
                $nuevoArray[] = $elemento;
            }
        }

        $respuesta = ModeloGestor::mdlRegistrarBarriosPorZona($nuevoArray);
        return $respuesta;
    }
}
