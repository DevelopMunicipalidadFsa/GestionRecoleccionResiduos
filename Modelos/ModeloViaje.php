<?php
include_once('Conexiones.php');
class ModelosViajes
{
    public function MdlBuscarCooperativas()
    {
        $rta = Conexiones::conGestionAmbiental()->prepare("SELECT * FROM [GestionAmbiental].[dbo].[FN_LISTADO_COOPERATIVAS]()");
        $rta->execute();
        return $rta->fetchAll();
        // $stmt->close();
    }

    public function MdlValidaCooperativas($idCooperativa)
    {
        $rta = Conexiones::conGestionAmbiental()->prepare("SELECT 
        coop.id, 
        coop.razonSocial, 
        coop.cuitCuil, 
        contCoop.celular1 as celularCoop,
        contCoop.celular2 as celularAltCoop,
        pteCoop.apellidosNombres,
        contPteCoop.celular1 as celularPteCoop,
        contPteCoop.celular2 as celularAltPteCoop,
        est.detalle,
        sc.nombre as seguro,
        sc.vencimientoFecha as seguroVencimiento
        FROM domicilio as dCoop
        INNER JOIN cooperativa as coop ON dCoop.id = coop.idDomicilio
        INNER JOIN contactos as contCoop ON coop.idContacto = contCoop.id
        INNER JOIN personas as pteCoop ON pteCoop.id = coop.idPresidente
        INNER JOIN contactos as contPteCoop ON contPteCoop.id = pteCoop.idContactos
        INNER JOIN estados as est ON est.id = coop.idEstado
        INNER JOIN seguroCooperativa as sc ON coop.idSeguro = sc.id
        WHERE coop.idEstado <> 12 AND coop.id = $idCooperativa");
        $rta->execute();
        return $rta->fetchAll();
        // $stmt->close();
    }

    public function MdlGruposCooperativa($idCooperativa)
    {
        $rta = Conexiones::conGestionAmbiental()->prepare("SELECT * FROM [GestionAmbiental].[dbo].[FN_LISTADO_GRUPOS_POR_COOPERATIVA_ID]($idCooperativa) ");
        $rta->execute();
        return $rta->fetchAll();
        // $stmt->close();
    }


    public function MdlPersonasGrupo($idGrupo)
    {
        $rta = Conexiones::conGestionAmbiental()->prepare("SELECT * FROM [GestionAmbiental].[dbo].[FN_LISTADO_PERSONAL_POR_GRUPOCOOP]($idGrupo)");
        $rta->execute();
        return $rta->fetchAll();
        // $stmt->close();
    }

    public function MdlListarZonas()
    {
        $rta = Conexiones::conGestionAmbiental()->prepare(" SELECT [id]
        ,[nroZona]
        ,[descripcion]
        ,[activo]
    FROM [GestionAmbiental].[dbo].[zonasRecoleccion]");
        $rta->execute();
        return $rta->fetchAll();
        // $stmt->close();
    }

    public function MdlListarTiposServicios()
    {
        $rta = Conexiones::conGestionAmbiental()->prepare("SELECT * FROM ServiciosTipo WHERE activo = '1'");
        $rta->execute();
        return $rta->fetchAll();
        // $stmt->close();
    }

    static public function MdlListarCamionesViaje()
    {

        $stmt = Conexiones::conGestionAmbiental()->prepare("SELECT DISTINCT
		CAM.id as idCamion
		,[interno]
		,[dominio]
		,[marca]
		,[modelo]
		,[chasis]
		,[idTipoPropietarios]
		,[idTipoServicios]
		,[idPropietario]
		,CAM.[obs]
		,CAM.[idEstado] as idEstadoCamion
		,CAM.[seguro] 
		,CAM.[vencimientoSeguro]
        ,CAM.idEstado
		,PERS.id as IdPersona
		,PERS.[apellidosNombres]
		,UT.detalle as tipo_servicio
		,EST.detalle as desc_estado
        FROM GestionAmbiental.dbo.camiones CAM
        LEFT JOIN personas PERS ON PERS.id = CAM.idPropietario
        LEFT JOIN personasTiposPersona PTP ON PTP.idPersonas = CAM.idPropietario
        LEFT JOIN unidadTipo UT ON UT.id = CAM.idTipoServicios 
        LEFT JOIN ESTADOS EST ON EST.id = CAM.idEstado WHERE CAM.idEstado <> 12 ORDER BY idEstado DESC");
        $stmt->execute();

        return $stmt->fetchAll();

        // $stmt->close();
    }


    static public function MdlListarServicios()
    {

        $stmt = Conexiones::conGestionAmbiental()->prepare("SELECT 
        s.id as id_servicio,
        s.fecha,
        s.ingresoSP,
        s.egresoSP,
        s.ingresoVM,
        s.egresoVM,
        cam.interno,
        cam.dominio,
        p.apellidosNombres,
        zr.descripcion,
        zr.nroZona,
        tur.turno,
        est.detalle,
        coop.razonSocial,
        cg.grupo
        FROM servicio s
        INNER JOIN cooperativa coop on coop.id = s.idCooperativa
        INNER JOIN camiones cam on cam.id = s.idCamion
        INNER JOIN personas p on p.id = s.idChofer
        inner join cooperativaGrupo cg on cg.id = s.idGrupoCooperativa
        inner join zonasRecoleccion zr on zr.id = s.idZona
        inner join turno tur on tur.id = s.idTurno
        INNER JOIN estados est on est.id = s.idEstado");
        $stmt->execute();

        return $stmt->fetchAll();

        // $stmt->close();
    }

    static public function MdlValidaCamionServicio($id_camion, $fecha)
    {

        $stmt = Conexiones::conGestionAmbiental()->prepare("SELECT * FROM servicio WHERE idCamion = $id_camion AND fecha = '$fecha' AND idEstado = 11");
        $stmt->execute();

        return $stmt->fetchAll();

        // $stmt->close();
    }


    static public function MdlValidaCooperativaServicio($idCooperativa, $fecha)
    {

        $stmt = Conexiones::conGestionAmbiental()->prepare("SELECT * FROM servicio where idGrupoCooperativa = $idCooperativa AND fecha = '$fecha' AND idEstado = 11");
        $stmt->execute();

        return $stmt->fetchAll();

        // $stmt->close();
    }


    public function SPA_Servicio($id_camion, $id_chofer, $idTurno, $id_zona, $id_tipo_servicio, $id_cooperativa, $idGrupoCooperativa, $usuario)
    {

        $SPAPersona = Conexiones::conGestionAmbiental()->prepare("EXEC [dbo].[SPA_Servicio]
		@idCamion = $id_camion,
		@idChofer = $id_chofer,
		@idTurno = $idTurno,
		@idZona = $id_zona,
		@idTipoServicio = $id_tipo_servicio,
		@idCooperativa = $id_cooperativa,
		@idGrupoCooperativa = $idGrupoCooperativa,
		@usuario = $usuario");


        if ($SPAPersona->execute()) {
            return 'SUCCESS';
        } else {
            return 'ERROR';
        }
    }


    public function SPA_Asistencia($idPersona, $asistencia, $obs, $usuAlta)
    {

        if ($asistencia == 0) {
            $SPAPersona = Conexiones::conGestionAmbiental()->prepare("EXEC [dbo].[SPA_Asistencia]
            @idPersona = $idPersona,
            @asistencia = $asistencia,
            @observacion = NULL,
            @usuario = $usuAlta");

            if ($SPAPersona->execute()) {
                return 'SUCCESS';
            } else {
                return 'ERROR';
            }
        } else {
            $fechaActual = date('d-m-Y');

            $SPAPersona = Conexiones::conGestionAmbiental()->prepare("UPDATE [GestionAmbiental].[dbo].[asistencia]
            SET [asistencia] = 1
            WHERE idPersona = $idPersona 
            AND fechaAsistencia = '$fechaActual'");

            if ($SPAPersona->execute()) {
                return 'SUCCESS';
            } else {
                return 'ERROR';
            }
        }
    }

    public function SPA_AsistenciaActiva($idPersona)
    {

        $fechaActual = date('d-m-Y');

        $SPAPersona = Conexiones::conGestionAmbiental()->prepare("UPDATE [GestionAmbiental].[dbo].[asistencia]
        SET [asistencia] = 1
        WHERE idPersona = $idPersona AND CONVERT(date, fechaAsistencia) = CONVERT(date, GETDATE())");

        if ($SPAPersona->execute()) {
            return 'SUCCESS';
        } else {
            return 'ERROR';
        }
    }
}
