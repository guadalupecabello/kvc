<?
session_start();
error_reporting(E_ALL);
//error_reporting(E_ALL ^ E_NOTICE);
//Extraemos variables
extract($_POST);
require('../funciones.php');
//$archivo = "RTA Inventario Promedio.xls";
$tabla = "cos_alm";
$columnasVacias = 6;
$registrosError= "";
//$url = "calTplRen.php";
//Creamos la conexion
$conexion = conexion();
if($conexion->connect_errno){
	die("Error Con la conexión");
}

//Importamos libreria
require_once '../per/excel_reader2.php';

//Procesamos el Archivo
$data = new Spreadsheet_Excel_Reader("../s/php/files/" . $archivo . "", false);
if(!$data){
	die("Error Cargando Excel!!!");
}

//Hacemos el conteo de columnas
$columnas = 1;
while($data->val(1, $columnas, 0)){
	//echo "<br>Col: ".$columnas.", ".$data->val(1, $columnas, 0);
	$columnas++;
}
//echo "<br>Columnas: " . $columnas . "<br>";
//Verificamos la cantidad de registros
$registros = count($data->sheets[0]['cells']);

//Eliminamos el repositorio
$queryEliminacion = "DELETE FROM " . $tabla . " WHERE per = '" . $per . "'";

$conexion->query($queryEliminacion);

$query = "INSERT INTO cos_alm VALUES ('" . $per . "', ";
$registro = "";

for($i = 2; $i <= $registros; $i++){
	
	$shiPoi = $data->val($i, 1, 0)."";
	$sku = $data->val($i, 2, 0)."";
	$inv = 0;

	for($j = 3; $j < $columnas; $j++){
		
		$inv = $inv + $data->val($i, $j, 0);
		//echo $data->val($i, $j, 0) . ", ";
	}
	
	$invPro = $inv / ($columnas - 3);
	//echo $sku . ', ' . $invPro . ",  " . $inv . ", " . ($columnas -2) . "<br>";
	$registro = $registro . $shiPoi . ", " .  $sku . ", " . $invPro;
	for($k = 0; $k < $columnasVacias; $k++){
		$registro = $registro.", NULL";
	}
	
	$registro = $registro . ")";
//	echo $registro . "<br>";
//	echo "Sku: " . $sku. "Col: " . $columnas . "-Inv: " . $inv . "-InvPro: " . $invPro . "-";
	
	//echo $query . $registro . "<br>";
	//Insercion del registro atrapando la excepcion en una cadena de caracteres que contiene a los registros erroneos
	if( ! $res = $conexion->query($query . $registro)){
		
		$registrosError = $registrosError. $query. $registro."<br>";
		
	}
	//echo $query . $registro . " <br>";
	$registro = "";

}

//Se verifica la cantidad de registros insertados a la base.
$registrosBase = $conexion->query("SELECT * FROM " . $tabla . " WHERE per = '" . $per . "'");

//Se inicializa el Array, se pasan los parametros necesarios para posteriormente mandarlos como un objeto JSON de regreso al cliente
require($url);

$mensaje = "Resumen:<br>Registros Insertados: $registrosBase->num_rows<br>$resumenUrl";
$mensaje .= "<br>" . $resumenUrl;
$respuesta = array();
$respuesta['respuesta'] = utf8_encode($mensaje);
echo json_encode($respuesta);
//echo "Kilos: ".$kilos;
?>