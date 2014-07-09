<? 

	require('../funciones.php');
	
	validarLogin();
	$conexion = conexion();	
	extract($_POST);

	$mensaje = "Resumen";

	$queryVerificar = "SELECT per FROM periodos WHERE per = '" . $per . "'";

	$resultado;

	if(!$resultado = $conexion->query($queryVerificar)){
		$mensaje .= "\nError en Ejecuci&oacute;n: " . $conexion->error;
	}else{
		if($resultado->num_rows > 0){
			$mensaje .= "\nError: Periodo Ya existente";
		}else{
			$queryInsertar = "INSERT INTO periodos VALUES('" . $per . "')";

			if(!$conexion->query($queryInsertar)){
				$mensaje .= "\nError en Ejecuci&oacute;n" . $conexion->error;
			}else{
				$mensaje .= "\nPeriodo " . $per . " activado exitosamente";
			}

		}
	}

	$respuesta = array();

	$respuesta['respuesta'] = utf8_encode($mensaje);

	echo json_encode($respuesta);

?>