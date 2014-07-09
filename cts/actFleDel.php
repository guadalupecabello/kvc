<?

$info = false;

$resumenUrl = "<br>Detalles";

if($info==true){
	$periodo = "2014-04";
	$columnasVacias = 30;
}

$tablaOrigen = "fle_del_tem";
$tablaDestino = "fle_del";

if($periodo != ''){

	require('funciones.php');

	$conexion = conexion();

	//Creamos un query con el periodo, los campos, y las columnas vacias para actualizar a traves del dbxInf.php
	$query = "DESCRIBE " . $tablaOrigen;

	$resultado = $conexion->query($query);

	$queryOrigen = "SELECT '" . $periodo . "'";

	foreach($resultado as $clave => $valor){
		$queryOrigen .= "," . $valor['Field'];
	}

	for($i = 0; $i< $columnasVacias; $i++){
		$queryOrigen .= ", NULL";	
	}

	$queryOrigen .= " from " . $tablaOrigen;

	//echo $queryOrigen;

	$queryEliminacionDestino = "DELETE FROM " . $tablaDestino . " WHERE per = '" . $periodo . "'";

	$queryActualizacion = "insert into " . $tablaDestino . " (" . $queryOrigen . ")";

	if($info == true){
		echo "<hr><b>Eliminacion destino:</b> " . $queryEliminacionDestino;
		echo "<hr><b>Actualizacion destino:</b> " . $queryActualizacion;
	}else{

		$resumenUrl .= ejecutarQuery($conexion, $queryEliminacionDestino);
		$resumenUrl .= ejecutarQuery($conexion, $queryActualizacion);

	}

	$resumenUrl .= "<br>Filas Actualizadas: " . $conexion->affected_rows;

	$queries = array();

	$queries['a'] = "update fle_del
					set pay = 0
					where per = '" . $periodo . "';";
	
	$queries['b'] = "update fle_del
					inner join pay_shi_sol
					on fle_del.solToPar = pay_shi_sol.solToPar
					and fle_del.per = '" . $periodo . "'
					set fle_del.pay = pay_shi_sol.pay,
						fle_del.payNamCon = pay_shi_sol.payNam;"
									;
	$queries['c'] = "update fle_del
					set payNam = 'Otros'
					where per = '" . $periodo . "';";

	$queries['d'] = "update fle_del
					inner join cta_esp
					on fle_del.pay = cta_esp.pay
					and fle_del.per = '" . $periodo . "'
					set fle_del.payNam = cta_esp.payNam";
	
	$queries['ee'] = "UPDATE fle_del
					set act = 0
					where act is null
					and per = '" . $periodo . "'";
	
	$queries['e'] = "UPDATE fle_del
					inner join pal_caj
					on fle_del.mat = pal_caj.sku
					and fle_del.act = 0
					and fle_del.per = '" . $periodo . "'
					set fle_del.delQua = fle_del.delQua * pal_caj.caj,
						fle_del.act = 1;";

	$queries['f'] = "UPDATE fle_del
					SET dxd = 0
					where per = '" . $periodo . "';";
					
	$queries['g'] = "UPDATE fle_del
					inner join fac_dxd
					on fle_del.shiToPar = fac_dxd.shiToPar
					and fle_del.per = '" . $periodo . "'
					SET fle_del.dxd = 1;";
	
	$queries['i'] = "UPDATE fle_del
					inner join bus_uni
					on fle_del.mat = bus_uni.sku
					and fle_del.per = '" . $periodo . "'
					set fle_del.busUni = bus_uni.busUni;";
	$resumen = "";

	foreach($queries as $descripcion => $querie){

		if($info == true){
			echo "<hr>" . $querie;
		}else{

			$resumen .= ejecutarQuery($conexion, $querie);
		}
	}

	$resumenUrl .= $resumen;

}else{

	$resumenUrl .= "<br>No se ha definido el periodo a actualizar.";
}

// echo $resumenUrl;

if($info == true){
	echo $resumenUrl;
}

?>