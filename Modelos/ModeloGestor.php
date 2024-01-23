<?php
include_once 'Conexiones.php';

class ModeloGestor
{

	static public function mdlIngresoUsu($username, $clave, $modulo)
	{

		$login = Conexiones::conMunicipalidadDigital()->prepare("SELECT * FROM login (?,?,?)");

		$login->bindParam(1, $username, PDO::PARAM_INT);
		$login->bindParam(2, $clave, PDO::PARAM_STR);
		$login->bindParam(3, $modulo, PDO::PARAM_INT);

		$login->execute();

		return $login->fetch();

		// $login->close();
	}
	public function mdlFecha()
	{
		//SP fecha extraida del servidor municipal
		$consultaFecha = Conexiones::conMunicipio()->prepare("EXEC [municipio].[dbo].[Fecha]");
		$consultaFecha->execute();

		return $consultaFecha->fetchAll();

		// $consultaFecha->close();
	}
	public function mdlDatosUsu($usu, $modulo)
	{

		$datosUsuario = Conexiones::conMunicipalidadDigital()->prepare("EXECUTE [MunicipalidadDigital].[dbo].[Usuarios2_Datos] ?,?");

		$datosUsuario->bindParam(1, $usu, PDO::PARAM_INT);
		$datosUsuario->bindParam(2, $modulo, PDO::PARAM_INT);

		$datosUsuario->execute();

		return $datosUsuario->fetchAll();

		// $datosUsuario->close();

		$datosUsuario = null;
	}
	public function mdlListadoBarrio()
	{

		$listadoBarrios = Conexiones::conSeguridadWEB()->prepare("SELECT * FROM [SeguridadWEB].[dbo].[FNBarrios] (null) ORDER BY Detalle ASC");

		$listadoBarrios->execute();

		$lista = $listadoBarrios->fetchAll();

		return $lista;

		// $listadoBarrios->close();

		$listadoBarrios = null;
	}
	public function mdlListadoCalle()
	{

		$listadoCalle = Conexiones::conSeguridadWEB()->prepare("SELECT * FROM [SeguridadWEB].[dbo].[FNCalles] (null) ORDER BY Detalle ASC");
		$listadoCalle->execute();
		$lista = $listadoCalle->fetchAll();

		return $lista;

		// $listadoCalle->close();
		$listadoCalle = null;
	}

	public function mdlBuscarPersonas($dni)
	{

		$datosPersona = Conexiones::conMunicipalidadDigital()->prepare("EXEC [MunicipalidadDigital].[dbo].[Contribuyentes_Select_DNI_Nombre] ?");

		$datosPersona->bindParam(1, $dni, PDO::PARAM_INT);
		$datosPersona->execute();
		$datos = $datosPersona->fetch();

		return $datos;

		// $datosPersona->close();
		$datosPersona = null;
	}

	static public function mdlMostrarNroZona()
	{
		$zona = Conexiones::conGestionAmbiental()->prepare("SELECT MAX(nroZona)+1 AS ultimoId FROM [dbo].[zonasRecoleccion]");
		$zona->execute();

		return $zona->fetchAll();
	}


	static public function mdlRegistrarZona($nuevoArray)
	{

		$descripcion = 'ZONA';

		$resultadoId = Conexiones::conGestionAmbiental()->query("SELECT MAX(nroZona) FROM [dbo].[zonasRecoleccion]")->fetchAll();
		foreach ($resultadoId as $fila) {
			if ($fila[0] == null) {
				$nroZona = 1;
			} elseif ($fila[0] >= 1) {
				$nroZona = $fila[0] + 1;
			}
		}

		$nuevaZona = Conexiones::conGestionAmbiental()->prepare("INSERT INTO [dbo].[zonasRecoleccion](nroZona, descripcion) VALUES (?,?)");
		$nuevaZona->bindParam(1, $nroZona, PDO::PARAM_INT);
		$nuevaZona->bindParam(2, $descripcion, PDO::PARAM_STR);

		if ($nuevaZona->execute()) {
			$resultadoId = Conexiones::conGestionAmbiental()->query("SELECT MAX(id) FROM [dbo].[zonasRecoleccion] ")->fetchAll();
			foreach ($resultadoId as $fila) {
				$idZona = $fila[0];
			}

			foreach ($nuevoArray as $valor) {
				foreach ($valor as $barrio) {

					$IdRelacion = $idZona;

					$nuevoBarrioPorZona = Conexiones::conGestionAmbiental()->prepare("INSERT INTO [dbo].[zonasRecoleccionBarrios](idZona, idBarrio) VALUES (?,?)");
					$nuevoBarrioPorZona->bindParam(1, $IdRelacion, PDO::PARAM_INT);
					$nuevoBarrioPorZona->bindParam(2, $barrio, PDO::PARAM_INT);
					if ($nuevoBarrioPorZona->execute()) {
						$respuesta = "ok";
					} else {
						$respuesta = "Error";
					}
				}
			}
			return $respuesta;
		}
	}


	static public function mdlMostrarBarriosPorZona()
	{

		$stmt = Conexiones::conGestionAmbiental()->prepare("SELECT * FROM dbo.FN_LISTAR_BARRIOS_POR_ZONAS();");

		$stmt->execute();

		$resultados = $stmt->fetchAll();

		return $resultados;
	}

	static public function mdlMostrarBarriosPorID($nroZona)
	{

		$stmt = Conexiones::conGestionAmbiental()->prepare("SELECT *
                                            		  		FROM dbo.FN_LISTAR_BARRIOS_POR_ZONAS() WHERE nroZona = $nroZona;");

		$stmt->execute();

		$resultados = $stmt->fetchAll();

		return $resultados;
	}


	static public function mdlObtenerIdZonaPorNro($nroZona)
	{
		$stmt = Conexiones::conGestionAmbiental()->prepare("SELECT id
	    													FROM zonasRecoleccion
	    													WHERE nroZona = :nroZona");
		$stmt->bindParam(':nroZona', $nroZona, PDO::PARAM_INT);
		$stmt->execute();

		$resultado = $stmt->fetch(PDO::FETCH_ASSOC);

		if ($resultado) {
			return $resultado['id'];
		} else {
			return null;
		}
	}


	static public function mdlModificarBarriosPorZona($nroZona)
	{

		$stmt = Conexiones::conGestionAmbiental()->prepare("SELECT *
                                            		  		FROM dbo.FN_LISTAR_BARRIOS_POR_ZONAS() WHERE nroZona = $nroZona;");

		$stmt->execute();

		$resultados = $stmt->fetchAll();

		return $resultados;
	}

	static public function mdlValidarBarrioPorZona($idBarrio)
	{

		$stmt = Conexiones::conGestionAmbiental()->prepare("SELECT nroZona, DETALLE
															FROM zonasRecoleccion T1
															INNER JOIN zonasRecoleccionBarrios T2 ON T2.idZona = T1.id
															INNER JOIN SeguridadWeb.dbo.Barrios T3 on T2.idBarrio = T3.ID
															WHERE idBarrio=$idBarrio");
		if ($stmt->execute()) {

			$resultado = $stmt->fetchAll();
			return $resultado;
		} else {
			return "Error";
		}
	}

	static public function mdlBajaBarrioPorZona($idBarrio)
	{

		$stmt = Conexiones::conGestionAmbiental()->prepare("DELETE FROM GestionAmbiental.dbo.zonasRecoleccionBarrios WHERE idBarrio=$idBarrio");

		if ($stmt->execute()) {
			return "ok";
		} else {
			return "Error";
		}
	}

	static public function mdlRegistrarBarriosPorZona($nuevoArray)
	{

		$respuesta = "";

		$idBarrioNuevo = null;
		$idZonaNuevo = null;

		foreach ($nuevoArray as $elemento) {
			if ($elemento['name'] === 'idBarrioNuevo') {
				$idBarrioNuevo = intval($elemento['value']);
			} elseif ($elemento['name'] === 'idZonaNuevo') {
				$idZonaNuevo = intval($elemento['value']);
			}
		}
		if ($idBarrioNuevo !== null && $idZonaNuevo !== null) {
			try {
				$nuevoBarrioPorZona = Conexiones::conGestionAmbiental()->prepare("INSERT INTO dbo.zonasRecoleccionBarrios(idZona, idBarrio) VALUES (?, ?)");

				$nuevoBarrioPorZona->bindParam(1, $idZonaNuevo);
				$nuevoBarrioPorZona->bindParam(2, $idBarrioNuevo);

				if ($nuevoBarrioPorZona->execute()) {
					$respuesta = "ok";
				} else {
					$respuesta = "Error";
				}
			} catch (PDOException $e) {
				$respuesta = "Error de bd" . $e->getMessage();
			}
		}

		return $respuesta;
	}
}
