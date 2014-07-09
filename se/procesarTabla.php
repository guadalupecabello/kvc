<? 

	require('funciones.php');
	
	$resumenUrl = "";

	$conexion = conexion();

	$queries = array();

	$queries['Query 1'] = "UPDATE se_ejemplo
							SET c = 0
                            WHERE c IS NULL";

	// $queries['Query 2'] = "DELETE FROM se_ejemplo";

    $resumenUrl .= ejecutarQueries($conexion, $queries, 1);


?>