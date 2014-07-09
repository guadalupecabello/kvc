<?
	//Importamos los archivos necesarios
	require('../conexionFR.php');
	require('../pe/Classes/PHPExcel.php');
	
	//Creamos el excel
	$libro = new PHPExcel();
	
	//Creamos una hoja y la marcamos como activa
	$libro->createSheet(0);
	$libro->setActiveSheetIndex(0);
	
	//Referenciamos
	$hoja = $libro->getActiveSheet();

	//For esampol como dijo samy y miguel luis de seccion imposible dice da :P
	//$hoja->setCellValue('A1', 'AH?! NIGGA?!');
	
	//Creamos una conexion	
	$conexion = conexion();
	
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
					from fr_con_mod
					where c21 not like '%No%'
					" . $filtro . "
			
					union
					select 'Rejected Lines CS', sum(c17)
					from fr_con_mod
					where c21 like '%Si%'
					and c20 like '%Rejected%'
					" . $filtro . "
					
					union
					select 'Cut Codes CS', 0
					from fr_con_mod
					
					union 
					select 'ATP Cut Cs - RJS', sum(c17)
					from fr_con_mod
					where c21 like '%Si%'
					and c20 like '%ATP%'
					" . $filtro . "
			
					union 
					select 'PGI\'d Cut Cs', sum(c17)
					from fr_con_mod
					where c21 like '%Si%'
					and c20 like '%PGI%'
					" . $filtro . "
			
					union
					select 'SD Cancellation CS', sum(c17)
					from fr_con_mod
					where c21 like '%Si%'
					and c20 like '%Cancellation%'
					" . $filtro . "
			
					union
					select 'Cajas no entregadas', '=SUM(C" . ($inicio + 1) . ":C" . ($inicio + 5) . ")'
					from fr_con_mod		
					
					union 
					select 'Cantidad Recibida', '= c" . $inicio ." - c" . ($inicio + 6) . "'
					from fr_con_mod";
					
					$inicio = $inicio + 11;
	}
	
	//Procesamos los queries resultantes y los mandamos al excel
	$inicioTablas = 2;
	foreach($queries as $query){
		
		$resultado = $conexion->query($query);
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
		//echo "<br><br>" . $query;
	}
	
	$writer = new PHPExcel_Writer_Excel2007($libro);
	$writer->save('Pivotes.xlsx');
	
	$url = "Pivotes.xlsx";
	header("Content-Disposition: attachment; filename= " . $url. "");
	header("Content-Type: application/octet-stream");
	header("Content-Length: " . filesize($url));
	header("Expires: 0");
	readfile($url);
	
?>