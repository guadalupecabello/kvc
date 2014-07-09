<? 

header("Content-type: text/csv");
header("Content-Disposition: attachment; filename=Concentrado.csv");
header("Pragma: no-cache");
header("Expires: 0");

require('../funciones.php');

limpiarRequest($_REQUEST);

extract($_POST);
verificarSesion();
$conexion = conexion();
    
$encabezados = array(
	"Periodo",
	"Origen",
	"Sales Org.",
	"D. Ch.",
	"Division",
	"Plant",
	"Sold To",
	"Sold To Name",
	"Ship To",
	"Ship To Name",
	"Order Date",
	"Sales Doc.",      
	"Item",
	"Material Group",
	"Material",
	"Description",
	"Or. Qty",
	"Shp PGI Cs",
	"Cuts Qty",
	"ReasonCode",
	"Descripción",
	"Afectacion",
	"Afecta Fill Rate",
	"Canal",
	"Cadena",
	"Consolidado",
	"Material Group 5",
	"Material Group 5 Description"

);

$query = "SELECT per, c0, c1, c2, c3, c4, c5, c6, c7, c8, c9, c10, c11, c12, c13, c14, c15, c16, c17, c18, c19, c20, c21, c22, c23, c24, matGro5, matGro5Des 
			FROM fr_con 
			WHERE per = '" . $_SESSION['periodo'] . "'";

$resultado;

if(!$resultado = $conexion->query($query)){
	echo "<b>Error: </b>" . $conexion->error;
}else{

	$agregarEncabezados = true;

	$salida = fopen("php://output", "w");

	fputcsv($salida, $encabezados, ";");

	while($registro = $resultado->fetch_array(MYSQLI_ASSOC)){

		fputcsv($salida, $registro, ";");

	}
    
    fclose($salida);

}

    

?>