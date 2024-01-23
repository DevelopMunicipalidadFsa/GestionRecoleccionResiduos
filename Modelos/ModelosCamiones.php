<?php
include_once('Conexiones.php');
class ModelosCamiones
{
    public function MdlConsultCamionExistencia($dominio)
    {
        $existeCamion = Conexiones::conGestionAmbiental()->prepare("SELECT * FROM camiones WHERE dominio = '$dominio'");
        $existeCamion->execute();
        return $existeCamion->fetchAll();
        // $stmt->close();
    }

    public function mdlBuscarDominio($dominio)
    {
        $rta = Conexiones::conMunicipio()->prepare("SELECT * FROM [municipio].[dbo].[DatosPatentesActualesDet] (NULL,'$dominio',NULL,NULL,NULL,NULL)");
        $rta->execute();
        return $rta->fetchAll();
        // $stmt->close();
    }

    public function mdlFiltraPersonaContribuyente($dni)
    {
        $rta = Conexiones::conMunicipio()->prepare("EXEC [MunicipalidadDigital].[dbo].[Contribuyentes_Select_DNI_Nombre] $dni");
        $rta->execute();
        return $rta->fetchAll();
        // $stmt->close();
    }


    public function MdlBuscarNacionalidades()
    {
        $rta = Conexiones::conMunicipio()->prepare("SELECT * FROM [SeguridadWEB].dbo.TipoNacionalidad");
        $rta->execute();
        return $rta->fetchAll();
        // $stmt->close();
    }


    public function MdlBuscaDomicilioContribuyente($id_contribuyente)
    {
        $rta = Conexiones::conMunicipio()->prepare("SELECT cd.[Id]
        ,[IdContribuyente]
        ,[CodProv]
        ,[CodBar]
        ,[CodCal]
        ,[Domicilio]
        ,[Altura]
        ,[Piso]
        ,[Dpto]
        ,[Mz]
        ,[Torre]
        ,[Casa]
        ,[Sector]
        ,[Parcela]
        ,[LoteRural]
        ,[OldCodBar]
        ,[CodPostal]
        ,[EsPostal]
        ,[NoValido]
        ,[CalleInterseccion]
        ,br.Detalle as Barrio
        ,calle.Detalle as Calle
        FROM [SeguridadWEB].[dbo].[ContribuyentesDomicilios] cd
        LEFT JOIN [SeguridadWEB].[dbo].Barrios br ON br.Id = cd.CodBar 
        LEFT JOIN [SeguridadWEB].[dbo].Calles calle ON calle.Id = cd.CodCal 
        WHERE IdContribuyente = $id_contribuyente");
        $rta->execute();
        return $rta->fetchAll();
        // $stmt->close();
    }

    static public function MdlBuscarBarrios()
    {

        $stmt = Conexiones::conMunicipio()->prepare("SELECT barrio, descrip 
		FROM   Municipio..barrios
		ORDER BY descrip");
        $stmt->execute();

        return $stmt->fetchAll();

        // $stmt->close();
    }

    static public function mdlBuscarCalles()
    {

        $stmt = Conexiones::conMunicipio()->prepare("SELECT Id, Detalle FROM [MunicipalidadDigital].[dbo].[HabilitacionesC_ListarCalles]()");
        $stmt->execute();

        return $stmt->fetchAll();

        // $stmt->close();
    }

    static public function MdlListarCamiones()
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



    static public function MdlListarCamionesInactivos()
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
        LEFT JOIN ESTADOS EST ON EST.id = CAM.idEstado WHERE CAM.idEstado = 12 ORDER BY idCamion DESC");
        $stmt->execute();

        return $stmt->fetchAll();

        // $stmt->close();
    }

    static public function MdlCamionesDetalles($idCamion)
    {

        $stmt = Conexiones::conGestionAmbiental()->prepare("SELECT 
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
		,PERS.id as IdPersona
		,PERS.[apellidosNombres]
		,UT.detalle as tipo_servicio
		,EST.detalle as desc_estado
		,PERS.*
		,c.*
		,d.*
		,SWC.Detalle as desc_calle
		,SWB.Detalle as desc_barrio
		,SWTN.Descripcion as desc_nacionalidad
        ,d.barrio as id_barrio
        ,d.calle as id_calle
        FROM GestionAmbiental.dbo.camiones CAM
        LEFT JOIN personas PERS ON PERS.id = CAM.idPropietario
        LEFT JOIN personasTiposPersona PTP ON PTP.idPersonas = CAM.idPropietario
        LEFT JOIN unidadTipo UT ON UT.id = CAM.idTipoServicios 
        LEFT JOIN contactos C ON C.id = PERS.idContactos
        LEFT join domicilio d ON D.id = pers.idDomicilio
        LEFT JOIN SeguridadWEB.dbo.Calles SWC ON SWC.Id = D.calle
        LEFT JOIN SeguridadWEB.dbo.Barrios SWB ON SWB.Id = D.barrio
        left JOIN SeguridadWEB.dbo.TipoNacionalidad SWTN ON SWTN.Id = pers.Nacionalidad
        LEFT JOIN ESTADOS EST ON EST.id = CAM.idEstado WHERE CAM.id = $idCamion");
        $stmt->execute();

        return $stmt->fetchAll();

        // $stmt->close();
    }

    static public function MdlDomicilioPersona($id_domicilio_persona)
    {

        $stmt = Conexiones::conGestionAmbiental()->prepare("SELECT 
        domicilio.*,
        calles.Detalle as desc_calle,
        barrios.Detalle as desc_barrio
        FROM domicilio 
        JOIN SeguridadWEB.dbo.Calles as Calles on Calles.Id = domicilio.calle
        JOIN SeguridadWEB.dbo.Barrios as Barrios On barrios.Id = domicilio.barrio
        WHERE domicilio.id = $id_domicilio_persona");
        $stmt->execute();

        return $stmt->fetchAll();

        // $stmt->close();
    }

    public function MdlContactosPersona($id_contacto_persona)
    {

        $stmt = Conexiones::conGestionAmbiental()->prepare("SELECT * FROM contactos
        where id = $id_contacto_persona");
        $stmt->execute();

        return $stmt->fetchAll();

        // $stmt->close();
    }


    static public function MdlListarChoferesCamion($id_camion)
    {

        $ListaChofeeres = Conexiones::conGestionAmbiental()->prepare("SELECT PERS.*, ENC.*,SWTN.Descripcion as desc_nacionalidad FROM personas PERS
        JOIN camionesChoferEncargado ENC ON ENC.idChofer = PERS.id
        JOIN camiones CAM ON CAM.id = ENC.idCamion
        LEFT JOIN SeguridadWEB.dbo.TipoNacionalidad SWTN ON SWTN.Id = pers.Nacionalidad
        WHERE CAM.id = $id_camion AND activo = 'true'");
        $ListaChofeeres->execute();

        return $ListaChofeeres->fetchAll();

        // $stmt->close();
    }

    static public function MdlValidaInterno($interno)
    {

        $stmt = Conexiones::conGestionAmbiental()->prepare("SELECT * FROM camiones WHERE interno = '$interno'");
        $stmt->execute();

        return $stmt->fetchAll();

        // $stmt->close();
    }

    /*=============================================
        VALIDA EXISTENCIA DE UNA PERSONA	
   =============================================*/

    static public function MdlValidaPersona($dni)
    {

        $persona = Conexiones::conGestionAmbiental()->prepare("SELECT DISTINCT personas.id FROM personas 
        JOIN personasTiposPersona ptp on ptp.idPersonas = personas.id
        where dni = $dni");
        $persona->execute();

        return $persona->fetchAll();
    }

    /*=============================================
        VALIDA TIPO DE PERSONA Y SI EXISTE
     =============================================*/

    static public function MdlValidaTipoPersona($idPersona, $idTipoPersona)
    {

        $persona = Conexiones::conGestionAmbiental()->prepare("SELECT [idTiposPersona],[idPersonas] FROM [GestionAmbiental].[dbo].[personasTiposPersona]
        WHERE [idTiposPersona] = $idTipoPersona AND [idPersonas] = $idPersona");
        $persona->execute();

        return $persona->fetchAll();
    }

    /*=============================================
        INSERTA PERSONA TIPO PERSONA EN CASO DE QUE NO EXISTA
     =============================================*/

    static public function MdlInsertaPersonaTipoPersona($idPersona, $idTipoPersona) //1 titular - 2 chofer
    {

        $persona = Conexiones::conGestionAmbiental()->prepare("INSERT INTO [GestionAmbiental].[dbo].[personasTiposPersona]
        ([idTiposPersona],[idPersonas]) VALUES ($idTipoPersona,$idPersona)");
        if ($persona->execute()) {
            return true;
        } else {
            return false;
        }
    }


    ///////////////////////////////////////////////////////

    static public function MdlConsultaExistenciaPersona($dni, $idTipoPersona)
    {

        $persona = Conexiones::conGestionAmbiental()->prepare("SELECT personas.id FROM personas 
        JOIN personasTiposPersona ptp on ptp.idPersonas = personas.id
        where dni = $dni AND ptp.idTiposPersona = $idTipoPersona");
        $persona->execute();

        return $persona->fetchAll();
    }

    static public function MdlConsultaExistenciaChoferxCamion($id_persona, $idCamion)
    {

        $persona = Conexiones::conGestionAmbiental()->prepare("SELECT [idCamion]
        ,[idChofer]
        ,[tipoLicencia]
        ,[fecVencimientoLicencia]
        ,[activo]
        FROM [GestionAmbiental].[dbo].[camionesChoferEncargado]
        WHERE idChofer = $id_persona AND idCamion = $idCamion");
        $persona->execute();

        return $persona->fetchAll();

        // $stmt->close();
    }

    static public function MdlConsultaExistenciaTipopersona($id_persona)
    {

        $persona = Conexiones::conGestionAmbiental()->prepare("SELECT [idTiposPersona]
        ,[idPersonas]
        FROM [GestionAmbiental].[dbo].[personasTiposPersona] where idTiposPersona = 2 AND idPersonas = $id_persona");
        $persona->execute();

        return $persona->fetchAll();

        // $stmt->close();
    }


    static public function MdlInsertarChoferTipoPers($id_persona)
    {

        $persTipo = Conexiones::conGestionAmbiental()->prepare("INSERT INTO [GestionAmbiental].[dbo].[personasTiposPersona]
        ([idTiposPersona] ,[idPersonas]) VALUES ('2',$id_persona)");
        if ($persTipo->execute()) {
            return true;
        } else {
            return false;
        }

        // $stmt->close();
    }

    static public function MdlMcamion($idCamion, $chasis, $tipo_servicio, $interno, $seguro, $vencimiento_seguro, $descripcion_cam)
    {
        $camionModi = Conexiones::conGestionAmbiental()->prepare("UPDATE [GestionAmbiental].[dbo].[camiones]
        SET [chasis] = '$chasis' 
           ,[idTipoServicios] = '$tipo_servicio'
           ,[interno] = '$interno' 
           ,[seguro] = '$seguro' 
           ,[vencimientoSeguro] = '$vencimiento_seguro'
           ,[obs] = '$descripcion_cam'
      WHERE id = $idCamion");
        if ($camionModi->execute()) {
            return true;
        } else {
            return false;
        }

        // $stmt->close();
    }

    static public function MdlMpersona($apellidosNombres, $dni, $fechaNacimiento, $Nacionalidad, $obs, $idPersona)
    {

        $persTipo = Conexiones::conGestionAmbiental()->prepare("UPDATE [GestionAmbiental].[dbo].[personas]
        SET [apellidosNombres] = '$apellidosNombres' 
           ,[dni] = '$dni'
           ,[fechaNacimiento] = '$fechaNacimiento' 
           ,[Nacionalidad] = '$Nacionalidad' 
           ,[obs] = '$obs'
      WHERE id = $idPersona");
        if ($persTipo->execute()) {
            return true;
        } else {
            return false;
        }

        // $stmt->close();
    }

    static public function MdlMcontacto($celular1, $celular2, $mail, $idContacto)
    {

        $persTipo = Conexiones::conGestionAmbiental()->prepare("UPDATE [GestionAmbiental].[dbo].[contactos]
        SET [celular1] = '$celular1'
           ,[celular2] = '$celular2'
           ,[mail] = '$mail'
      WHERE [contactos].[id] = $idContacto");
        if ($persTipo->execute()) {
            return true;
        } else {
            return false;
        }

        // $stmt->close();
    }


    static public function MdlMdomicilio($idBarrio, $idCalle, $numero, $mz, $sector, $parcela, $casa, $torre, $piso, $dpto, $idDomicilio)
    {

        $persTipo = Conexiones::conGestionAmbiental()->prepare("UPDATE [GestionAmbiental].[dbo].[domicilio]
        SET barrio = '$idBarrio'
           ,calle = '$idCalle'
           ,numero = $numero
           ,mz = '$mz'
           ,sector = '$sector'
           ,parcela = '$parcela'
           ,casa = '$casa'
           ,torre = '$torre'
           ,piso = '$piso'
           ,dpto = '$dpto'
        WHERE id = $idDomicilio");
        if ($persTipo->execute()) {
            return true;
        } else {
            return false;
        }

        // $stmt->close();
    }

    static public function MdlConsultaExistenciaChoferCamion($id_persona, $id_camion)
    {

        $persona = Conexiones::conGestionAmbiental()->prepare("SELECT idCamion, idChofer FROM camionesChoferEncargado WHERE idCamion = $id_camion AND idChofer = $id_persona");
        $persona->execute();

        return $persona->fetchAll();

        // $stmt->close();
    }


    static public function MdlDatosPersona($dni)
    {

        $persona = Conexiones::conGestionAmbiental()->prepare("SELECT *, ch.idTipoChofer as tipoChofer, ch.tipoLicencia, ch.fecVencimientoLicencia FROM personas pers
        JOIN contactos con on con.id = pers.idContactos
        JOIN domicilio dom on dom.id = pers.idDomicilio
        JOIN camionesChoferEncargado ch on ch.idChofer = pers.id
        left JOIN SeguridadWEB.dbo.TipoNacionalidad SWTN ON SWTN.Id = pers.Nacionalidad
        WHERE pers.dni = $dni");
        $persona->execute();

        return $persona->fetchAll();

        // $stmt->close();
    }



    static public function MdlActualizaEstadoCamion($id_camion, $estadoCamion)
    {

        $estadoCamion = Conexiones::conGestionAmbiental()->prepare("UPDATE [GestionAmbiental].[dbo].[camiones]
        SET idEstado = $estadoCamion WHERE camiones.id = $id_camion");
        if ($estadoCamion->execute()) {
            return true;
        } else {
            return false;
        }

        // $stmt->close();
    }

    static public function MdlActualizaEstadoChofer($idChofer, $idCamion, $estadoChofer)
    {

        $bajaChofer = Conexiones::conGestionAmbiental()->prepare("UPDATE [GestionAmbiental].[dbo].[camionesChoferEncargado]
        SET activo = '$estadoChofer' WHERE idCamion = '$idCamion' AND idChofer = '$idChofer'");
        if ($bajaChofer->execute()) {
            return true;
        } else {
            return false;
        }

        // $stmt->close();
    }

    static public function MdlBajaCamion($id_camion)
    {

        $bajaCamion = Conexiones::conGestionAmbiental()->prepare("UPDATE [GestionAmbiental].[dbo].[camiones]
        SET idEstado = 12 WHERE camiones.id = $id_camion");
        if ($bajaCamion->execute()) {
            return true;
        } else {
            return false;
        }

        // $stmt->close();
    }




    public function SPA_Camion_Titular($barrio, $calle, $numero, $mz, $sector, $parcela, $casa, $torre, $piso, $dpto, $celular1, $celular2, $mail, $apellidosNombres, $dni, $fechaNacimiento, $Nacionalidad, $obs, $idTiposPersona, $interno, $dominio, $marca, $modelo, $chasis, $idTipoPropietario, $tipo_servicio, $descripcion_cam, $idEstado, $vencimiento_seguro, $seguro, $id_persona, $obs_dom)
    {

        $SPAPersona = Conexiones::conGestionAmbiental()->prepare('EXEC [GestionAmbiental].[dbo].[SPA_Camion_titular] ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?');
        $SPAPersona->bindParam(1, $barrio);
        $SPAPersona->bindParam(2, $calle);
        $SPAPersona->bindParam(3, $numero);
        $SPAPersona->bindParam(4, $mz);
        $SPAPersona->bindParam(5, $sector);
        $SPAPersona->bindParam(6, $parcela);
        $SPAPersona->bindParam(7, $casa);
        $SPAPersona->bindParam(8, $torre);
        $SPAPersona->bindParam(9, $piso);
        $SPAPersona->bindParam(10, $dpto);
        $SPAPersona->bindParam(11, $celular1);
        $SPAPersona->bindParam(12, $celular2);
        $SPAPersona->bindParam(13, $mail);
        $SPAPersona->bindParam(14, $apellidosNombres);
        $SPAPersona->bindParam(15, $dni);
        $SPAPersona->bindParam(16, $fechaNacimiento);
        $SPAPersona->bindParam(17, $Nacionalidad);
        $SPAPersona->bindParam(18, $obs);
        $SPAPersona->bindParam(19, $idTiposPersona);
        $SPAPersona->bindParam(20, $interno);
        $SPAPersona->bindParam(21, $dominio);
        $SPAPersona->bindParam(22, $marca);
        $SPAPersona->bindParam(23, $modelo);
        $SPAPersona->bindParam(24, $chasis);
        $SPAPersona->bindParam(25, $idTipoPropietario);
        $SPAPersona->bindParam(26, $tipo_servicio);
        $SPAPersona->bindParam(27, $descripcion_cam);
        $SPAPersona->bindParam(28, $idEstado);
        $SPAPersona->bindParam(29, $seguro);
        $SPAPersona->bindParam(30, $vencimiento_seguro);
        $SPAPersona->bindParam(31, $id_persona);
        $SPAPersona->bindParam(32, $obs_dom);

        if ($SPAPersona->execute()) {
            return 'SUCCESS';
        } else {
            return 'ERROR';
        }
    }


    public function SPA_Camion_Titular_chofer($barrio, $calle, $numero, $mz, $sector, $parcela, $casa, $torre, $piso, $dpto, $celular1, $celular2, $mail, $apellidosNombres, $dni, $fechaNacimiento, $Nacionalidad, $obs, $idTiposPersona, $interno, $dominio, $marca, $modelo, $chasis, $idTipoPropietario, $tipo_servicio, $descripcion_cam, $idEstado, $vencimiento_seguro, $seguro, $id_persona, $obs_dom, $id_tipo_chofer, $tipo_licencia, $vencimiento_licencia)
    {

        $SPAPersona = Conexiones::conGestionAmbiental()->prepare('EXEC [GestionAmbiental].[dbo].[SPA_Camion_titular_chofer] ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?');
        $SPAPersona->bindParam(1, $barrio);
        $SPAPersona->bindParam(2, $calle);
        $SPAPersona->bindParam(3, $numero);
        $SPAPersona->bindParam(4, $mz);
        $SPAPersona->bindParam(5, $sector);
        $SPAPersona->bindParam(6, $parcela);
        $SPAPersona->bindParam(7, $casa);
        $SPAPersona->bindParam(8, $torre);
        $SPAPersona->bindParam(9, $piso);
        $SPAPersona->bindParam(10, $dpto);
        $SPAPersona->bindParam(11, $celular1);
        $SPAPersona->bindParam(12, $celular2);
        $SPAPersona->bindParam(13, $mail);
        $SPAPersona->bindParam(14, $apellidosNombres);
        $SPAPersona->bindParam(15, $dni);
        $SPAPersona->bindParam(16, $fechaNacimiento);
        $SPAPersona->bindParam(17, $Nacionalidad);
        $SPAPersona->bindParam(18, $obs);
        $SPAPersona->bindParam(19, $idTiposPersona);
        $SPAPersona->bindParam(20, $interno);
        $SPAPersona->bindParam(21, $dominio);
        $SPAPersona->bindParam(22, $marca);
        $SPAPersona->bindParam(23, $modelo);
        $SPAPersona->bindParam(24, $chasis);
        $SPAPersona->bindParam(25, $idTipoPropietario);
        $SPAPersona->bindParam(26, $tipo_servicio);
        $SPAPersona->bindParam(27, $descripcion_cam);
        $SPAPersona->bindParam(28, $idEstado);
        $SPAPersona->bindParam(29, $seguro);
        $SPAPersona->bindParam(30, $vencimiento_seguro);
        $SPAPersona->bindParam(31, $id_persona);
        $SPAPersona->bindParam(32, $obs_dom);
        $SPAPersona->bindParam(33, $id_tipo_chofer);
        $SPAPersona->bindParam(34, $tipo_licencia);
        $SPAPersona->bindParam(35, $vencimiento_licencia);

        if ($SPAPersona->execute()) {
            return 'SUCCESS';
        } else {
            return 'ERROR';
        }
    }


    public function SPA_Camion_municipal($interno, $dominio, $marca, $modelo, $chasis, $idTipoPropietario, $tipo_servicio, $descripcion_cam, $idEstado, $seguro, $vencimiento_seguro)
    {

        $SPAPersona = Conexiones::conGestionAmbiental()->prepare("EXEC [dbo].[SPA_Camion_municipal]
		@interno = N'$interno',
		@dominio = N'$dominio',
		@marca = N'$marca',
		@modelo = N'$modelo',
		@chasis = N'$chasis',
		@idTipoPropietario = $idTipoPropietario,
		@idTipoServicio = $tipo_servicio,
		@obs_camion = N'$descripcion_cam',
		@IdEstado = $idEstado,
		@seguro = N'$seguro',
		@vencimientoSeguro = '$vencimiento_seguro'");


        if ($SPAPersona->execute()) {
            return 'SUCCESS';
        } else {
            return 'ERROR';
        }
    }

    public function SPA_Chofer($barrio_ch, $calle_ch, $numero_ch, $mz_ch, $sector_ch, $parcela_ch, $casa_ch, $torre_ch, $piso_ch, $dpto_ch, $telefono_ch, $telefono2_ch, $mail_ch, $nombre_c_chofer, $dni_ch, $fecha_nacimiento_ch, $nacionalidad_ch, $observaciones_ch, $id_tipo_persona_ch, $idCamion, $tipo_licencia, $vencimiento_licencia, $id_persona, $tipo_chofer)
    {

        $SPA_Chofer = Conexiones::conGestionAmbiental()->prepare("EXEC [dbo].[SPA_Chofer]
		@barrio = $barrio_ch,
		@calle = $calle_ch,
		@numero = $numero_ch,
		@mz = N'$mz_ch',
		@sector = $sector_ch,
		@parcela = $parcela_ch,
		@casa = N'$casa_ch',
		@torre = $torre_ch,
		@piso = $piso_ch,
		@dpto = $dpto_ch,
		@celular1 = N'$telefono_ch',
		@celular2 = N'$telefono2_ch',
		@mail = N'$mail_ch',
		@apellidosNombres = N'$nombre_c_chofer',
		@dni = $dni_ch,
		@fechaNacimiento = '$fecha_nacimiento_ch',
		@Nacionalidad = $nacionalidad_ch,
		@obs = N'$observaciones_ch',
		@idTiposPersona = $id_tipo_persona_ch,
		@idCamion = $idCamion,
		@TipoLicencia = N'$tipo_licencia',
		@VencimientoLicencia = '$vencimiento_licencia',
		@id_valida_persona = $id_persona,
		@id_tipo_chofer = $tipo_chofer");


        if ($SPA_Chofer->execute()) {
            return 'SUCCESS';
        } else {
            return 'ERROR';
        }

        // $SPA_Chofer = Conexiones::conGestionAmbiental()->prepare('EXEC [GestionAmbiental].[dbo].[SPA_Chofer] ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?');
        // $SPA_Chofer->bindParam(1, $barrio_ch);
        // $SPA_Chofer->bindParam(2, $calle_ch);
        // $SPA_Chofer->bindParam(3, $numero_ch);
        // $SPA_Chofer->bindParam(4, $mz_ch);
        // $SPA_Chofer->bindParam(5, $sector_ch);
        // $SPA_Chofer->bindParam(6, $parcela_ch);
        // $SPA_Chofer->bindParam(7, $casa_ch);
        // $SPA_Chofer->bindParam(8, $torre_ch);
        // $SPA_Chofer->bindParam(9, $piso_ch);
        // $SPA_Chofer->bindParam(10, $dpto_ch);
        // $SPA_Chofer->bindParam(11, $telefono_ch);
        // $SPA_Chofer->bindParam(12, $telefono2_ch);
        // $SPA_Chofer->bindParam(13, $mail_ch);
        // $SPA_Chofer->bindParam(14, $nombre_c_chofer);
        // $SPA_Chofer->bindParam(15, $dni_ch);
        // $SPA_Chofer->bindParam(16, $fecha_nacimiento_ch);
        // $SPA_Chofer->bindParam(17, $nacionalidad_ch);
        // $SPA_Chofer->bindParam(18, $observaciones_ch);
        // $SPA_Chofer->bindParam(19, $id_tipo_persona_ch);
        // $SPA_Chofer->bindParam(20, $idCamion);
        // $SPA_Chofer->bindParam(21, $tipo_licencia);
        // $SPA_Chofer->bindParam(22, $vencimiento_licencia);
        // $SPA_Chofer->bindParam(23, $id_persona);
        // $SPA_Chofer->bindParam(24, $tipo_chofer);       
    }
}
