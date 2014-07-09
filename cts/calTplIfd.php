<? 
	error_reporting(E_ALL);
	
	if (session_status() == PHP_SESSION_NONE) {
    	session_start();
	}

	//Calculo Gastos Eventuales
	require('conexion.php');
	require('agrDatGen.php');
	$conexion = conexion();
	
	$queries = array();
	
	$qryDatGen['dc'] = "SELECT sum(fle_del.shiCubMet) AS 'Metros Cubicos Queretaro'
						FROM fle_del
						WHERE fle_del.shiPoi IN(4252, 4263, 4259)
						AND per = '" . $_SESSION['periodo'] . "'";
	
	// $qryDatGen['x1'] = "select sum(tplInb) AS 'tpl inb bm'
	// 					from fle_del
	// 					WHERE per = '" . $_SESSION['periodo'] . "'";
							
	// $qryDatGen['x2'] = "select sum(inb) AS 'tpl inb or'
	// 					from inp_3pl
	// 					WHERE per = '" . $_SESSION['periodo'] . "'";
	
	$datGen= agregarDatosGenerales($qryDatGen);
	
	$queries['a'] = "UPDATE inp_3pl
					SET inp_3pl.shiCubMet = (	
							SELECT sum(fle_del.shiCubMet)
									from fle_del
									WHERE fle_del.shiPoi = inp_3pl.shiPoi
									AND fle_del.per = '" . $_SESSION['periodo'] . "'
					)
					WHERE inp_3pl.shiNam NOT LIKE '%queretaro%'
					AND inp_3pl.per = '" . $_SESSION['periodo']  . "'";

$queries['aa'] = "UPDATE inp_3pl
					SET inp_3pl.shiCubMet = '" . $datGen['Metros Cubicos Queretaro'] . "'
					WHERE inp_3pl.shiNam LIKE '%queretaro%'
					AND inp_3pl.per = '" . $_SESSION['periodo'] . "' ";					
					
	$queries['b'] = "UPDATE inp_3pl
					SET shiCubMet = 0
					WHERE shiCubMet IS NULL
					AND per = '" . $_SESSION['periodo'] . "';";

	$queries['c'] = "UPDATE fle_del
					SET tplInb = 0
					WHERE per = '" . $_SESSION['periodo'] . "';";
	
	$queries['d'] = "UPDATE inp_3pl
					SET inbCaj = inb / cajDes
					WHERE inb > 0 AND cajDes > 0
					AND per = '" . $_SESSION['periodo'] . "';";
	
	$queries['e'] = "UPDATE inp_3pl
					SET inbCaj = 0
					WHERE inb = 0
					AND cajDes = 0
					AND per = '" . $_SESSION['periodo'] . "';";

	$queries['f'] = "UPDATE inp_3pl
					SET fijCubMet = fij / shiCubMet
					WHERE fij > 0 AND shiCubMet > 0
					AND per = '" . $_SESSION['periodo'] . "';";

	$queries['g'] = "UPDATE inp_3pl
	SET fijCubMet = 0
	WHERE fijCubMet IS NULL
	AND per = '" . $_SESSION['periodo'] . "'";

	$queries['gg'] = "UPDATE inp_3pl
	SET inbCaj = 0
	WHERE inbCaj IS NULL
	AND per = '" . $_SESSION['periodo'] . "'";
	
	//Hora de sacar datos fijos
	$queriesDatosGenerales = array();
	
	$queriesDatosGenerales['da'] = "SELECT sum(inb) AS 'Inbound Queretaro Toluca'
									FROM inp_3pl
									WHERE 
										(shiPoi LIKE '%4252%' OR
										shiPoi LIKE '%4259%' OR
										shiPoi LIKE '%4263%' OR
										shiPoi LIKE '%4251%')
									AND per = '" . $_SESSION['periodo'] . "';";

	$queriesDatosGenerales['db'] = "SELECT sum(cajDes) AS 'Cajas Descargadas Queretaro Toluca'
									FROM inp_3pl
									WHERE (shiPoi LIKE '%4252%' OR
										shiPoi LIKE '%4259%' OR
										shiPoi LIKE '%4263%' OR
										shiPoi LIKE '%4251%')
									AND per = '" . $_SESSION['periodo'] . "';";

	
	
	$datosGenerales = agregarDatosGenerales($queriesDatosGenerales);
	$inboundCaja = 0.0;
	$inboundCaja = $datosGenerales['Inbound Queretaro Toluca'] / $datosGenerales['Cajas Descargadas Queretaro Toluca'];
	
	$queries['h'] = "UPDATE fle_del
					SET tplInb = tplInb + (delQua * " . $inboundCaja . ")
					WHERE per = '" . $_SESSION['periodo'] . "';";

	$queries['i'] = "UPDATE fle_del
					SET tplInb = 0
					WHERE tplInb IS NULL
					AND per = '" . $_SESSION['periodo'] . "';";

	$queries['j'] = "UPDATE fle_del
					INNER JOIN inp_3pl
					ON FIND_IN_SET(fle_del.shiPoi, inp_3pl.shiPoi) > 0
					AND fle_del.shiPoi NOT IN (4252, 4259, 4263, 4251)
					AND fle_del.per = '" . $_SESSION['periodo'] . "'
					AND inp_3pl.per = '" . $_SESSION['periodo'] . "'
					SET fle_del.tplInb = fle_del.tplInb + (fle_del.delQua * inp_3pl.inbCaj);";
	
	$queries['k'] = "UPDATE fle_del
					SET tplFij = 0
					WHERE per = '" . $_SESSION['periodo'] . "';";
					
	$queries['l'] = "UPDATE fle_del
					INNER JOIN inp_3pl
					ON fle_del.shiPoi = inp_3pl.shiPoi
					AND fle_del.shiPoi NOT IN (4252, 4259, 4263)
					AND fle_del.per = '" . $_SESSION['periodo'] . "'
					AND inp_3pl.per = '" . $_SESSION['periodo'] . "'
					SET fle_del.tplFij = fle_del.shiCubMet * inp_3pl.fijCubMet;";

	$queries['m'] = "UPDATE fle_del
				INNER JOIN inp_3pl
				ON fle_del.shiPoi IN (4252, 4259, 4263)
				AND inp_3pl.shiPoi = 4252
				AND fle_del.per = '" . $_SESSION['periodo'] . "'
				AND inp_3pl.per = '" . $_SESSION['periodo'] . "'
				SET fle_del.tplFij = tplFij + (fle_del.shiCubMet *  fijCubMet);";

	
	

	//echo "<br>" . var_dump($datosGenerales);
	$resumenUrl = "Resumen: ";		
	foreach($queries as $descripcion => $querie){
		//echo "<br>" . $querie;
		if(!$conexion->query($querie)){
			 $resumenUrl = $resumenUrl. "<br>Error: " . $descripcion . "=>" . $querie;
		}else{
			$resumenUrl = $resumenUrl. "<br>Exito: " . $querie;
		}
	}

	//Sacamos la variacion, lo hacemos despues de todo el proceso ya que necesitamos tener alocado el Inbound en 3PL
	$qryDatGenPos = array();

	$qryDatGenPos['x1'] = "select sum(tplInb) AS 'tpl inb bm'
						from fle_del
						WHERE per = '" . $_SESSION['periodo'] . "'";
							
	$qryDatGenPos['x2'] = "select sum(inb) AS 'tpl inb or'
						from inp_3pl
						WHERE per = '" . $_SESSION['periodo'] . "'";

	$qryDatGenPos['dd'] = "SELECT sum(fle_del.shiCubMet) AS 'Metros Cubicos'
						FROM fle_del
						WHERE tplInb > 0
						AND per = '" . $_SESSION['periodo'] . "'";
	
	$datGenPos= agregarDatosGenerales($qryDatGenPos);

	//Rutina para el prorrateo de la Variación sobre las descargas
	$variacion = $datGenPos['tpl inb or'] - $datGenPos['tpl inb bm'];
	
	$variacionMetroCubico = $variacion / $datGenPos['Metros Cubicos'];
	
	$queriesPos['vtpli'] = "update fle_del
				set varTplInb = 0
				WHERE per = '" . $_SESSION['periodo'] . "';";
	
	$queriesPos['vtpli1'] = "update fle_del
				set varTplInb = shiCubMet * " . $variacionMetroCubico . "
				where tplInb > 0
				AND per = '" . $_SESSION['periodo'] . "';";
				
	echo "<hr><br>Variacion: " . $variacion;
	echo "<br>Metros Cubicos: " . $datGenPos['Metros Cubicos'];
	echo "<br>Variacion / M3: " . $variacionMetroCubico;

	foreach($queriesPos as $descripcion => $querie){
		//echo "<br>" . $querie;
		if(!$conexion->query($querie)){
			 $resumenUrl = $resumenUrl. "<hr>Error: " . $descripcion . "=>" . $querie;
		}else{
			$resumenUrl = $resumenUrl. "<hr>Exito: " . $querie;
		}
	}
	
?>