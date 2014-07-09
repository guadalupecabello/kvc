<? 
	if (session_status() == PHP_SESSION_NONE) {
    	session_start();
	}

	require('conexion.php');
	$conexion = conexion();
	$queries = array();
	
	$queries['a'] = "DELETE FROM gas_tot_inb_des
					WHERE per = '" . $_SESSION['periodo'] . "';";

	$queries['b'] = "INSERT INTO gas_tot_inb_des(
					SELECT per, shiPoi, 0, sum(shiCubMet), 0
					FROM fle_del
					WHERE shiPoi NOT IN(4252, 4271, 4281, 4280, 4273)
					AND per = '" . $_SESSION['periodo'] . "'
					GROUP BY per, shiPoi
	);";

	$queries['c'] = "INSERT INTO gas_tot_inb_des(		
					SELECT per,'4252', 0, sum(shiCubMet), 0
				FROM fle_del
				WHERE shiPoi IN(4252, 4271, 4281, 4280, 4273)
				AND per = '" . $_SESSION['periodo'] . "'
				GROUP BY per, '4252'
	);";

	$queries['d'] = "UPDATE gas_tot_inb_des
	SET gas_tot_inb_des.gasTot = 
		(
				SELECT sum(inp_inb.gasTot)
					FROM inp_inb
					WHERE inp_inb.per = '" . $_SESSION['periodo'] . "'
					AND inp_inb.shiPoi = gas_tot_inb_des.shiPoi
                                        AND (inp_inb.pla = 0 
                                        	OR inp_inb.pla IS NULL
										)
		)
	WHERE gas_tot_inb_des.per = '" . $_SESSION['periodo'] . "';";


	$queries['e'] = "UPDATE gas_tot_inb_des
	SET gasCubMet = gasTot / shiCubMet
	WHERE shiCubMet > 0
	AND gasTot IS NOT NULL
	AND per = '" . $_SESSION['periodo'] . "';";

	$queries['f'] = "UPDATE fle_del
	SET inbDes = 0
	WHERE per = '" . $_SESSION['periodo'] . "';";

	$queries['g'] = "UPDATE fle_del
	INNER JOIN gas_tot_inb_des
	ON fle_del.shiPoi = gas_tot_inb_des.shiPoi
	AND fle_del.per = '" . $_SESSION['periodo'] . "'
	AND gas_tot_inb_des.per = '" . $_SESSION['periodo'] . "'
	SET fle_del.inbDes = fle_del.shiCubMet * gas_tot_inb_des.gasCubMet;";
	
	$resumenUrl = "Resumen: ";		
	
	foreach($queries as $descripcion => $querie){
		if(!$conexion->query($querie)){
			$resumenUrl = $resumenUrl. "<br>Error: " . $descripcion . "=>" . $querie;
		}else{
			$resumenUrl = $resumenUrl. "<br>Exito: " . $querie;
		}
	}
	
?>