<? 

	error_reporting(E_ALL);

	if (session_status() == PHP_SESSION_NONE) {
    	session_start();
	}

	require('conexion.php');
	require('agrDatGen.php');
	$conexion = conexion();
	
	//Actualizacion necesaria al inicio
	$conexion->query("UPDATE inp_ovh
					SET totCta = (actCur * por) + sum
					WHERE per = '" . $_SESSION['periodo'] . "';");
					
	$queriesDatosGenerales = array();
	$queriesDatosGenerales['totOvhNor'] = "SELECT sum(totCta) AS 'Overhead Normal'
			FROM inp_ovh
			WHERE cal LIKE 'si'
			AND per = '" . $_SESSION['periodo'] . "'";
	
	$queriesDatosGenerales['kilos'] = "SELECT SUM(shiKil) AS 'Kilos'
			FROM fle_del
			WHERE per = '" . $_SESSION['periodo'] . "';";
	
	//Obtenemos los datos que seran estaticos
	$datosGenerales = agregarDatosGenerales($queriesDatosGenerales);
	
	//echo var_dump($datosGenerales) . "<br>";
	$queries = array();
	
	//Queries para la tarifa
	$queries['Preparado de Input'] = "UPDATE inp_ovh
					SET totCta = (actCur * por) + sum
					WHERE per = '" . $_SESSION['periodo'] . "';";
	
	$queries['Consulta de Kilos Totales en Base Maestra'] = "UPDATE fle_del
					SET porParKil = (shiKil / " . $datosGenerales['Kilos'] . ")
					WHERE per = '" . $_SESSION['periodo'] . "';";
					
	$queries['Preparado de Base Maestra'] = "UPDATE fle_del
					SET ovhDel = 0
					WHERE per = '" . $_SESSION['periodo'] . "';";					
					
	$queries['Prorrateado de Overhead General'] = "UPDATE fle_del
					SET ovhDel = (porParKil) * " . $datosGenerales['Overhead Normal'] . "
					WHERE per = '" . $_SESSION['periodo'] . "';";
	
	$resumenUrl = "Resumen: ";		
	foreach($queries as $descripcion => $querie){
		//echo "<br> " . $querie;
		if(!$conexion->query($querie)){
			 $resumenUrl = $resumenUrl. "<br>Error: " . $descripcion . "=>" . $conexion->error;
		}else{
			$resumenUrl = $resumenUrl. "<br>Exito: " . $querie;
		}
	}
		
?>