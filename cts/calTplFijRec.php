<? 
	error_reporting(E_ALL);

	if (session_status() == PHP_SESSION_NONE) {
    	session_start();
	}

	require('../funciones.php');
	
	$conexion = conexion();
	
	$inicio = Date('h') . ":" . Date('i') . ":" . Date('s');

	$queriesDatosGenerales = array();
	
	$queriesDatosGenerales['m3'] = "SELECT SUM(shiCubMet) AS 'Metros Cubicos'
							FROM fle_del
							WHERE per = '" . $_SESSION['periodo'] . "';";

	$queriesDatosGenerales['gf'] = "SELECT val AS 'TPL Fijos Reclasificacion'
			FROM var_ent
			WHERE nom = 'tplFijRec'
			AND per = '" . $_SESSION['periodo'] . "';";

	$datosGenerales = agregarDatosGenerales($queriesDatosGenerales);
	
	$queries = array();
	
	$queries['a'] = "UPDATE fle_del
					SET tplFijRec = 0
					WHERE per = '" . $_SESSION['periodo'] . "'";
	$queries['b'] = "UPDATE fle_del
					SET tplFijRec = shiCubMet * (" . $datosGenerales['TPL Fijos Reclasificacion'] . "/ " . $datosGenerales['Metros Cubicos'] . " )
					WHERE per = '" . $_SESSION['periodo'] . "';";
	
	$resumen = "Exito\nResumen: ";		
	
	foreach($queries as $descripcion => $querie){
		//echo "<br>" . $querie;
		if(!$conexion->query($querie)){
			 $resumen = $resumen. "\nError: " . $descripcion . "=>" . $conexion->error;
		}else{
			$resumen = $resumen. "\nExito: " . $descripcion;
		}
	}
	
	$final = Date('h') . ":" . Date('i') . ":" . Date('s');
	
	
	$resultado = array();
	$resumen .= "\nInicio: $inicio\nFinal: $final";
	$resultado['resumen'] = utf8_encode($resumen);
	echo json_encode($resultado); 
?>