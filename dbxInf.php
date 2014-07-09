<?

require('funciones.php');

//Definimos la hora de inicio
error_reporting(E_ALL);

$inicio = obtenerHora();

$rutaArchivos = "";
$contrasena = "";

$local = esLocal();

//Definimos la ruta de acuerco al sistema para el LOAD DATA
if($local == true){
	// localhost
	$rutaArchivos = "C:/xampp/htdocs/kvc/s/php/files/";
}else{
	// KVC
	$rutaArchivos = "/var/www/kvc/s/php/files/";
	$contrasena = "yaniviendo";
}

$mensaje = "Resumen<br>";

//Extraemos las variables
extract($_REQUEST);

$resultado = array();

//Verificamos que las variables hayan sido inicializadas
if(
	isset($archivo) &
	isset($tabla)
){
	
	//Generamos la conexion
	$conexionId = mysqli_init();

	mysqli_options($conexionId, MYSQLI_OPT_LOCAL_INFILE, true);

	mysqli_real_connect($conexionId, '127.0.0.1', 'root',$contrasena,'cts') or die("Error de Conexi&oacute;n: " . mysqli_connect_errno() . "->" . mysqli_connect_error());
	
	//Limpiamos el repositorio
	$queryEliminar = "delete from " . $tabla;
	mysqli_query($conexionId, $queryEliminar);

	if(mysqli_error($conexionId)){
		$mensaje .= "<hr>Delete Error: " .  mysqli_error($conexionId);
	}
	
	//Realizamos la insercion del archivo
	$query = "load data local
			infile '" . $rutaArchivos . $archivo . "'
			into table " . $tabla . "
			fields terminated by ';'
			lines terminated by '\n'";
	//echo "<br>" . $query;

	// $mensaje .= "<hr>" . $queryEliminar;
	// $mensaje .= "<hr>" . $query;

	mysqli_query($conexionId, $query);
	
	$columnasAfectadas = mysqli_affected_rows($conexionId);

	if(mysqli_error($conexionId)){
		$mensaje = "<hr><b>Error en LOAD DATA:</b> " . mysqli_error($conexionId) . "<hr>" . $query;
	}

	
	$mensaje .= "<br>Registros agregados: " . $columnasAfectadas . "<br>";
	
	if($url != ''){

		$url = str_replace(" ", "", $url);
		require($url);
		//Adjuntamos al mensaje General la respuesta en texto del archivo de ejecucion
		$mensaje .= $resumenUrl;
		//$mensaje .= "<br>" . $url;
		//$mensaje .= $resumenUrl ;
	}


	//$mensaje .= "\nWarnings: ";
	
	//$warnings = mysqli_get_warnings($conexionId);
	
	/*echo $query;
	echo var_dump($warnings);*/
	
	
} else {
	//En caso de que no esten inicializadas no ejecutamos ninguna sentencia
	$mensaje .= "Error: Verifique llenar todos los campos<br>";
}

//Definimos la hora de termino
$final = obtenerHora();

//Obtenemos el tiempo de ejecucion
$tiempoEjecucion = obtenerTiempoEjecucion($inicio, $final);

$mensaje .= "<br>Tiempo de Ejecuci&oacute;n: " . $tiempoEjecucion;

//generamos la salida
$respuesta['respuesta'] = utf8_encode($mensaje);

echo json_encode($respuesta);

?>