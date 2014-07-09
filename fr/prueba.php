<? 
	
	require('../pe/Classes/PHPExcel.php');
	require('../conexionFR.php');

	$conexion = conexion();

	$libro = new PHPExcel();
	
	//Creamos una hoja y la marcamos como activa
	$libro->createSheet(0);
	$libro->setActiveSheetIndex(0);
	
	//Referenciamos la hoja para las pivotes
	$hoja = $libro->getActiveSheet();
	$hoja->setTitle("Fill Rate");

	$query = "SELECT c13, c14 from fr_con WHERE c13 = 1008094242;";
	
	$resultado = $conexion->query($query);

	$arreglo = $resultado->fetch_all(MYSQLI_NUM);

	$c = 0;
	foreach ($arreglo as $key => $value) {
		// echo var_dump($value) . "<hr>";
		$c++;
		$cc = 0;
		
		foreach ($value as $k => $v) {
			$hoja->setCellValueByColumnAndRow($cc,$c, utf8_encode($v));
			$cc++;
		}
	}


	// echo var_dump($arreglo);

	//Agregamos los encabezados
	// $encabezados = array(
	// 		"Ñ",
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

	// $hoja->fromArray($arreglo, NULL, ('A1'));

	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="asd.xlsx"');
	header('Cache-Control: max-age=0');

	$objWriter = PHPExcel_IOFactory::createWriter($libro, 'Excel2007');
	$objWriter->save('php://output');


?>