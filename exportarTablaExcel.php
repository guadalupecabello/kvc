<?
extract($_REQUEST);

header("Content-type: text/csv");
header("Content-Disposition: attachment; filename=". $nombretabla .".csv");
header("Pragma: no-cache");
header("Expires: 0");

require('conexion.php');
$conexion = conexion();

$query = "SELECT * FROM " . $nombretabla;

$resultado = $conexion->query($query);
$resultado->fetch_array();

outputCSV($resultado);

function outputCSV($data) {
    $output = fopen("php://output", "w");
    foreach ($data as $row) {
        fputcsv($output, $row,';');
    }
    fclose($output);
}

?>