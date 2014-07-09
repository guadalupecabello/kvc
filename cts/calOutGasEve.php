<? 
	
	if (session_status() == PHP_SESSION_NONE) {
    	session_start();
	}

	//Calculo Gastos Eventuales
	require('conexion.php');

	$conexion = conexion();
	
	$queries = array();
	
	$queries['Limpiado de repositorios'] = "DELETE FROM del_cub_met
											WHERE per = '" . $_SESSION['periodo'] ."';";
	
	$queries['Actualizacion de Repositorios'] = "INSERT INTO del_cub_met(
						SELECT per, del, sum(shiCubMet)
						FROM fle_del
						WHERE per = '" . $_SESSION['periodo'] ."'
						GROUP BY per, del
					);";
	
	$queries['Pivote de Bitacora'] = "DELETE FROM gas_eve_piv
										WHERE per = '" . $_SESSION['periodo'] ."';";
					
	$queries['Actualizacion de Pivotes'] = "INSERT INTO gas_eve_piv(
						SELECT per, del, sum(tot), 0
							FROM gas_eve
							WHERE per = '" . $_SESSION['periodo'] ."'
							GROUP BY del
					)";
					
	$queries['Actualizacion de Metros Cubicos por Delivery'] = "UPDATE gas_eve_piv
					INNER JOIN del_cub_met
					ON gas_eve_piv.del = del_cub_met.del
					AND gas_eve_piv.per = '" . $_SESSION['periodo'] ."'
					SET gas_eve_piv.shiCubMet = del_cub_met.shiCubMet;";
					

	$queries['Preparado de Base Maestra'] = "UPDATE fle_del
					SET fle_del.gasEve = 0
					WHERE per = '" . $_SESSION['periodo'] ."';";
	
	$queries['Prorrateo a Base Maestra'] = "UPDATE fle_del
					INNER JOIN gas_eve_piv
					ON fle_del.del = gas_eve_piv.del
					AND fle_del.per = '" . $_SESSION['periodo'] ."'
					SET fle_del.gasEve = fle_del.shiCubMet * (gas_eve_piv.tot / gas_eve_piv.shiCubMet);";
	
	$resumenUrl = "Resumen: ";		
	foreach($queries as $descripcion => $querie){
		if(!$conexion->query($querie)){
			 $resumenUrl = $resumenUrl. "<br>Error: " . $descripcion . "->" . $conexion->error;
		}else{
			$resumenUrl = $resumenUrl. "<br>Exito: " . $querie;
		}
	}
	
?>