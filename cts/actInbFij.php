<? 
	if (session_status() == PHP_SESSION_NONE) {
    	session_start();
	}

	extract($_REQUEST);
	require('../funciones.php');
	$conexion = conexion();
	
	$res = "Resumen: ";

	$qryBorrar = "DELETE FROM var_ent
				WHERE nom = 'inbFij'
				AND per = '" . $_SESSION['periodo'] .  "'";

	if($conexion->query($qryBorrar)){
		// $res = $res . "\nVariable Actualizada";
	}else{
		$res = $res . "\nNo se puede Eliminar la variable";
	}

	$qry = "INSERT INTO var_ent VALUES('" . $_SESSION['periodo'] . "', 'inbFij', " . $inboundFijos . ",  'inb');";

	if($conexion->query($qry)){
		$res = $res . "\nVariable Actualizada";
	}else{
		$res = $res . "\nError en Ejecuci&oacute;n, Intentelo De Nuevo";
	}
	
	$resumen = array();
	$resumen['resumen'] = utf8_encode($res);
	$resumen['valorActual'] = utf8_encode($inboundFijos);
	echo json_encode($resumen);
	
?>