<? 

	if (session_status() == PHP_SESSION_NONE) {
    	session_start();
	}

	require('conexion.php');
	$conexion = conexion();
	$queries = array();
	
	$queries['v'] = "UPDATE inp_dxd_mfm
	SET inp_dxd_mfm.shiCubMet = 
		(
		
			SELECT sum(fle_del.shiCubMet)
			FROM fle_del
			WHERE fle_del.solToPar = inp_dxd_mfm.shiToPar
			AND fle_del.per = '" . $_SESSION['periodo'] . "'
			
		)
	WHERE inp_dxd_mfm.per = '".$_SESSION['periodo'] ."'";
	
	//Ajustamos a cero aquellos en nulo
	$queries['w'] = "UPDATE inp_dxd_mfm
	SET inp_dxd_mfm.shiCubMet = 0
	WHERE inp_dxd_mfm.shiCubMet IS NULL
	AND inp_dxd_mfm.per = '".$_SESSION['periodo'] ."';";
	
	//Este querie obtiene la sumatoria de todos los campos con valores en contabilidad, excepto las maniobras que se pasaran a Outbound prorrateandose por sus M3
	$queries['x'] = "UPDATE inp_dxd_mfm
	SET mfmCubMet = (filRat + mer + pro + benImp + citPer + por) / shiCubMet
	WHERE shiCubMet > 0
	AND per = '".$_SESSION['periodo'] ."';";

	//Anulamos aquellos con metros cubicos en cero
	$queries['y'] = "UPDATE inp_dxd_mfm
	SET mfmCubMet = 0
	WHERE shiCubMet = 0
	AND per = '".$_SESSION['periodo'] ."';";
	
	//Actualizamos fle_del a traves en base al Sol To Par, aunque en la tabla inp_dxd_mfm venga desde el Ship To Party dado que asi es como debera cambiarse, 
	//se deja asi por efectos de tiempo
	
	
	//Actualizamos a 0 el dxdMfm en fle_del
	$queries['zzzzzzz'] = "UPDATE fle_del
							SET mfmDxd = 0
							WHERE per = '".$_SESSION['periodo'] ."';";
	
	$queries['z'] = "UPDATE fle_del
	INNER JOIN inp_dxd_mfm
	ON fle_del.solToPar = inp_dxd_mfm.shiToPar
	AND fle_del.per = '".$_SESSION['periodo'] ."'
	AND inp_dxd_mfm.per = '".$_SESSION['periodo'] ."'
	SET fle_del.mfmDxd = fle_del.shiCubMet * inp_dxd_mfm.mfmCubMet;";
	
	
	//Llevamos las Maniobras al outbound
	//Anulamos el campo 
	$queries['a11111'] = "UPDATE fle_del
						SET outMan = 0
						WHERE per = '".$_SESSION['periodo'] ."';";
	
	//Agregamos las maniobras a nivel clave
	$queries['a1'] = "UPDATE fle_del
					INNER JOIN inp_dxd_mfm
					ON fle_del.solToPar = inp_dxd_mfm.shiToPar
					AND fle_del.per = '".$_SESSION['periodo'] ."'
					AND inp_dxd_mfm.per = '".$_SESSION['periodo'] ."'
					SET fle_del.outMan = fle_del.shiCubMet * (inp_dxd_mfm.man / inp_dxd_mfm.shiCubMet)";
					
	$resumenUrl = "Resumen: ";		
	foreach($queries as $descripcion => $querie){
		// echo "<hr>" . $querie;
		if(!$conexion->query($querie)){
			 $resumenUrl = $resumenUrl. "<br>Error: " . $descripcion . "=>" . $conexion->error . "<br>Query: " . $querie;
		}else{
			$resumenUrl = $resumenUrl. "<br>Exito: " . $querie;
		}
	}
?>