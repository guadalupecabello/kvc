<? 
	
	require('funciones.php');
	verificarSesion();
	$resumenUrl = "";
	
	$conexion = conexion();

	if($periodo){

		$queries = array();

		//Eliminamos el contenido del Case Fill
		$queries['Limpiando Resuemen Concentrado'] = "delete from fr_con_agr WHERE per = '" . $_SESSION['periodo'] . "';";

		$queries['Actualizando Resuemen Concentrado'] = "insert into fr_con_agr(
							select '" . $_SESSION['periodo'] . "', c4, c21, c20, c19, c18, c24, c22, c23, sum(c15), sum(c16), sum(c17), matGro5, matGro5Des, porEjeOm, porEjeTra, porCooOpe, porCalCen, porCooTra, porEjeCpf, porEjeRep, porDemPla, porLidCal, ejeOm, ejeTra, cooOpe, calCen, cooTra, ejeCpf, ejeRep, demPla, lidCal
						        from fr_con_mod
						        group by c4, c21, c20, c19, c18, c24, c22, c23
						);";
		
		$resumenUrl .= ejecutarQueries($conexion, $queries, 1);

		$resumenUrl .= registrarEvento($conexion, $_SESSION['periodo'], 'Admin', 'fr_con_mod');

	} else {

		$resumenUrl .= "<br><b>Periodo No definido</b>";

	}


?>