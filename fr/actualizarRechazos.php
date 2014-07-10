<? 
	
	require('funciones.php');
	verificarSesion();
	$resumenUrl = "";
	
	$conexion = conexion();

	if($periodo){

		$queries = array();

		//Eliminamos el contenido del Rechazos
		$queries['Limpiando Rechazos'] = "DELETE FROM fr_con WHERE c0 LIKE 'Rechazos' AND per = '" . $_SESSION['periodo'] . "'";

		$queries['Concentrando Zror'] = "insert into fr_con(
						select '" . $_SESSION['periodo'] . "', 'Rechazos', c11,c12,c13,c10,c3, c4, '', '', c1, c32, '', '', c5, c6, c33, '', c30, c16, '', '', '', '', '', ''		,'',''	,'', '', '', '', '', '', '', '', ''		,'', '', '', '', '', '', '', '', ''
						from fr_zro
					);";

		$queries['Depurando Edidummy - 750'] = "UPDATE fr_con
						SET fr_con.c14 = substr(fr_con.c14, 1, 13)
						where fr_con.c13 like '%edidummy%'
						and fr_con.c14 like '750%'
						and c0 = 'Rechazos'
						and per = '" . $_SESSION['periodo'] . "';";

		$queries['Depurando Edidummy - 380'] = "UPDATE fr_con
						SET fr_con.c14 = substr(fr_con.c14, 1, 11)
						where fr_con.c13 like '%edidummy%'
						and fr_con.c14 like '380%'
						and c0 = 'Rechazos'
						and per = '" . $_SESSION['periodo'] . "';";
						
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
							and fr_con.c0 = 'Rechazos'
							and fr_con.per = '" . $_SESSION['periodo'] . "'
							
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
							and fr_con.c0 = 'Rechazos'
							and fr_con.per = '" . $_SESSION['periodo'] . "'
							
						)
						SET fr_con.c13 = fr_mae_mat.sku;";
						
						
		$queries['Depurando Edidummy - 1750'] = "UPDATE fr_con
						SET fr_con.c14 = substr(fr_con.c14, 1, 14)
						where fr_con.c13 like '%edidummy%'
						and fr_con.c14 like '1750%'
						and fr_con.c0 = 'Rechazos'
						and fr_con.per = '" . $_SESSION['periodo'] . "';";

		$queries['Actualizando Sku correctos para Edidummy 1750'] = "UPDATE fr_con
						INNER JOIN fr_mae_mat
						ON fr_con.c14 = fr_mae_mat.d14
						AND	fr_con.c13 like '%edidummy%'
						and fr_con.c14 like '1750%'
						and fr_con.c0 = 'Rechazos'
						and fr_con.per = '" . $_SESSION['periodo'] . "'
						SET fr_con.c13 = fr_mae_mat.sku;";

		$queries['Depurando Ediexc a Subcadena'] = "UPDATE fr_con
						set c13 = substr(c14, 9, 10)
						where c13 like '%ediexclusi%'
						and length(c14) > 10
						and fr_con.c0 = 'Rechazos'
						and fr_con.per = '" . $_SESSION['periodo'] . "';";

		$queries['Depurando Ediexc a 10 digitos'] = "UPDATE fr_con
						set c13 = c14
						where c13 like '%ediexclusi%'
						and (
								c14 like '10080%'
								OR c14 like '380%'
							)
						and length(c14) = 10
						and c0 = 'Rechazos'
						and per = '" . $_SESSION['periodo'] . "';";


		$queries['Actualizando Sku restantes'] = "UPDATE fr_con
						inner join fr_mae_mat
						on fr_con.c13 = fr_mae_mat.sku
						and fr_con.c0 = 'Rechazos'
						and fr_con.per = '" . $_SESSION['periodo'] . "'
						set fr_con.c14 = fr_mae_mat.des,
							fr_con.c12 = fr_mae_mat.matGroDes;";


		// $queries['Actualizando Business Unit'] = "UPDATE fr_con
		// 				inner join fr_mae_mat
		// 				on fr_con.c13 = fr_mae_mat.sku
		// 				and fr_con.c0 = 'Case Fill'
		// 				and fr_con.per = '" . $_SESSION['periodo'] . "'
		// 				set fr_con.c12 = fr_mae_mat.matGro;";

		$queries['Actualizando Causas'] = "UPDATE fr_con
						inner join fr_mae_cau
						on fr_con.c18 = fr_mae_cau.ordRea
						and fr_con.c0 = 'Rechazos'
						and fr_con.per = '" . $_SESSION['periodo'] . "'
						set fr_con.c19 = fr_mae_cau.cau,
							fr_con.c20 = fr_mae_cau.afe,
							fr_con.c21 = fr_mae_cau.afeFR,

							fr_con.porEjeOm = fr_mae_cau.porEjeOm,
							fr_con.porEjeTra = fr_mae_cau.porEjeTra,
							fr_con.porCooOpe = fr_mae_cau.porCooOpe,
							fr_con.porCalCen = fr_mae_cau.porCalCen,
							fr_con.porCooTra = fr_mae_cau.porCooTra,
							fr_con.porEjeCpf = fr_mae_cau.porEjeCpf,
							fr_con.porEjeRep = fr_mae_cau.porEjeRep,
							fr_con.porDemPla = fr_mae_cau.porDemPla,
							fr_con.porLidCal = fr_mae_cau.porLidCal;";

		$queries['Actualizando Clientes'] = "UPDATE fr_con
						inner join fr_mae_cli
						on fr_con.c5 = fr_mae_cli.solToPar
						and fr_con.c0 = 'Rechazos'
						and fr_con.per = '" . $_SESSION['periodo'] . "'
						set fr_con.c22 = fr_mae_cli.can,
							fr_con.c23 = fr_mae_cli.cad,
							fr_con.c24 = fr_mae_cli.con;";

		$queries['Actualizando Ejecutivos por Ship To Party'] = "UPDATE fr_con
						inner join fr_mae_shi
						on fr_con.c5 = fr_mae_shi.solToCha
						and fr_con.per = '" . $_SESSION['periodo'] . "'
						and fr_con.c0 = 'Rechazos'
						set fr_con.ejeOm = fr_mae_shi.ejeOm,
							fr_con.ejeTra = fr_mae_shi.ejeTra,
							fr_con.ejeCpf = fr_mae_shi.ejeCpf";

		$queries['Actualizando Ejecutivos por Planta'] = "UPDATE fr_con
						inner join fr_mae_pla
						on fr_con.c4 = fr_mae_pla.pla
						and fr_con.per = '" . $_SESSION['periodo'] . "'
						and fr_con.c0 = 'Rechazos'
						set fr_con.cooOpe = fr_mae_pla.cooOpe,
							fr_con.calCen = fr_mae_pla.calCen,
							fr_con.cooTra = fr_mae_pla.cooTra,
							fr_con.ejeRep = fr_mae_pla.ejeRep,
							fr_con.lidCal = fr_mae_pla.lidCal
						";

		$queries['Actualizando Ejecutivos por Material Group 5'] = "UPDATE fr_con
						inner join fr_mae_gro5
						on fr_con.matGro5 = fr_mae_gro5.matGro5
						and fr_con.per = '" . $_SESSION['periodo'] . "'
						and fr_con.c0 = 'Rechazos'
						set fr_con.demPla = fr_mae_gro5.demPla
						";

		$queries['Limpiando Resuemen Concentrado'] = "delete from fr_con_agr WHERE per = '" . $_SESSION['periodo'] . "';";

		$queries['Actualizando Resuemen Concentrado'] = "insert into fr_con_agr(
							select '" . $_SESSION['periodo'] . "', c4, c21, c20, c19, c18, c24, c22, c23, sum(c15), sum(c16), sum(c17), c12,matGro5, matGro5Des, porEjeOm, porEjeTra, porCooOpe, porCalCen, porCooTra, porEjeCpf, porEjeRep, porDemPla, porLidCal, ejeOm, ejeTra, cooOpe, calCen, cooTra, ejeCpf, ejeRep, demPla, lidCal
						        from fr_con
						        WHERE per = '" . $_SESSION['periodo']  . "'
						        group by c4, c21, c20, c19, c18, c24, c22, c23
						);";

		$resumenUrl .= registrarEvento($conexion, $_SESSION['periodo'], 'Admin', 'fr_zro');
		$resumenUrl .= registrarEvento($conexion, $_SESSION['periodo'], 'Admin', 'fr_con');

		$resumenUrl .= ejecutarQueries($conexion, $queries, 1);

	} else { 

		$resumenUrl .= "<br><b>Periodo No definido</b>";

	}


?>