<? 

session_start();

require('../funciones.php');

$conexion = conexion();
//$_POST['query']= "SELECT mat FROM fle_del GROUP BY mat ORDER BY mat";
$querySumas =  $_POST['querySumas'];
$query = $_POST['query'];

//Para los datos
$datos = array();

//Sumatorias
$resultado;

if(!$resultado = $conexion->query($querySumas)){

	echo "\n" . $conexion->error;

}

if($resultado->num_rows > 0){
	
	//echo "<br>Informacion de la consulta: " + var_dump($resultado);
	$columnas = $resultado->field_count;
	//echo "<br>Columnas: " . $columnas;
	while($fila = $resultado->fetch_assoc()){
		//echo var_dump($fila)."<br>";
		//echo "<br>Informaci&oacute;n de la fila <br>";
		//echo var_dump($fila);
		//echo "<br>Datos<br>".$fila[0] . ", " . $fila[1];
		foreach ($fila as $i => $value) {
			$fila[$i] = utf8_encode($fila[$i]);
		}
		//$fila[0] = utf8_encode($fila[0]);
		//$fila[1] = utf8_encode($fila[1]);
		
		array_push($datos, $fila);
	}
	
	//echo json_encode($datos);
	
}

//Detalle
$resultado = $conexion->query($query);
if($resultado->num_rows > 0){
	
	//echo "<br>Informacion de la consulta: " + var_dump($resultado);
	$columnas = $resultado->field_count;
	//echo "<br>Columnas: " . $columnas;
	
	
	while($fila = $resultado->fetch_assoc()){
		//echo var_dump($fila)."<br>";
		//echo "<br>Informaci&oacute;n de la fila <br>";
		//echo var_dump($fila);
		//echo "<br>Datos<br>".$fila[0] . ", " . $fila[1];
		foreach ($fila as $i => $value) {
			$fila[$i] = utf8_encode($fila[$i]);
		}
		//$fila[0] = utf8_encode($fila[0]);
		//$fila[1] = utf8_encode($fila[1]);
		
		array_push($datos, $fila);
	}
	
	echo json_encode($datos);
	
} else {
	
	
	
}



?>