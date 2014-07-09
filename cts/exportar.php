<? 

extract($_REQUEST);

header("Content-type: application/vnd.ms-excel; name='excel'");
header("Content-Disposition: filename=Cost To Serve - Vista Dinamica.xls");
header("Pragma: no-cache");
header("Expires: 0");

require('../funciones.php');

$conexion = conexion();

$tabla = "<table border='1' cellpadding='0' cellspacing='1'>
			
		";
$encabezados = "<tr class='encabezados'>";
$totales = "<tr class='totales'>";
$cuerpo = "";

$resultado = $conexion->query($querySumas);

while($reg = $resultado->fetch_array(MYSQLI_NUM)){
	foreach($reg as $v){
		$totales = $totales . "<td><b>" . utf8_decode($v) . "</b></td>";
	}
	
}
$totales = $totales . "</tr>";

$encabezados = $encabezados . "<tr>"; 

//-------------------
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

echo $tabla . $encabezados . $totales . $cuerpo . "</table>";

?>

<style>
	table{
		border-color:#000000;
		border collapse: collapse;
	}
	.encabezados{
		background-color:#DCE6F1;
		
	}
	
</style>