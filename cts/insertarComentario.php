<? 
	error_reporting(0);

	require('../funciones.php');

	$conexion = conexion();

	$respuesta = array();

	$r = "Resumen";

	limpiarRequest($_REQUEST);

	extract($_REQUEST);

	$query = "";

	if($hayCom == 'false'){

		$query = "INSERT INTO cts_com VALUES('" . $per . "', '" . $mod . "', '" . $com . "');";
		$r .= ejecutarQuery($conexion, $query, 0);

	}else{

		$query = "UPDATE  cts_com SET com = '" . $com . "' WHERE per = '" . $per . "' AND modulo = '" . $mod . "'";
		$r .= ejecutarQuery($conexion, $query, 0);
				
	}

	$respuesta['respuesta'] = $r;

	echo json_encode($respuesta);

?>