<? 	
	error_reporting(E_ALL);
	if (session_status() == PHP_SESSION_NONE) {
    	session_start();
	}

	require('../conexion.php');
	require('../agrDatGen.php');
	$conexion = conexion();
	
	
	$queries = array();

	$queriesDatosGenerales = array();
	
	//Limpiamos y actualizamos el repositorio para venta de cajas por Cedis y Sku
	$queries['a'] = "delete from cos_alm_ven_sku
					WHERE per = '" . $_SESSION['periodo'] . "';";
	
	$queries['b'] = "insert into cos_alm_ven_sku(
		select per, shiPoi, mat, sum(delQua)
		from fle_del
		WHERE per = '" . $_SESSION['periodo'] . "'
		group by per, shiPoi, mat
	);";
	
	//Atualizamos la tabla de inventario promedio con la venta de cada Sku por Cedis
	$queries['c'] = "UPDATE cos_alm
	inner join cos_alm_ven_sku
	on cos_alm.shiPoi = cos_alm_ven_sku.shiPoi 
	AND cos_alm.sku = cos_alm_ven_sku.sku
	AND cos_alm.per = '" . $_SESSION['periodo'] . "'
	AND cos_alm_ven_sku.per = '" . $_SESSION['periodo'] . "'
	set cos_alm.ven = cos_alm_ven_sku.ven;";
	
	$queries['d'] = "UPDATE cos_alm
			SET ven = 0
			WHERE ven IS NULL
			AND per = '" . $_SESSION['periodo'] . "';";
			
	//Agregamos la Estiba y el Estandar
	$queries['e'] = "UPDATE cos_alm
		INNER JOIN sku_ren
		ON 	cos_alm.sku = sku_ren.sku
		AND cos_alm.per = '" . $_SESSION['periodo'] . "'
		AND sku_ren.per = '" . $_SESSION['periodo'] . "'
		SET 	cos_alm.estIba = sku_ren.estIba,
				cos_alm.estAnd = sku_ren.estAnd
		;";
	
	$queries['f'] = "update cos_alm
		set estIba = 0
		where estIba is null
		AND per = '" . $_SESSION['periodo'] . "'";
		
	$queries['g'] = "update cos_alm
		set estAnd = 0
		where estAnd is null
		AND per = '" . $_SESSION['periodo'] . "'";

	//Calculamos los dias de inventario, costo por caja y el costo de almacenaje
	$queries['h'] = "UPDATE cos_alm
		INNER JOIN cos_alm_fac
		ON cos_alm.shiPoi = cos_alm_fac.shiPoi 
		AND cos_alm.pro > 0
		AND cos_alm.ven > 0
		AND cos_alm.per = '" . $_SESSION['periodo'] . "'
		AND cos_alm_fac.per = '" . $_SESSION['periodo'] . "'
		SET diaInv = (30 * (pro / ven)),
			cosCaj = ((cos_alm_fac.facOcu / (estAnd * estIba)) * cos_alm_fac.cosRen/ 30),
			cosAlm = ((30 * (pro / ven))) * ((cos_alm_fac.facOcu/(estIba * estAnd) * (cos_alm_fac.cosRen/30)))";

	$queries['i'] = "UPDATE cos_alm
		INNER JOIN cos_alm_fac
		ON cos_alm.shiPoi = cos_alm_fac.shiPoi AND ven = 0 AND pro > 0
		AND cos_alm.per = '" . $_SESSION['periodo'] . "'
		AND cos_alm_fac.per = '" . $_SESSION['periodo'] . "'
		SET 	diaInv = 30,
				cosCaj = ((cos_alm_fac.facOcu / (estAnd * estIba)) * cos_alm_fac.cosRen/30),
				cosAlm = 30 * ((cos_alm_fac.facOcu/(estIba * estAnd) * (cos_alm_fac.cosRen/30)));";

	$queries['j'] = "UPDATE cos_alm
		SET 	diaInv = 0,
				cosCaj = 0,
				cosAlm = 0
		WHERE pro = 0 OR pro IS null OR (estIba = 0 AND estAnd = 0)
		AND per = '" . $_SESSION['periodo'] . "';";

	//Bajamos a nivel clave multiplicando las Cajas Facturadas por El costo de almacenaje dependiendo el Sku y el Numero de Planta
	$queries['k'] = "UPDATE fle_del
					SET ren = 0
					WHERE per = '" . $_SESSION['periodo'] . "';";
	
	$queries['l'] = "UPDATE fle_del
	inner join cos_alm
	on fle_del.shiPoi = cos_alm.shiPoi 
	AND fle_del.per = '" . $_SESSION['periodo'] . "'
	AND cos_alm.per = '" . $_SESSION['periodo'] . "'
	and fle_del.mat = cos_alm.sku
	set fle_del.ren = fle_del.delQua * cos_alm.cosAlm;";
	
	//Se asigna el costo de almacenaje de Queretaro al 100% a los Skus del Resto de los Cedis siempre y cuando no sean Queretaro mismo ni Toluca o Citi Park
	$queries['m'] = "update fle_del
	inner join cos_alm
	on fle_del.shiPoi not in (4252, 4251, 4259)
	AND fle_del.per = '" . $_SESSION['periodo'] . "'
	AND cos_alm.per = '" . $_SESSION['periodo'] . "'
	and (fle_del.mat = cos_alm.sku and cos_alm.shiPoi = 4252)
	set fle_del.ren = fle_del.ren + (fle_del.delQua * cos_alm.cosAlm);";
	
	//Se asigna el costo de almacenaje de Queretaro al 10% a los Skus de Toluca y Citi Park
	$queries['n'] = "update fle_del
	inner join cos_alm
	on fle_del.shiPoi in (4251, 4259)
	AND fle_del.per = '" . $_SESSION['periodo'] . "'
	AND cos_alm.per = '" . $_SESSION['periodo'] . "'
	and (fle_del.mat = cos_alm.sku and cos_alm.shiPoi = 4252)
	set fle_del.ren = fle_del.ren + (fle_del.delQua * (cos_alm.cosAlm * 0.1));";
	
	$queries['p'] = "DELETE FROM ren_cub_met
					WHERE per = '" . $_SESSION['periodo'] . "';";
	
	$queries['q'] = "INSERT INTO ren_cub_met(
						select per, shiPoi, sum(shiCubMet)
						from fle_del
						where per = '" . $_SESSION['periodo'] . "'
						and ren > 0
						group by per, shiPoi
					)";

	$queries['r'] = "UPDATE ren_imp_ben
					INNER JOIN ren_cub_met
					on ren_imp_ben.shiPoi = ren_cub_met.shiPoi
					and ren_imp_ben.per = '" . $_SESSION['periodo'] . "'
					and ren_cub_met.per = '" . $_SESSION['periodo'] . "'
					SET ren_imp_ben.shiCubMet = ren_cub_met.shiCubMet;";

	$queries['s'] = "UPDATE ren_imp_ben
					SET impBenCubMet = val / shiCubMet
					WHERE per = '" . $_SESSION['periodo'] . "';";

	$queries['ss'] = "UPDATE ren_imp_ben
					SET impBenCubMet = 0
					WHERE per = '" . $_SESSION['periodo'] . "'
					AND impBenCubMet IS NULL;";

	$queries['uu'] = "UPDATE fle_del
					SET renImpBen = 0
					WHERE per = '" . $_SESSION['periodo'] . "'";

	$queries['t'] = "UPDATE fle_del
					INNER JOIN ren_imp_ben
					ON fle_del.shiPoi = ren_imp_ben.shiPoi
					and fle_del.per = '" . $_SESSION['periodo'] . "'
					and ren_imp_ben.per = '" . $_SESSION['periodo'] . "'
					and fle_del.ren > 0
					set fle_del.renImpBen = fle_del.shiCubMet * ren_imp_ben.impBenCubMet;";

	$queries['u'] = "UPDATE fle_del
					SET renImpBen = 0
					WHERE renImpBen IS NULL
					AND per = '" . $_SESSION['periodo'] . "'";
	
	//echo "<br>Costo Renta: " . $datosGenerales['Costo Renta'];
	//echo "<br>Impactos Beneficios: " . $datosGenerales['Imp Ben'];
	//echo "<br>Renta Base Maestra: " . $datosGenerales['Renta Base Maestra'];
	//echo "<br>Metros Cubicos: " . $datosGenerales['Metros Cubicos'];
	//echo "<br>Capacidad Operativa: " . $capacidadOperativa;
	//echo "<br>Costo Operacion Por Caja: " . $costoOperacionCaja;
	
	$resumenUrl = "Resumen: ";		
	
	foreach($queries as $descripcion => $querie){
		//echo "<br>" . $querie;
		if(!$conexion->query($querie)){
			 $resumenUrl = $resumenUrl. "<br>Error: " . $descripcion . "=>" . $querie;
		}else{
			$resumenUrl = $resumenUrl. "<br>Exito: " . $querie;
		}
	}


	$queriesDatosGenerales = array();
	
	$queriesDatosGenerales['a'] = "SELECT sum(ren) AS 'Renta Base Maestra'
									FROM fle_del
									WHERE per = '" . $_SESSION['periodo'] . "';";
									
	$queriesDatosGenerales['b'] = "SELECT val AS  'Costo Renta'
									FROM var_ent
									WHERE nom like 'cosRen'
									AND per = '" . $_SESSION['periodo'] . "';";
									
	$queriesDatosGenerales['c'] = "SELECT val AS  'Imp Ben'
									FROM var_ent
									WHERE nom like 'renInpBen'
									AND per = '" . $_SESSION['periodo'] . "';";
									
	$queriesDatosGenerales['d'] = "SELECT sum(shiCubMet) AS 'Metros Cubicos'
									FROM fle_del
									WHERE ren > 0					
									AND per = '" . $_SESSION['periodo'] . "';";

	$queriesDatosGenerales['e'] = "SELECT sum(renImpBen) AS 'Impactos Beneficios Base Maestra'
								FROM fle_del
								WHERE renImpBen > 0					
								AND per = '" . $_SESSION['periodo'] . "';";
	
	$datosGenerales = agregarDatosGenerales($queriesDatosGenerales);

	$costoOperacionCaja = 0.0;

	$impactosBeneficios = 0;

	if($datosGenerales['Impactos Beneficios Base Maestra'] < 0){
		$impactosBeneficios = $datosGenerales['Impactos Beneficios Base Maestra'];
	}
	
	$capacidadOperativa = ($datosGenerales['Costo Renta'] + $impactosBeneficios) - $datosGenerales['Renta Base Maestra'];
	
	$costoOperacionCaja = $capacidadOperativa / $datosGenerales['Metros Cubicos'];	

	$resumenUrl .= "<hr><b>Costo Renta: </b>: " . $datosGenerales['Costo Renta'];
	$resumenUrl .= "<br><b>Imp Ben: </b>: " . $datosGenerales['Impactos Beneficios Base Maestra'];
	$resumenUrl .= "<br><b>Renta BM</b>: " . $datosGenerales['Renta Base Maestra'];
	$resumenUrl .= "<hr><b>Cap Ope: </b>: " . $capacidadOperativa;
	$resumenUrl .= "<br><b>Costo Ope Por Caj</b>: " . $costoOperacionCaja;
	$resumenUrl .= "<br><b>M3</b>: " . $datosGenerales['Metros Cubicos'];

	$queriesPos = array();

	$queriesPos['oo'] = "UPDATE fle_del
						SET renCapOpe = 0
						WHERE per = '" . $_SESSION['periodo'] . "';";
						
	$queriesPos['ooo'] = "UPDATE fle_del
						SET renCapOpe = shiCubMet * " . $costoOperacionCaja . "
						WHERE ren > 0
						AND per = '" . $_SESSION['periodo'] . "';";
	
	foreach($queriesPos as $descripcion => $querie){
		if(!$conexion->query($querie)){
			 $resumenUrl = $resumenUrl. "<hr>Error: " . $descripcion . "=>" . $querie;
		}else{
			$resumenUrl = $resumenUrl. "<hr>Exito: " . $querie;
		}
	}				

?>