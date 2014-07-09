<? 
	//error_reporting(0);
	//Calculo Gastos Eventuales
	require('../funciones.php');
	
	$conexion = conexion();
	
	$inicio = Date('h') . ":" . Date('i') . ":" . Date('s');
	
	$queriesDatosGenerales = array();
	$queriesDatosGenerales[''] = "";
	//$datosGenerales = agregarDatosGenerales($queriesDatosGenerales);
	
	$queries = array();
	
	$queries['Borrar Curr - USD en ZRor'] = "delete from fr_zro
				where c9 like '%USD%';";
				
	$queries['Preparando Repositorios'] = "delete from fr_con;";

	$queries['Concentrado Case Fill'] = "insert into fr_con(
						select 'Case Fill', c1, c2, c3, c4, c5, c6, c7, c8, c9, c10, c11, c12, c13, c14, c15, c16, c17, c18, '', '', '', '', '', ''
						from fr_cas_fil
					);";

	$queries['Concentrando Zror'] = "insert into fr_con(
						select 'Zror', c11,c12,c13,c10,c3, c4, '', '', c1, c32, '', '', c5, c6, c33, '', c30, c16, '', '', '', '', '', ''
						from fr_zro
					);";

	$queries['Depurando Edidummy - 750'] = "UPDATE fr_con
					SET fr_con.c14 = substr(fr_con.c14, 1, 13)
					where fr_con.c13 like '%edidummy%'
					and fr_con.c14 like '750%';";

	$queries['Depurando Edidummy - 380'] = "UPDATE fr_con
					SET fr_con.c14 = substr(fr_con.c14, 1, 11)
					where fr_con.c13 like '%edidummy%'
					and fr_con.c14 like '380%';";
					
	$queries['Actualizando Sku correctos para Edidummy 750-380 en EAN 13'] = "UPDATE fr_con
					INNER JOIN fr_mae_mat
					ON 
					(
						fr_con.c14 = fr_mae_mat.e13
						and fr_con.c13 like '%edidummy%'
						and 
						(
							fr_con.c14 like '750%'
							OR fr_con.c14 like '380%'
						)
						
					)
					SET fr_con.c13 = fr_mae_mat.sku;";
					
	$queries['Actualizando Sku correctos para Edidummy 750-380 en DUN 14'] = "UPDATE fr_con
					INNER JOIN fr_mae_mat
					ON 
					(
						fr_con.c14 = fr_mae_mat.d14
						and fr_con.c13 like '%edidummy%'
						and 
						(
							fr_con.c14 like '750%'
							OR fr_con.c14 like '380%'
						)
						
					)
					SET fr_con.c13 = fr_mae_mat.sku;";
					
					
	$queries['Depurando Edidummy - 1750'] = "UPDATE fr_con
					SET fr_con.c14 = substr(fr_con.c14, 1, 14)
					where fr_con.c13 like '%edidummy%'
					and fr_con.c14 like '1750%';";

	$queries['Actualizando Sku correctos para Edidummy 1750'] = "UPDATE fr_con
					INNER JOIN fr_mae_mat
					ON fr_con.c14 = fr_mae_mat.d14
					AND	fr_con.c13 like '%edidummy%'
					and fr_con.c14 like '1750%'
					SET fr_con.c13 = fr_mae_mat.sku;";

	$queries['Depurando Ediexc a Subcadena'] = "update fr_con
					set c13 = substr(c14, 9, 10)
					where c13 like '%ediexclusi%'
					and length(c14) > 10;";
	$queries['Depurando Ediexc a 10 digitos'] = "update fr_con
					set c13 = c14
					where c13 like '%ediexclusi%'
					and (
							c14 like '10080%'
							OR c14 like '380%'
						)
					and length(c14) = 10;";
	$queries['Actualizando Sku restantes'] = "update fr_con
					inner join fr_mae_mat
					on fr_con.c13 = fr_mae_mat.sku
					set fr_con.c14 = fr_mae_mat.des;";
	$queries['Actualizando Business Unit'] = "update fr_con
					inner join fr_mae_mat
					on fr_con.c13 = fr_mae_mat.sku
					set fr_con.c12 = fr_mae_mat.matGro;";
	$queries['Actualizando Causas'] = "update fr_con
					inner join fr_mae_cau
					on fr_con.c18 = fr_mae_cau.ordRea
					set fr_con.c19 = fr_mae_cau.cau,
						fr_con.c20 = fr_mae_cau.afe,
						fr_con.c21 = fr_mae_cau.afeFR;";
	$queries['Actualizando Clientes'] = "update fr_con
					inner join fr_mae_cli
					on fr_con.c5 = fr_mae_cli.solToPar
					set fr_con.c22 = fr_mae_cli.can,
						fr_con.c23 = fr_mae_cli.cad,
						fr_con.c24 = fr_mae_cli.con;";

	// $queries['Limpiando Tabla de Referencia'] = "delete from fr_con_agr;";

	// $queries['Generando Tabla de Referencia'] = "insert into fr_con_agr(
	// 												select c4, c21, c20, c19, c18, c24, c22, c23, sum(c15), sum(c16), sum(c17)
	// 											        from fr_con
	// 											        group by c4, c21, c20, c19, c18, c24, c22, c23
	// 											);";
							
	//echo "<br>" . var_dump($datosGenerales);
	$resumenUrl = "Resumen: ";	
	foreach($queries as $descripcion => $querie){
		//echo "<br>" . $querie;
		if(!$conexion->query($querie)){
			 $resumenUrl .= "\nError: " . $descripcion . "=>" . $conexion->error;
		}else{
			//$resumen = $resumen. "\nExito: " . $descripcion;
		}
	}
	
	$final = Date('h') . ":" . Date('i') . ":" . Date('s');
	
	$resumenUrl .= "\nHora de Inicio: " . $inicio;
	$resumenUrl .= "\nHora de Termino: " . $final;

	$respuesta = array();

	$respuesta['respuesta'] = utf8_encode($resumenUrl);

	echo json_encode($respuesta);
	
?>