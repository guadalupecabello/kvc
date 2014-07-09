<?

require('funciones.php');
//Definimos la hora de inicio
error_reporting(E_ALL);

$inicio = obtenerHora();

$mensaje = "Resumen\n";

//Extraemos las variables
extract($_REQUEST);

$resultado = array();

$local = esLocal();

//Definimos las variables de acuerdo al sistema Servidor
$ruta = "";
$contrasena = "";

if($local ==true){

	$ruta = "C:/xampp/htdocs/kvc/s/php/files/";

}else{

	$ruta = "/var/www/kvc/s/php/files/";
	$contrasena = "yaniviendo";
}

//Verificamos que las variables hayan sido inicializadas
if(
	isset($archivo) &
	isset($tabla)
){
	
	//Generamos la conexion
	$conexionId = mysqli_init();
	mysqli_options($conexionId, MYSQLI_OPT_LOCAL_INFILE, true);
	mysqli_real_connect($conexionId, '127.0.0.1', 'root', $contrasena, 'kvirtualcenter') or die("Error de Conexi&oacute;n: " . mysqli_connect_errno() . "->" . mysqli_connect_error());
	
	//Limpiamos el repositorio
	$queryEliminar = "delete from " . $tabla;
	mysqli_query($conexionId, $queryEliminar);
	
	//Realizamos la insercion del archivo
	$query = "load data local
			infile '" . $ruta . $archivo . "'
			into table " . $tabla . "
			fields terminated by ';'
			lines terminated by '\n'";
	//echo "<br>" . $query;
	mysqli_query($conexionId, $query);
	
	$columnasAfectadas = mysqli_affected_rows($conexionId);
	
	$mensaje .= "\nRegistros agregados: " . $columnasAfectadas;
	
	$mensaje .= "\nWarnings: ";
	
	$warnings = mysqli_get_warnings($conexionId);
	echo $query;
	echo var_dump($warnings);
	
	
} else {
	
	//En caso de que no esten inicializadas no ejecutamos ninguna sentencia
	$mensaje .= "\nError: Verifique llenar todos los campos";
}


//Definimos la hora de termino
$final = obtenerHora();

$tiempoEjecucion = obtenerTiempoEjecucion($inicio, $final);

$mensaje .= "\nTiempo de ejecuci&oacute;n: " . $tiempoEjecucion;

//generamos la salida
$resultado['resumen'] = utf8_encode($mensaje);

echo json_encode($resultado);

?>