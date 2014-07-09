<? 
	if (session_status() == PHP_SESSION_NONE) {
    	session_start();
	}

	require('conexion.php');
	require('agrDatGen.php');
	
	$conexion = conexion();
	
	//Actualizacion necesaria al inicio
	$conexion->query("UPDATE inp_ovh
					SET totCta = (actCur * por) + sum
					WHERE per = '" . $_SESSION['periodo']. "'");
	
	
	//Obtenemos los datos que seran estaticos
	$queriesDatosGenerales = array();
	$queriesDatosGenerales['numeroOxxos'] = "select count(distinct(pay)) AS 'Numero Oxxos'
											from fle_del
											where payNam like '%oxxo%'
											AND per = '" . $_SESSION['periodo']. "'";
	
	$datosGenerales = agregarDatosGenerales($queriesDatosGenerales);
	
	
	$queries['actualizarOverheadCuentasEspeciales'] = "UPDATE fle_del
						SET ovhCtaEsp = 0
						WHERE per = '" . $_SESSION['periodo']. "'";
	
	$cuentas = array();
	
	$qry = "SELECT cta AS 'cuenta'
			FROM inp_ovh
			WHERE cta > 0
			AND per = '" . $_SESSION['periodo']. "';";
						
	$resultado = $conexion->query($qry);
	$resultado->fetch_assoc();

	//Obtenemos las cuentas
	foreach($resultado as $clave => $valor){
		foreach($valor as $c => $v){
			$cuentas[$c . $clave] = $v;
		}
	}
	//echo "<br>Cuentas: " . var_dump($cuentas);
	
	//Por cada cuenta se ejecutaran ciertos queries
	foreach($cuentas as $clave => $valor){
		
		$totales = array();
		//Obtenemos el total de la cuenta
		$qry = "SELECT ((actCur + sum) - ((actCur + sum)*por)) AS 'Total'
				FROM inp_ovh
				WHERE cta = '" . $valor . "'
				AND per = '" . $_SESSION['periodo']. "';";
		//echo "<br>Qry:" . $qry;
							
		$resultado = $conexion->query($qry);
		$resultado->fetch_assoc();
	
		//Obtenemos las cuentas
		foreach($resultado as $c => $v){
			foreach($v as $cc => $vv){
				$totales[$cc] = $vv;
			}
		}
		//echo "<br>";
		//echo "<br>Totales: " . var_dump($totales);
		//echo "<br>Cuenta: " . $valor . ", Total: " . $totales['Total'];
		
		$queries['eliminarPrecioKilo' . $valor ] = "DELETE FROM pre_kil_cta_esp
													WHERE per = '" . $_SESSION['periodo']. "';";
		$queries['insertarPrecioKilo' . $valor] = "INSERT INTO pre_kil_cta_esp(
														SELECT f.per, f.payNam, SUM(f.shiKil), 0, 0
														FROM fle_del f
														WHERE f.per = '" . $_SESSION['periodo']. "'
														GROUP BY f.per, f.payNam
													);";
													
		$queries['actualizarPorcentajes' . $valor] = "UPDATE pre_kil_cta_esp
						SET pre_kil_cta_esp.porCtaEsp =  
							(
								SELECT SUM(por) 
										FROM cta_esp 
										WHERE cta_esp.payNam = pre_kil_cta_esp.payNam 
										AND	cta_esp.payNam NOT LIKE '%otros%'
										AND cta_esp.cta = '" . $valor . "'
										
							)
						WHERE pre_kil_cta_esp.per = '" . $_SESSION['periodo']. "';";
		
		
		//El porcentaje de aquellos Payers que no aparecen se ajustan hacia OTROS
		$qry = array();
		$qry['a'] = "SELECT 1 - sum(porCtaEsp) AS 'Porcentaje Otros'
					FROM pre_kil_cta_esp
					WHERE payNam NOT LIKE '%otros%'
					AND per = '" . $_SESSION['periodo']. "'";

		$datGenTem = agregarDatosGenerales($qry);
		echo "<br>" . var_dump($datGenTem);
		
		$queries['actualizarOtros' . $valor] = "UPDATE pre_kil_cta_esp
										SET porCtaEsp = " . $datGenTem['Porcentaje Otros'] . "
										WHERE payNam LIKE '%otros%'
										AND per = '" . $_SESSION['periodo']. "';";
		
		$queries['actualizarCostoPorKilo' . $valor] = "UPDATE pre_kil_cta_esp
						SET cosKil = (" . $totales['Total'] . " * porCtaEsp) / kil
						WHERE per = '" . $_SESSION['periodo']. "';";
						
		$queries['actualizarOverheadCuentasEspecialesMaestro' . $valor] = "UPDATE fle_del
						INNER JOIN pre_kil_cta_esp
						ON fle_del.payNam = pre_kil_cta_esp.payNam
						AND fle_del.per = '" . $_SESSION['periodo']. "'
						AND pre_kil_cta_esp.per = '" . $_SESSION['periodo']. "'
						SET fle_del.ovhCtaEsp = fle_del.ovhCtaEsp +(fle_del.shiKil * pre_kil_cta_esp.cosKil);";
		//echo $queries['a'] = "<br>--------------------------------------------------------------------------------------------------------------------------------------------";}
	}
	
	//$queries[''] = "";
	
	$resumenUrl = "Resumen: ";		
	foreach($queries as $descripcion => $querie){
		//echo "<br><br> " . $querie;
		if(!$conexion->query($querie)){
			 $resumenUrl = $resumenUrl. "<br>Error: " . $descripcion . " => " . $querie;
		}else{
			$resumenUrl = $resumenUrl. "<br>Exito: " . $querie;
		}
	}
	
	?>