<? 
	if (session_status() == PHP_SESSION_NONE) {
    	session_start();
	}

	require('conexion.php');
	$conexion = conexion();
	
	$queries = array();
	
	//Queries para la tarifa
	$queries['eliminarFletes'] = "DELETE FROM fletes
									WHERE per = '" . $_SESSION['periodo'] . "';";
	
	
	//Querie modificado el dia 270114 por acuerdo de la minuta del dia 240114
	//Agregamos un filtro para tomar solo los conceptos validos para el costo total de cada flete (ZMX1, ZMX2, ZMX3).
	$queries['insertarFletes'] = "INSERT INTO fletes(
										SELECT per, shiDocNum, sum(conVal), 0
										FROM tar_fle
										where (conTyp LIKE '%zmx1%'
										or conTyp LIKE '%zmx2%'
										or conTyp LIKE '%zmx3%')
										AND per = '" . $_SESSION['periodo'] . "'
										GROUP BY per, shiDocNum
									);";

	$queries['anularMetrosCubicosFletes'] = "UPDATE fletes
											SET cos = 0
											WHERE cos IS NULL
											AND per = '" . $_SESSION['periodo'] . "';";
								
								
	$queries['eliminarMetrosCubicosFletesMaestro'] = "DELETE FROM fle_cub_met
													WHERE per = '" . $_SESSION['periodo'] . "';";
	
	$queries['insertarMetrosCubicosFletesMaestro'] = "INSERT INTO fle_cub_met(
						SELECT per, shiDocNum, sum(shiCubMet)
						FROM fle_del
						WHERE per = '" . $_SESSION['periodo'] . "'
						GROUP BY per, shiDocNum
					);";

	/*$queries[''] = "";
	$queries[''] = "";
	$queries[''] = "";*/
								
	$queries['actulizarMetrosCubicosFletes'] = "UPDATE fletes
												INNER JOIN fle_cub_met
												ON fletes.shiDocNum = fle_cub_met.shiDocNum
												AND fletes.per = '" . $_SESSION['periodo'] . "'
												SET fletes.cubMet = fle_cub_met.shiCubMet;";


	$queries['anularMaestroTarifa'] = "UPDATE fle_del
										SET cosDel = 0
										WHERE per = '" . $_SESSION['periodo'] . "';";
										
	$queries['actulizarTarifaClave'] = "UPDATE fle_del
										INNER JOIN fletes
										ON fle_del.shiDocNum = fletes.shiDocNum
										AND fle_del.per = '" . $_SESSION['periodo'] . "'
										SET fle_del.cosDel= (fle_del.shiCubMet * (fletes.cos/fletes.cubMet));";
	
	
	$resumenUrl = "Detalles: ";	
	foreach($queries as $descripcion => $querie){
		if(!$conexion->query($querie)){
			 $resumenUrl = $resumenUrl . "<br>Error: " . $descripcion . "=>" . $conexion->error;
		}else{
			$resumenUrl = $resumenUrl . "<br>Exito: " . $querie;
		}
	}
	//echo $resumenUrl;

?>