<? 	
	

	require('../funciones.php');
	error_reporting(0);

	limpiarRequest($_REQUEST);

	extract($_REQUEST);

	verificarSesion();

	//Verificamos si se ha recibido un periodo o si no existe tomar como parametro el mas actual
	$conexion = conexion();
	if($_SESSION['periodo'] == '' && $periodo == ''){

		$queryPeriodo = "select max(per) as 'periodo' from periodos";
		$resultado = $conexion->query($queryPeriodo);
		$resultado->fetch_array();
		foreach($resultado as $valor){
			$periodo = $valor['periodo'];
		}

		$_SESSION['periodo'] = $periodo;
		
	}else if($periodo != ''){
		$_SESSION['periodo'] = $periodo;
	}

?>