<? 

	require('../funciones.php');

	$conexion = conexion();

	limpiarRequest($_REQUEST);

	extract($_REQUEST);

	$respuesta = array();

	$query = "SELECT com FROM cts_com WHERE per = '" . $per . "' AND modulo = '" . $mod . "' LIMIT 1;";

	$respuesta['respuesta'] = $query;

	$registro = obtenerQueryToArray($conexion, $query);
	
	if($registro){
		$respuesta['hayComentario'] = true;
		$respuesta['comentarios'] = $registro[0]['com'];		
	}else{

		$respuesta['hayComentario'] = false;
		$respuesta['comentarios'] = "Sin Comentarios";

	}

	echo json_encode($respuesta);


?>