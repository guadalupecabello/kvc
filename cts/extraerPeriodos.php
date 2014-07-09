<?

	require('../funciones.php');
	validarLogin();
	$conexion = conexion();
	$queries = array();
	$queryPeriodos = 'SELECT per FROM periodos ORDER BY per DESC';
	echo obtenerQueryToJson($conexion, $queryPeriodos);

?>