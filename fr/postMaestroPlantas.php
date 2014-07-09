<? 

	require('funciones.php');
	
	verificarSesion();

	// $periodo = '2014-06';
	$conexion = conexion();

	$resumenUrl = "";

	if($periodo){

		$queries = array();

		$resumenUrl .= registrarEvento($conexion, $_SESSION['periodo'], 'Admin', 'fr_mae_pla');

		// $resumenUrl .= ejecutarQueries($conexion, $queries, 1);

	} else {

		$resumenUrl .= "<br><b>Periodo No definido</b>";
		
	}


?>