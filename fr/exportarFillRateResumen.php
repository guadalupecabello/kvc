<? 
	error_reporting(E_ALL);
	
	extract($_REQUEST);
	
	$info = false;

	//Mandamos llamar la rutina para calcular procesar el Fill Rate
	// require('generarConsolidado.php');
	
	//Importamos los archivos necesarios para crear nuestro excel
	require('../funciones.php');

	require('../pe/Classes/PHPExcel.php');
	
	verificarSesion();
	//Creamos nuestra conexion
	$conexion = conexion();
	if($info == true){	

		echo var_dump($conexion);

	}
	//Creamos el excel
	$libro = new PHPExcel();
	
	//Creamos una hoja y la marcamos como activa
	$libro->createSheet(0);
	$libro->setActiveSheetIndex(0);
	
	//Referenciamos la hoja para las pivotes
	$hoja = $libro->getActiveSheet();
	$hoja->setTitle("Fill Rate");

	/*
	*Creamos la coleccion con los filtro del query para cada categoria.
	*El indice de cada filtro fungira como titulo de la categoria
	*/
	
	$filtros = array();
	
	$filtros['FR Total Kellogg'] = "";
	
	$filtros['Autoservicio'] = "and (
								  c22 like '%Autoservicio Privado%'
								or c22 like '%Personal Kellogg%'
								)";
								
	$filtros['Mayoreo'] = "and (
							  c22 like '%Mayorista%'
							)";
							
	$filtros['Gobierno'] = "and (
							  c22 like '%Gobierno%'
							)";
							
	$filtros['Food Service'] = "and (
								  c22 like '%FS Indirect Distribt%'
								or c22 like '%Vend  Operators%'
								or c22 like '%Puerto Rico%'
								)";
								
	$filtros['Distribuidores'] = "and (
								  c22 like '%Distribuidores DTT%'
								or c22 like '%DSD Kellogg%'
								)";
								
	$filtros['Option'] = "and (
							  c22 like '%Institucionales%'
							)";
							
	$filtros['Total WM / Cifra'] = "and (
									  c24 like '%WALMEX%'
									)";
									
	$filtros['Bodega Aurrera'] = "and (
								  c23 like '%Bodega Aurrera%'
								)";
								
	$filtros['Supercenter'] = "and (
								  c23 like '%Wal Mart%'
								)";
	$filtros['Superama'] = "and (
							  c23 like '%Superama%'
							)";
							
	$filtros['Soriana'] = "and (
							  c24 like '%Soriana%'
							)";
							
	$filtros['Comercial Mexicana'] = "and (
									  c24 like '%Comercial Mexicana%'
									)";
									
	$filtros['Chedraui'] = "and (
							  c24 like '%Chedraui%'
							)";
							
	$filtros['HEB'] = "and (
						  c24 like '%Heb%'
						)";
						
	$filtros['Casa ley autoservicio'] = "and (
										  c24 like '%Casa Ley%'
										)";
	$filtros['ASR'] = "and (
						  c24 like '%Autoservicios Region%'
						)";
						
	$filtros['Oxxo'] = "and (
						  c23 like '%Oxxo%'
						)";
						
	$filtros['Fragua'] = "and (
							  c23 like '%Farmacias Guadalajara%'
							)";
							
	$filtros['Duero'] = "and (
						  c23 like '%Duero%'
						)";
						
	$filtros['Productos de Consumo Z'] = "and (
											  c23 like '%Productos de Consumo Z%'
											)";
	$filtros['Sams'] = "and (
						  c23 like '%Sam%'
						)";
						
	$filtros['Costco'] = "and (
					  c23 like '%Costco%'
					)";
					
	$filtros['City Club'] = "and (
							  c23 like '%City Club%'
							)";
							
	$filtros['Decasa'] = "and (
						  c23 like '%Decasa%'
						)";
						
	$filtros['Calimax'] = "and (
							  c24 like '%Calimax%'
							)";
							
	$filtros['Corvi'] = "and (
						  c23 like '%Corvi%'
						)";
						
	$filtros['Tier I / Tier II'] = "and (
					  c24 like 'Tier I'
					or c24 like 'Tier II'
					)";
					
	$filtros['Queretaro / 4252'] = "and c4 IN (4252, 4250, 4259)";
	
	$filtros['Guadalajara / 4254'] = "and c4 IN (4254)";
	
	$filtros['Monterrey / 4255'] = "and c4 IN (4255)";
	
	$filtros['Tijuana / 4258'] = "and c4 IN (4258)";

	$filtros['Porteo Sur / 4256'] = "and c4 IN (4256)";
	
	$filtros['Merida / 4266'] = "and c4 IN (4266)";
	
	$filtros['Toluca / 4251'] = "and c4 IN (4251)";
	
	$filtros['Porteo Torreon / 4286'] = "and c4 IN (4286)";
	
	$filtros['Eggo / 4260 - 4262'] = "and c4 IN (4260, 4262)";
	
	
	/*
	* Recorremos la coleccion para ir construyendo los queries en tiempo de ejecucion
	* y almacenamos los queries resultantes en una coleccion para su posterior procesamiento
	* dentro de la base de datoss
	*/

	$queries = array();
	
	$inicio = 3;
		
	foreach($filtros as $encabezado => $filtro){
		
		$queries[$encabezado] = "	select '" . $encabezado . " ' AS 'Encabezado', '' AS 'Valor'
		
					union
					select 'Cantidad Pedida' AS 'Encabezado', sum(c15) AS 'Valor'
					from fr_con_agr
					where c21 not like '%No%'
					and per = '" . $_SESSION['periodo'] . "'

					
					" . $filtro . "
			
					union
					select 'Rejected Lines CS', sum(c17)
					from fr_con_agr
					where c21 like '%Si%'
					and c20 like '%Rejected%'
					and per = '" . $_SESSION['periodo'] . "'
					" . $filtro . "
					
					union
					select 'Cut Codes CS', 0
					from fr_con_agr
					
					union
					
					select 'ATP Cut Cs - RJS', sum(c17)
					from fr_con_agr
					where c21 like '%Si%'
					and c20 like '%ATP%'
					and per = '" . $_SESSION['periodo'] . "'
					" . $filtro . "
			
					union 
					select 'PGI\'d Cut Cs', sum(c17)
					from fr_con_agr
					where c21 like '%Si%'
					and c20 like '%PGI%'
					and per = '" . $_SESSION['periodo'] . "'
					" . $filtro . "
			
					union
					select 'SD Cancellation CS', sum(c17)
					from fr_con_agr
					where c21 like '%Si%'
					and c20 like '%Cancellation%'
					and per = '" . $_SESSION['periodo'] . "'
					" . $filtro . "
			
					union
					select 'Cajas no entregadas', '=SUM(C" . ($inicio + 1) . ":C" . ($inicio + 5) . ")'
					from fr_con_agr
					
					union 
					select 'Cantidad Recibida', '= c" . $inicio ." - c" . ($inicio + 6) . "'
					from fr_con_agr";
					
					$inicio = $inicio + 11;
	}
	
	//Procesamos los queries resultantes y los mandamos al excel
	$inicioTablas = 2;

	foreach($queries as $query){

		if($info == true){
			echo "<hr>" . $query;
		}else{
			$resultado = $conexion->query($query);
			if(!$resultado){
				echo "Error: " . $conexion->errno . " - " . $conexion->error;
			}
			$resultado->fetch_array();
			$coleccionGeneral = array();
			foreach($resultado as $clave => $valor){
				$coleccion = array();
				foreach($valor as $c => $v){
					array_push($coleccion, $v);
				}
				array_push($coleccionGeneral, $coleccion);	
			}
			
			$hoja->fromArray($coleccionGeneral, NULL, ('B' . $inicioTablas));
			$inicioTablas = $inicioTablas + 11;
		}
		
		
		//echo "<br><br>" . $query;
	}
	
	
	/*
	* Rutina para crear la hoja con el concentrado origen de fill rate
	*/
	//Creamos una hoja y la marcamos como activa

	if($info == false){

		// $libro->createSheet(1);
		// $libro->setActiveSheetIndex(1);
	
		// //Referenciamos
		// $hoja = $libro->getActiveSheet();
		// $hoja->setTitle("Concentrado");
		
		// //Agregamos los encabezados
		// $encabezados = array(
		// 		"Origen",
		// 		"Sales Org.",
		// 		"D. Ch.",
		// 		"Division",
		// 		"Plant",
		// 		"Sold To",
		// 		"Sold To Name",
		// 		"Ship To",
		// 		"Ship To Name",
		// 		"Order Date",
		// 		"Sales Doc.",      
		// 		"Item",
		// 		"Material Group",
		// 		"Material",
		// 		"Description",
		// 		"Or. Qty",
		// 		"Shp PGI Cs",
		// 		"Cuts Qty",
		// 		"ReasonCode",
		// 		"Descripción",
		// 		"Afectacion",
		// 		"Afecta Fill Rate",
		// 		"Canal",
		// 		"Cadena",
		// 		"Consolidado"
		// 	);

		// $hoja->fromArray($encabezados, NULL, ('A1'));

		// $query = "SELECT * FROM " . $tablaOrigen;
		
		// $resultado = $conexion->query($query);
		// // $hoja->fromArray($resultado->fetch_all(MYSQLI_NUM), NULL, ('A2'));

		// $c = 1;

		// while($registro = $resultado->fetch_array(MYSQLI_ASSOC)){

		// 	$c++;
		// 	$cc = 0;
		// 	foreach ($registro as $k => $v) {
		// 		$hoja->setCellValueByColumnAndRow($cc,$c, utf8_encode($v));
		// 		$cc++;
		// 	}

		// }
		
		// $contador = 2;
		// while($registro = $resultado->fetch_array(MYSQLI_NUM)){
		// 	$hoja->fromArray($registro, NULL, ('A' . $contador));
		// 	$contador++;
		// }

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="Fill Rate '. $nombreArchivo .'.xlsx"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($libro, 'Excel2007');
		$objWriter->save('php://output');


	}

	
	

?>