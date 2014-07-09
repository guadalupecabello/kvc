<?

extract($_REQUEST);

header("Content-type: application/vnd.ms-excel; name='excel'");
header("Content-Disposition: filename=Query.xls");
header("Pragma: no-cache");
header("Expires: 0");

require('funciones.php');
$conexion = conexion();

$tabla = "<table border='1' cellpadding='0' cellspacing='1'>";

$cuerpo = "";

$encabezados = "";

$encabezados = $encabezados . "<tr>"; 

$resultado = $conexion->query($query);
$resultado->fetch_array();

$contador = 0;

foreach($resultado as $clave => $valor){
	$cuerpo = $cuerpo . "<tr>";
	foreach($valor as $c => $v){
		
		if($contador == 0){
			$encabezados = $encabezados . "<td align='center'><b>" . utf8_decode($c) ."</b></td>";
		}
		//echo "<br>" . $c . " => " . $v;
		$cuerpo = $cuerpo . "<td>" . utf8_decode($v) . "</td>";
	}
	$cuerpo = $cuerpo . "</tr>";
	$contador++;
}

$encabezados = $encabezados . "<tr>"; 

echo $tabla . $encabezados  . $cuerpo . "</table>";

?>