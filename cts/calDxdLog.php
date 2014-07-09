<? 
	error_reporting(E_ALL);

	if (session_status() == PHP_SESSION_NONE) {
    	session_start();
	}

	$inicio = Date('h') . ":" . Date('i') . ":" . Date('s');
	//Calculo Gastos Eventuales
	require('../funciones.php');
	
	$conexion = conexion();
	
	$queriesDatosGenerales = array();
	$queriesDatosGenerales[''] = "";
	//$datosGenerales = agregarDatosGenerales($queriesDatosGenerales);
	
	$queries = array();
	$queries['ao'] = "update fle_del
		set dxdLogAux = 0
		WHERE per = '" . $_SESSION['periodo'] . "';";
	$queries['ap'] = "update fle_del
		set dxdLogAux = dxdTotAux - dxdRecAux
		WHERE per = '" . $_SESSION['periodo'] . "';";


	$resumenUrl = "Resumen: ";		
	foreach($queries as $descripcion => $querie){
		//echo "<br>" . $querie;
		if(!$conexion->query($querie)){
			 $resumenUrl = $resumenUrl. "\nError: " . $descripcion . "=>" . $querie;
		}else{
			$resumenUrl = $resumenUrl. "\nExito: " . $querie;
		}
	}
	
	require('datGen.php');
	$final = Date('h') . ":" . Date('i') . ":" . Date('s');
	$resultado = array();
	$resumenUrl .= "\nInicio: $inicio\nFinal: $final";
	
	$resultado['resumen'] = utf8_encode($resumenUrl);
	echo json_encode($resultado); 
	
	
?>