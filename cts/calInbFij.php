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

	$queriesDatosGenerales['gf'] = "SELECT val AS 'Inbound Fijos'
			FROM var_ent
			WHERE nom = 'inbFij'
			AND per = '" . $_SESSION['periodo'] . "';";
	

	$datosGenerales = agregarDatosGenerales($queriesDatosGenerales);
	
	$queries = array();
	
	$queries['a'] = "UPDATE fle_del
					SET inbRec = 0
					WHERE per = '" . $_SESSION['periodo'] . "'";
	
	$queries['b'] = "UPDATE fle_del
	SET inbRec = shiCubMet * (" . $datosGenerales['Inbound Fijos'] . "/ " . $datosGenerales['Metros Cubicos'] . " )
	WHERE per = '" . $_SESSION['periodo'] . "';";
	
	/*$queries['a14'] = "";
	$queries['a15'] = "";
	$queries['a16'] = "";
	$queries['a17'] = "";
	$queries['a18'] = "";
	$queries['a19'] = "";
	$queries['a20'] = "";*/
	
	$resumen = "Resumen: ";		
	
	foreach($queries as $descripcion => $querie){
		//echo "<br>" . $querie;
		if(!$conexion->query($querie)){
			 $resumen = $resumen. "\nError: " . $descripcion . "=>" . $conexion->error;
		}else{
			//$resumen = $resumen. "\nExito: " . $descripcion;
		}
	}
	
	$final = Date('h') . ":" . Date('i') . ":" . Date('s');
	
	$cts = 1;
	require('actDatGen.php');
	
	$resultado = array();
	$resumen .= "\nInicio: " . $inicio . "\nFinal: " . $final;
	$resultado['resumen'] = utf8_encode($resumen);

	// $cts = 1;
	// require('datGen.php');
	
	echo json_encode($resultado); 
?>