<? 
	if (session_status() == PHP_SESSION_NONE) {
    	session_start();
	}

	extract($_REQUEST);
	require('../funciones.php');
	$conexion = conexion();
	

	$res = "Resumen: ";

	$qryBorrar = "DELETE FROM var_ent
				WHERE nom = 'cosRen'
				AND per = '" . $_SESSION['periodo'] .  "'";

	if($conexion->query($qryBorrar)){
		// $res = $res . "\nVariable Actualizada";
	}else{
		$res = $res . "\nNo se puede Eliminar la variable";
	}

	$qry = "INSERT INTO var_ent VALUES('" . $_SESSION['periodo'] . "', 'cosRen', " . $cosRen . ",  'ren');";

	if($conexion->query($qry)){
		$res = $res . "\nVariable Actualizada";
	}else{
		$res = $res . "\nError en Ejecuci&oacute;n, Intentelo De Nuevo";
	}
	
	$resumen = array();
	$resumen['resumen'] = utf8_encode($res);
	$resumen['valorActual'] = utf8_encode($cosRen);
	echo json_encode($resumen);

	// $res = "Resumen: ";
	// $qry = "UPDATE var_ent
	// 		SET val = " . $cosRen . "
	// 		WHERE nom = 'cosRen';";
	// if($conexion->query($qry)){
	// 	$res = $res . "\nVariable Actualizada";
	// }else{
	// 	$res = $res . "\nError en Ejecuci&oacute;n, Intentelo De Nuevo";
	// }
	
	// $resumen = array();
	// $resumen['resumen'] = utf8_encode($res);
	// $resumen['valorActual'] = utf8_encode($cosRen);
	
	// require('datGen.php');
	// echo json_encode($resumen);
	
?>