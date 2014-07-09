<? 
	error_reporting(E_ALL);
	
	if (session_status() == PHP_SESSION_NONE) {
    	session_start();
	}

	require('conexion.php');
	$conexion = conexion();
	$queries = array();
	
	//Queries para el Inbound CIrcuitos	
	$queries['a'] = "UPDATE fle_del
						SET inbOri = 0
						WHERE per = '" . $_SESSION['periodo'] . "';";

	$queries['b'] = "UPDATE fle_del
						set plaSku = 380
						WHERE per = '" . $_SESSION['periodo'] . "';";

	$queries['c'] = "UPDATE fle_del
	INNER JOIN pla_sku
	ON fle_del.mat = pla_sku.sku
	AND fle_del.per = '" . $_SESSION['periodo'] . "'
	SET fle_del.plaSku = pla_sku.pla;";


	$queries['d'] = "DELETE FROM gas_tot_inb_ori
					WHERE per = '" . $_SESSION['periodo'] . "';";

	$queries['e'] = "INSERT INTO gas_tot_inb_ori(
		SELECT per, plaSku, 0, sum(shiCubMet), 0
			FROM fle_del
                        WHERE plaSku IS NOT NULL
            AND per = '" . $_SESSION['periodo'] . "'
			GROUP BY per, plaSku

	);";
	$queries['f'] = "UPDATE gas_tot_inb_ori
	SET gas_tot_inb_ori.gasTot = 
		(
				SELECT sum(inp_inb.gasTot)
					FROM inp_inb
					WHERE inp_inb.pla = gas_tot_inb_ori.pla
					AND inp_inb.per = '" . $_SESSION['periodo'] . "'
		)
	WHERE gas_tot_inb_ori.per = '" . $_SESSION['periodo'] . "';";


	$queries['g'] = "UPDATE gas_tot_inb_ori
	SET gasCubMet = gasTot / shiCubMet
	WHERE shiCubMet > 0
	AND per = '" . $_SESSION['periodo'] . "';";

	$queries['h'] = "UPDATE fle_del
	INNER JOIN gas_tot_inb_ori
	ON fle_del.plaSku = gas_tot_inb_ori.pla
	AND gas_tot_inb_ori.per = '" . $_SESSION['periodo'] . "'
	AND fle_del.per = '" . $_SESSION['periodo'] . "'
	SET fle_del.inbOri = fle_del.shiCubMet * gas_tot_inb_ori.gasCubMet;";
		
	$resumenUrl = "Resumen: ";		
	
	foreach($queries as $descripcion => $querie){
		if(!$conexion->query($querie)){
			 $resumenUrl = $resumenUrl. "<br>Error: " . $descripcion . "=>" . $querie;
		}else{
			$resumenUrl = $resumenUrl. "<br>Exito: " . $querie;
		}
	}
	
?>