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
	"Material Group 5 Description",
	"% Ejecutivo OM",
	"% Ejecutivo Transporte",
	"% Coordinador Operaciones",
	"% Call Center",
	"% Coordinador Transporte",
	"% Ejecutivo CPFR",
	"% Ejecutivo Reposicion",
	"% Demand Planning",
	"% Lider Calidad",
	"Ejecutivo OM",
	"Ejecutivo Transporte",
	"Coordinador Operaciones",
	"Call Center",
	"Coordinador Transporte",
	"Ejecutivo CPFR",
	"Ejecutivo Reposicion",
	"Demand Planning",
	"Lider Calidad"


);

$query = "SELECT * FROM fr_con WHERE per = '" . $_SESSION['periodo'] . "'";

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