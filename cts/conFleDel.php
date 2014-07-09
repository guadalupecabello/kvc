<? 
	require('conexion.php');
	$conexion = conexion();
		
	$queries = array();
	
	$queries['a'] = "update fle_del
					set pay = 0;";
	
	$queries['b'] = "update fle_del
					inner join pay_shi_sol
					on fle_del.solToPar = pay_shi_sol.solToPar
					set fle_del.pay = pay_shi_sol.pay,
						fle_del.payNamCon = pay_shi_sol.payNam;"
									;
	$queries['c'] = "update fle_del
									set payNam = 'Otros';";
	$queries['d'] = "update fle_del
									inner join cta_esp
									on fle_del.pay = cta_esp.pay
									set fle_del.payNam = cta_esp.payNam";
	
	$queries['ee'] = "update fle_del
						set act = 0
						where act is null";
	
	$queries['e'] = "update fle_del
					inner join pal_caj
					on fle_del.mat = pal_caj.sku
					and fle_del.act = 0
					set fle_del.delQua = fle_del.delQua * pal_caj.caj,
						fle_del.act = 1;";

	$queries['f'] = "UPDATE fle_del
					SET dxd = 0;";
					
	$queries['g'] = "UPDATE fle_del
					inner join fac_dxd
					on fle_del.shiToPar = fac_dxd.shiToPar
					SET fle_del.dxd = 1;";
	
	$queries['i'] = "update fle_del
					inner join bus_uni
					on fle_del.mat = bus_uni.sku
					set fle_del.busUni = bus_uni.busUni;";
	
	$resumenUrl = "<br>Detalles";		
	
	foreach($queries as $descripcion => $querie){
		if(!$conexion->query($querie)){
			 $resumenUrl .= $resumenUrl . "<br>Error: " . $descripcion . "=>" . $conexion->error;
		}else{
			//$resumenUrl = $resumenUrl. "\nExito: " . $descripcion;
		}
	}
	
?>
