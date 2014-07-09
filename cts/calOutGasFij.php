<? 
	//Calculo Gastos Eventuales
	require('conexion.php');

	if (session_status() == PHP_SESSION_NONE) {
    	session_start();
	}

	if(function_exists('agregarDatosGenerales')){
		
	}else{
		require('agrDatGen.php');
	}
	
	$conexion = conexion();
	
	$queriesDatosGenerales = array();
	$queriesDatosGenerales['metrosCubicos'] = "SELECT sum(shiCubMet) AS 'Metros Cubicos'
												FROM fle_del
												WHERE per = '" . $_SESSION['periodo'] . "';";
	$queriesDatosGenerales['montoFijos'] = "SELECT sum(mon) AS 'Monto Fijos'
											FROM inp_fij_out_bou
											WHERE shiToPar LIKE '0'
											AND per = '" . $_SESSION['periodo'] . "';";

	$datosGenerales = agregarDatosGenerales($queriesDatosGenerales);
	
	$queries = array();
	
	$queries['Input Procesado'] = "UPDATE inp_fij_out_bou
					SET inp_fij_out_bou.shiCubMet = 0
					WHERE per = '" . $_SESSION['periodo'] . "';";

	$queries['Calculo de Metros Cubicos'] = "UPDATE inp_fij_out_bou
					SET inp_fij_out_bou.shiCubMet = (
						SELECT sum(fle_del.shiCubMet)
							FROM fle_del
							WHERE FIND_IN_SET(fle_del.shiToPar, inp_fij_out_bou.shiToPar) > 0
							AND fle_del.per = '" . $_SESSION['periodo'] . "'
					)
					WHERE inp_fij_out_bou.shiToPar NOT LIKE '0'
					AND inp_fij_out_bou.per = '" . $_SESSION['periodo'] . "';";

	$queries['Agregado de Metros Cubicos al Input'] = "UPDATE inp_fij_out_bou
					SET fijCubMet = 0
					WHERE per = '" . $_SESSION['periodo'] . "';";

	$queries['Calculo de Gastos Fijos por Metro Cubico'] = "UPDATE inp_fij_out_bou
					SET fijCubMet = mon / shiCubMet
					WHERE shiToPar NOT LIKE '0'
					AND shiCubMet > 0
					AND per = '" . $_SESSION['periodo'] . "';";

	$queries['Preparado de Base Maestra'] = "UPDATE fle_del
					SET fle_del.fijOutBou = 0
					WHERE per = '" . $_SESSION['periodo'] . "';";

	$queries['Prorrateo a Base Maestra'] = "UPDATE fle_del
					INNER JOIN inp_fij_out_bou
					ON inp_fij_out_bou.shiToPar NOT LIKE '0'
					AND fle_del.per = '" . $_SESSION['periodo'] . "'
					AND inp_fij_out_bou.per = '" . $_SESSION['periodo'] . "'
					AND FIND_IN_SET(fle_del.shiToPar, inp_fij_out_bou.shiToPar)
					SET fle_del.fijOutBou = fle_del.fijOutBou + (fle_del.shiCubMet * inp_fij_out_bou.fijCubMet);";

	$fijoMetroCubico = 0.0;
	$fijoMetroCubico = $datosGenerales['Monto Fijos'] / $datosGenerales['Metros Cubicos'];
	
	$queries['Prorrateo de Gastos Fijos Generales'] = "UPDATE fle_del
					SET fijOutBou = fijOutBou + (shiCubMet * " . $fijoMetroCubico . ")
					WHERE per = '" . $_SESSION['periodo'] . "';";

	//echo "<br>" . var_dump($datosGenerales);
	$resumenUrl = "Resumen: ";		
	foreach($queries as $descripcion => $querie){
		//echo "<br>" . $querie;
		if(!$conexion->query($querie)){
			 $resumenUrl = $resumenUrl. "<br>Error: " . $descripcion . "=>" . $conexion->error . "<br>Query: " . $querie;
		}else{
			$resumenUrl = $resumenUrl. "<br>Exito: " . $querie;
		}
	}
	
?>