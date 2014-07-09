<? 
	error_reporting(E_ALL);

	if (session_status() == PHP_SESSION_NONE) {
    	session_start();
	}

	//Calculo Gastos Eventuales
	require('conexion.php');
	require('agrDatGen.php');
	$conexion = conexion();
	
	$queriesDatosGenerales = array();
	$queriesDatosGenerales[''] = "";
	//$datosGenerales = agregarDatosGenerales($queriesDatosGenerales);
	
	$queries = array();
	
	$queries['a'] = "DELETE FROM shi_dxd_fle_aux
					WHERE per = '" . $_SESSION['periodo'] . "';";

	$queries['b'] = "INSERT INTO shi_dxd_fle_aux(
						SELECT per, solToPar, pay, shiDocNum, apoMns,
								SUM(fle_del.shiKil), SUM(fle_del.shiCubMet), SUM(fle_del.delQua),
								SUM(fle_del.groSal), SUM(fle_del.netSal), NULL, NULL
						FROM fle_del
						WHERE dxd = 1
						AND per = '" . $_SESSION['periodo'] . "'
						GROUP BY per, solToPar, pay, shiDocNum
						ORDER BY per, solToPar, pay, shiDocNum
					);";



	$queries['c'] = "UPDATE shi_dxd_fle_aux
					INNER JOIN fac_dxd
					ON shi_dxd_fle_aux.solToPar = fac_dxd.shiToPar
					AND shi_dxd_fle_aux.per = '" . $_SESSION['periodo'] . "'
					SET shi_dxd_fle_aux.tip = fac_dxd.tip,
						shi_dxd_fle_aux.fac = fac_dxd.fac;";

	$queries['d'] = "DELETE FROM shi_dxd_aux
					WHERE per = '" . $_SESSION['periodo'] . "';";

	$queries['e'] = "INSERT INTO shi_dxd_aux(
						
						SELECT 	per, solToPar, pay, tip, fac,
								SUM(shiKil), SUM(shiCubMet), SUM(delQua),
								SUM(groSal), SUM(netSal), COUNT(shiDocNum),
								(SUM(groSal) * fac)
						FROM shi_dxd_fle_aux
						WHERE tip = 1
						AND per = '" . $_SESSION['periodo'] . "'
						GROUP BY per, solToPar

					);";
//Sustituimos este filtro de 78m para evitar problemas con fletes que se queden fuera					
/*	$queries['f'] = "INSERT INTO shi_dxd_aux(
						SELECT 	solToPar, pay, tip, fac,
								SUM(shiKil), SUM(shiCubMet), SUM(delQua),
								SUM(groSal), SUM(netSal), COUNT(shiDocNum),
								(SUM(groSal) * fac)
						FROM shi_dxd_fle_aux
						WHERE tip = 2
						AND shiCubMet >= 78
						GROUP BY solToPar
					);";*/
					
					$queries['f'] = "INSERT INTO shi_dxd_aux(
						SELECT per, solToPar, pay, tip, fac,
								SUM(shiKil), SUM(shiCubMet), SUM(delQua),
								SUM(groSal), SUM(netSal), COUNT(shiDocNum),
								(SUM(groSal) * fac)
						FROM shi_dxd_fle_aux
						WHERE tip = 2
						AND per = '" . $_SESSION['periodo'] . "'
						GROUP BY per, solToPar
					);";
					
					
					
					
					
					
	$queries['g'] = "INSERT INTO shi_dxd_aux(	
	
						SELECT 	per, solToPar, pay, tip, fac,
								SUM(shiKil), SUM(shiCubMet), SUM(delQua),
								SUM(groSal), SUM(netSal), COUNT(shiDocNum),
								(SUM(netSal) * fac)
						FROM shi_dxd_fle_aux
						WHERE tip = 3
						AND per = '" . $_SESSION['periodo'] . "'
						GROUP BY per, solToPar
						
					);";
	$queries['h'] = "INSERT INTO shi_dxd_aux(		
					
						SELECT 	per, solToPar, pay, tip, fac,
								SUM(shiKil), SUM(shiCubMet), SUM(delQua),
								SUM(groSal), SUM(netSal), COUNT(shiDocNum),
								(COUNT(shiDocNum) * fac)
						FROM shi_dxd_fle_aux
						WHERE tip = 4
						AND per = '" . $_SESSION['periodo'] . "'
						GROUP BY per, solToPar
						
					);";
					
					
	//Sustituimos por un query sin filtro de m3 para evitar dejar fletes fuera
	/*$queries['i'] = "INSERT INTO shi_dxd_aux(

						SELECT 	solToPar, pay, tip, fac,
								SUM(shiKil), SUM(shiCubMet), SUM(delQua),
								SUM(groSal), SUM(netSal), COUNT(shiDocNum),
								(COUNT(shiDocNum) * fac)
						FROM shi_dxd_fle_aux
						WHERE tip = 51
						AND shiCubMet >=65
						GROUP BY solToPar
						
					);";*/
					
	$queries['i'] = "INSERT INTO shi_dxd_aux(

						SELECT 	per, solToPar, pay, tip, fac,
								SUM(shiKil), SUM(shiCubMet), SUM(delQua),
								SUM(groSal), SUM(netSal), COUNT(shiDocNum),
								(COUNT(shiDocNum) * fac)
						FROM shi_dxd_fle_aux
						WHERE tip = 51
						AND per = '" . $_SESSION['periodo'] . "'
						GROUP BY per, solToPar
						
					);";
					
	//Sustituimos por un query sin filtro de m3 para evitar dejar fletes fuera
	/*$queries['j'] = "INSERT INTO shi_dxd_aux(

						SELECT 	solToPar, pay, tip, fac,
								SUM(shiKil), SUM(shiCubMet), SUM(delQua),
								SUM(groSal), SUM(netSal), COUNT(shiDocNum),
								(COUNT(shiDocNum) * fac)
						FROM shi_dxd_fle_aux
						WHERE tip = 52
						AND shiCubMet >=70
						GROUP BY solToPar
						
					);";*/
					
	$queries['j'] = "INSERT INTO shi_dxd_aux(

						SELECT 	per, solToPar, pay, tip, fac,
								SUM(shiKil), SUM(shiCubMet), SUM(delQua),
								SUM(groSal), SUM(netSal), COUNT(shiDocNum),
								(COUNT(shiDocNum) * fac)
						FROM shi_dxd_fle_aux
						WHERE tip = 52
						AND per = '" . $_SESSION['periodo'] . "'
						GROUP BY per, solToPar
						
					);";
					
					//Sustituimos por un query sin filtro de m3 para evitar dejar fletes fuera
					
	/*$queries['k'] = "INSERT INTO shi_dxd_aux(			
						SELECT 	solToPar, pay, tip, fac,
								SUM(shiKil), SUM(shiCubMet), SUM(delQua),
								SUM(groSal), SUM(netSal), COUNT(shiDocNum),
								(COUNT(shiDocNum) * 1590)
						FROM shi_dxd_fle_aux
						WHERE tip = 53
						AND shiCubMet >=38
						AND apoMns LIKE '%zmx03%'
						GROUP BY solToPar
						
					);";*/
					
	$queries['k'] = "INSERT INTO shi_dxd_aux(			
						SELECT 	per, solToPar, pay, tip, fac,
								SUM(shiKil), SUM(shiCubMet), SUM(delQua),
								SUM(groSal), SUM(netSal), COUNT(shiDocNum),
								(COUNT(shiDocNum) * 1590)
						FROM shi_dxd_fle_aux
						WHERE tip = 53
						AND per = '" . $_SESSION['periodo'] . "'
						AND apoMns LIKE '%zmx03%'
						GROUP BY per, solToPar
						
					);";
	
	//Sustituimos por un query sin filtro de m3 para evitar dejar fletes fuera
	/*$queries['l'] = "INSERT INTO shi_dxd_aux(
				
						SELECT 	solToPar, pay, tip, fac,
								SUM(shiKil), SUM(shiCubMet), SUM(delQua),
								SUM(groSal), SUM(netSal), COUNT(shiDocNum),
								(COUNT(shiDocNum) * 5290)
						FROM shi_dxd_fle_aux
						WHERE tip = 53
								AND shiCubMet >=76
								AND apoMns LIKE '%zmx05%'
						GROUP BY solToPar
						ORDER BY solToPar
					
					);";*/
					
	$queries['l'] = "INSERT INTO shi_dxd_aux(
				
						SELECT 	per, solToPar, pay, tip, fac,
								SUM(shiKil), SUM(shiCubMet), SUM(delQua),
								SUM(groSal), SUM(netSal), COUNT(shiDocNum),
								(COUNT(shiDocNum) * 5290)
						FROM shi_dxd_fle_aux
						WHERE tip = 53
						AND per = '" . $_SESSION['periodo'] . "'
						AND apoMns LIKE '%zmx05%'
						GROUP BY per, solToPar
						ORDER BY per, solToPar
					
					);";
					
					
	$queries['m'] = "DELETE from shi_dxd_fle_cum_aux
					WHERE per = '" . $_SESSION['periodo'] . "';";

	$queries['n'] = "INSERT into shi_dxd_fle_cum_aux(
						select shi_dxd_fle_aux.per, shi_dxd_fle_aux.pay, shi_dxd_fle_aux.solToPar, shi_dxd_fle_aux.shiDocNum,
								((shi_dxd_fle_aux.shiCubMet * (shi_dxd_aux.dxd / shi_dxd_aux.shiCubMet)) /shi_dxd_fle_aux.shiCubMet) 
						,shi_dxd_fle_aux.shiCubMet,
						shi_dxd_fle_aux.groSal,
						0,0, 0
						from shi_dxd_fle_aux
						inner join shi_dxd_aux
						on shi_dxd_fle_aux.solToPar = shi_dxd_aux.solToPar
						and shi_dxd_fle_aux.per = '" . $_SESSION['periodo'] . "'
						and shi_dxd_aux.per = '" . $_SESSION['periodo'] . "'
						and shi_dxd_fle_aux.tip = 1
					);";
					
	//Sustituimos por un query sin filtro de m3 para evitar dejar fletes fuera
	/*				
	$queries['o'] = "insert into shi_dxd_fle_cum_aux(
						select shi_dxd_fle_aux.pay, shi_dxd_fle_aux.solToPar, shi_dxd_fle_aux.shiDocNum,
							((shi_dxd_fle_aux.shiCubMet * (shi_dxd_aux.dxd / shi_dxd_aux.shiCubMet)) /shi_dxd_fle_aux.shiCubMet)
							,shi_dxd_fle_aux.shiCubMet,
							shi_dxd_fle_aux.groSal,
							0,0, 0			
							from shi_dxd_fle_aux
							inner join shi_dxd_aux
							on shi_dxd_fle_aux.solToPar = shi_dxd_aux.solToPar
							and shi_dxd_fle_aux.shiCubMet >= 78 
							and shi_dxd_fle_aux.tip = 2
					);";*/
					
	$queries['o'] = "INSERT into shi_dxd_fle_cum_aux(
						select shi_dxd_fle_aux.per, shi_dxd_fle_aux.pay, shi_dxd_fle_aux.solToPar, shi_dxd_fle_aux.shiDocNum,
							((shi_dxd_fle_aux.shiCubMet * (shi_dxd_aux.dxd / shi_dxd_aux.shiCubMet)) /shi_dxd_fle_aux.shiCubMet)
							,shi_dxd_fle_aux.shiCubMet,
							shi_dxd_fle_aux.groSal,
							0,0, 0			
							from shi_dxd_fle_aux
							inner join shi_dxd_aux

							
							on shi_dxd_fle_aux.solToPar = shi_dxd_aux.solToPar
							and shi_dxd_fle_aux.per = '" . $_SESSION['periodo'] . "'
							and shi_dxd_aux.per = '" . $_SESSION['periodo'] . "'
							and shi_dxd_fle_aux.tip = 2
					);";
	
	
	$queries['p'] = "INSERT into shi_dxd_fle_cum_aux(
	
						select shi_dxd_fle_aux.per, shi_dxd_fle_aux.pay, shi_dxd_fle_aux.solToPar, shi_dxd_fle_aux.shiDocNum,
								((shi_dxd_fle_aux.shiCubMet * (shi_dxd_aux.dxd / shi_dxd_aux.shiCubMet)) /shi_dxd_fle_aux.shiCubMet)
								,shi_dxd_fle_aux.shiCubMet,
							shi_dxd_fle_aux.groSal,
							shi_dxd_fle_aux.netSal, 0, 0		
						from shi_dxd_fle_aux
						inner join shi_dxd_aux
						on shi_dxd_fle_aux.solToPar = shi_dxd_aux.solToPar
						and shi_dxd_fle_aux.per = '" . $_SESSION['periodo'] . "'
						and shi_dxd_aux.per = '" . $_SESSION['periodo'] . "'
						and shi_dxd_fle_aux.tip = 3
					);";

	$queries['q'] = "INSERT into shi_dxd_fle_cum_aux(
						select shi_dxd_fle_aux.per, shi_dxd_fle_aux.pay, shi_dxd_fle_aux.solToPar, shi_dxd_fle_aux.shiDocNum,
							((shi_dxd_aux.dxd / shi_dxd_aux.fle) / shi_dxd_fle_aux.shiCubMet )
							,shi_dxd_fle_aux.shiCubMet,
							shi_dxd_fle_aux.groSal,
							0, 0, 0	
						from shi_dxd_fle_aux
						inner join shi_dxd_aux
						on shi_dxd_fle_aux.solToPar = shi_dxd_aux.solToPar
						and shi_dxd_fle_aux.per = '" . $_SESSION['periodo'] . "'
						and shi_dxd_aux.per = '" . $_SESSION['periodo'] . "'
						and shi_dxd_fle_aux.tip = 4
					);";
					
	//Sustituimos por un query sin filtro de m3 para evitar dejar fletes fuera
	/*$queries['r'] = "insert into shi_dxd_fle_cum_aux(
						select shi_dxd_fle_aux.pay, shi_dxd_fle_aux.solToPar, shi_dxd_fle_aux.shiDocNum,
								((shi_dxd_aux.dxd / shi_dxd_aux.fle) / shi_dxd_fle_aux.shiCubMet)
								,shi_dxd_fle_aux.shiCubMet,
						shi_dxd_fle_aux.groSal,
						0, 0, 0				
						from shi_dxd_fle_aux
						inner join shi_dxd_aux
						on shi_dxd_fle_aux.solToPar = shi_dxd_aux.solToPar
						and shi_dxd_fle_aux.tip = 51
						and shi_dxd_fle_aux.shiCubMet >= 65
					);";*/
	$queries['r'] = "INSERT into shi_dxd_fle_cum_aux(
						select shi_dxd_fle_aux.per, shi_dxd_fle_aux.pay, shi_dxd_fle_aux.solToPar, shi_dxd_fle_aux.shiDocNum,
								((shi_dxd_aux.dxd / shi_dxd_aux.fle) / shi_dxd_fle_aux.shiCubMet)
								,shi_dxd_fle_aux.shiCubMet,
						shi_dxd_fle_aux.groSal,
						0, 0, 0				
						from shi_dxd_fle_aux
						inner join shi_dxd_aux
						on shi_dxd_fle_aux.solToPar = shi_dxd_aux.solToPar
						and shi_dxd_fle_aux.per = '" . $_SESSION['periodo'] . "'
						and shi_dxd_aux.per = '" . $_SESSION['periodo'] . "'
						and shi_dxd_fle_aux.tip = 51
					);";
					
					
					
					
	//Sustituimos por un query sin filtro de m3 para evitar dejar fletes fuera
	/*$queries['s'] = "insert into shi_dxd_fle_cum_aux(
						select 	shi_dxd_fle_aux.pay, shi_dxd_fle_aux.solToPar, shi_dxd_fle_aux.shiDocNum,
								((shi_dxd_aux.dxd / shi_dxd_aux.fle) / shi_dxd_fle_aux.shiCubMet)
								,shi_dxd_fle_aux.shiCubMet,
							shi_dxd_fle_aux.groSal,
							0, 0, 0		
						from shi_dxd_fle_aux
						inner join shi_dxd_aux
						on shi_dxd_fle_aux.solToPar = shi_dxd_aux.solToPar
						and shi_dxd_fle_aux.tip = 52
						and shi_dxd_fle_aux.shiCubMet >= 70
					);";*/
	$queries['s'] = "INSERT into shi_dxd_fle_cum_aux(
						select 	shi_dxd_fle_aux.per, shi_dxd_fle_aux.pay, shi_dxd_fle_aux.solToPar, shi_dxd_fle_aux.shiDocNum,
								((shi_dxd_aux.dxd / shi_dxd_aux.fle) / shi_dxd_fle_aux.shiCubMet)
								,shi_dxd_fle_aux.shiCubMet,
							shi_dxd_fle_aux.groSal,
							0, 0, 0
						from shi_dxd_fle_aux
						inner join shi_dxd_aux
						on shi_dxd_fle_aux.solToPar = shi_dxd_aux.solToPar
						and shi_dxd_fle_aux.per = '" . $_SESSION['periodo'] . "'
						and shi_dxd_aux.per = '" . $_SESSION['periodo'] . "'
						and shi_dxd_fle_aux.tip = 52
					);";
					

	
	//Sustituimos por un query sin filtro de m3 para evitar dejar fletes fuera
	/*$queries['t'] = "insert into shi_dxd_fle_cum_aux(
						select 	shi_dxd_fle_aux.pay, shi_dxd_fle_aux.solToPar, shi_dxd_fle_aux.shiDocNum,
								((shi_dxd_aux.dxd / shi_dxd_aux.fle) / shi_dxd_fle_aux.shiCubMet)
								,shi_dxd_fle_aux.shiCubMet,
							shi_dxd_fle_aux.groSal,
							0, 0, 0				
						from shi_dxd_fle_aux
						inner join shi_dxd_aux
						on shi_dxd_fle_aux.solToPar = shi_dxd_aux.solToPar
						and shi_dxd_fle_aux.tip = 53
								and shi_dxd_fle_aux.apoMns like '%zmx03%'
						and shi_dxd_fle_aux.shiCubMet >= 38
					);";*/
					
					
	$queries['t'] = "INSERT into shi_dxd_fle_cum_aux(
						select 	shi_dxd_fle_aux.per, shi_dxd_fle_aux.pay, shi_dxd_fle_aux.solToPar, shi_dxd_fle_aux.shiDocNum,
								((shi_dxd_aux.dxd / shi_dxd_aux.fle) / shi_dxd_fle_aux.shiCubMet)
								,shi_dxd_fle_aux.shiCubMet,
							shi_dxd_fle_aux.groSal,
							0, 0, 0				
						from shi_dxd_fle_aux
						inner join shi_dxd_aux
						on shi_dxd_fle_aux.solToPar = shi_dxd_aux.solToPar
						and shi_dxd_fle_aux.per = '" . $_SESSION['periodo'] . "'
						and shi_dxd_aux.per = '" . $_SESSION['periodo'] . "'
						and shi_dxd_fle_aux.tip = 53
						and shi_dxd_fle_aux.apoMns like '%zmx03%'
					);";
					
					
					
					
					
	//Sustituimos por un query sin filtro de m3 para evitar dejar fletes fuera			
	/*$queries['u'] = "insert into shi_dxd_fle_cum_aux(
						select 	shi_dxd_fle_aux.pay, shi_dxd_fle_aux.solToPar, shi_dxd_fle_aux.shiDocNum,
								((shi_dxd_aux.dxd / shi_dxd_aux.fle) / shi_dxd_fle_aux.shiCubMet)
								,shi_dxd_fle_aux.shiCubMet,
							shi_dxd_fle_aux.groSal,
							0, 0, 0				
						from shi_dxd_fle_aux
						inner join shi_dxd_aux
						on shi_dxd_fle_aux.solToPar = shi_dxd_aux.solToPar
						and shi_dxd_fle_aux.tip = 53
								and shi_dxd_fle_aux.apoMns like '%zmx05%'
						and shi_dxd_fle_aux.shiCubMet >= 76
					);";*/

	$queries['u'] = "INSERT into shi_dxd_fle_cum_aux(
						select shi_dxd_fle_aux.per, shi_dxd_fle_aux.pay, shi_dxd_fle_aux.solToPar, shi_dxd_fle_aux.shiDocNum,
								((shi_dxd_aux.dxd / shi_dxd_aux.fle) / shi_dxd_fle_aux.shiCubMet)
								,shi_dxd_fle_aux.shiCubMet,
							shi_dxd_fle_aux.groSal,
							0, 0, 0				
						from shi_dxd_fle_aux
						inner join shi_dxd_aux
						on shi_dxd_fle_aux.solToPar = shi_dxd_aux.solToPar
						and shi_dxd_fle_aux.per = '" . $_SESSION['periodo'] . "'
						and shi_dxd_aux.per = '" . $_SESSION['periodo'] . "'
						and shi_dxd_fle_aux.tip = 53
								and shi_dxd_fle_aux.apoMns like '%zmx05%'
					);";
					
					
	$queries['v'] = "UPDATE shi_dxd_fle_cum_aux
					set shi_dxd_fle_cum_aux.tip = 0
					WHERE per = '" . $_SESSION['periodo'] . "';";

	$queries['w'] = "UPDATE shi_dxd_fle_cum_aux
					inner join fac_dxd
					on shi_dxd_fle_cum_aux.solToPar = fac_dxd.shiToPar
					and shi_dxd_fle_cum_aux.per = '" . $_SESSION['periodo'] . "'
					set shi_dxd_fle_cum_aux.tip = fac_dxd.tip;";

	$queries['x'] = "DELETE from pay_sol_enc
					WHERE per = '" . $_SESSION['periodo'] . "';";

	$queries['y'] = "INSERT into pay_sol_enc(
						select per, pay, solToPar
						from shi_dxd_fle_cum_aux
						WHERE per = '" . $_SESSION['periodo'] . "'
						group by per, pay, solToPar
					)";

	$queries['z'] = "UPDATE pay_sol_enc
					set pay = 0
					where pay is null
					AND per = '" . $_SESSION['periodo'] . "';";

	$queries['aa'] = "UPDATE pay_sol_enc
					set solToPar = 0
					where solToPar is null
					AND per = '" . $_SESSION['periodo'] . "';";

	$queries['ab'] = "UPDATE dxd_liz
						set dxd_liz.fac = 0
					WHERE per = '" . $_SESSION['periodo'] . "'";

	$queries['ac'] = "UPDATE dxd_liz
						inner join fac_dxd
						on dxd_liz.solToPar = fac_dxd.shiToPar
						and dxd_liz.per = '" . $_SESSION['periodo'] . "'
						set dxd_liz.fac = fac_dxd.tip;";

	$queries['ad'] = "UPDATE dxd_liz
						set enc = 0
						WHERE per = '" . $_SESSION['periodo'] . "';";

	$queries['ae'] = "UPDATE dxd_liz
					inner join pay_sol_enc
					on dxd_liz.solToPar = pay_sol_enc.solToPar
					and dxd_liz.per = '" . $_SESSION['periodo'] . "'
					and pay_sol_enc.per = '" . $_SESSION['periodo'] . "'
					set dxd_liz.enc = 1;";

	$queries['af'] = "UPDATE dxd_liz
					set totMet = 0
					WHERE per = '" . $_SESSION['periodo'] . "';";

	$queries['ag'] = "UPDATE dxd_liz
					set totMet = (
						select sum(groSal)
						from shi_dxd_fle_cum_aux
						where shi_dxd_fle_cum_aux.solToPar = dxd_liz.solToPar
						AND shi_dxd_fle_cum_aux.per = '" . $_SESSION['periodo'] . "'
					)
					where fac = 1
					AND per = '" . $_SESSION['periodo'] . "';";

	$queries['ah'] = "UPDATE dxd_liz
					set totMet = (
						select sum(groSal)
						from shi_dxd_fle_cum_aux
						where shi_dxd_fle_cum_aux.solToPar = dxd_liz.solToPar
						AND shi_dxd_fle_cum_aux.per = '" . $_SESSION['periodo'] . "'
					)
					where fac = 2
					AND per = '" . $_SESSION['periodo'] . "';";

	$queries['ai'] = "UPDATE dxd_liz
						set totMet = (
							select sum(netSal)
							from shi_dxd_fle_cum_aux
							where shi_dxd_fle_cum_aux.solToPar = dxd_liz.solToPar
							AND shi_dxd_fle_cum_aux.per = '" . $_SESSION['periodo'] . "'
						)
						where fac = 3
						AND per = '" . $_SESSION['periodo'] . "';";

	$queries['aj'] = "UPDATE dxd_liz
						set totMet = (
							select sum(shiCubMet)
							from shi_dxd_fle_cum_aux
							where shi_dxd_fle_cum_aux.solToPar = dxd_liz.solToPar
							AND shi_dxd_fle_cum_aux.per = '" . $_SESSION['periodo'] . "'
						)
						where fac = 4
						AND per = '" . $_SESSION['periodo'] . "';";

	$queries['ak'] = "UPDATE dxd_liz
						set totMet = (
							select sum(shiCubMet)
							from shi_dxd_fle_cum_aux
							where shi_dxd_fle_cum_aux.solToPar = dxd_liz.solToPar
							AND shi_dxd_fle_cum_aux.per = '" . $_SESSION['periodo'] . "'
						)
						where fac = 51
						AND per = '" . $_SESSION['periodo'] . "';";

	$queries['al'] = "UPDATE dxd_liz
						set totMet = (
							select sum(shiCubMet)
							from shi_dxd_fle_cum_aux
							where shi_dxd_fle_cum_aux.solToPar = dxd_liz.solToPar
							AND shi_dxd_fle_cum_aux.per = '" . $_SESSION['periodo'] . "'
						)
						where fac = 52
						AND per = '" . $_SESSION['periodo'] . "';";

	$queries['am'] = "UPDATE dxd_liz
						set totMet = (
							select sum(shiCubMet)
							from shi_dxd_fle_cum_aux
							where shi_dxd_fle_cum_aux.solToPar = dxd_liz.solToPar
							AND shi_dxd_fle_cum_aux.per = '" . $_SESSION['periodo'] . "'
						)
						where fac = 53
						AND per = '" . $_SESSION['periodo'] . "';";


	$queries['an'] = "UPDATE dxd_liz
					set totMet = 0
					where totMet IS NULL
					AND per = '" . $_SESSION['periodo'] . "';";

	$queries['ao'] = "UPDATE dxd_liz
						set dxdMet = 0
						WHERE per = '" . $_SESSION['periodo'] . "';";

	$queries['ap'] = "UPDATE dxd_liz
						set dxdMet = dxd / totMet
						where totMet > 0 and dxd > 0
						AND per = '" . $_SESSION['periodo'] . "';";

	$queries['aq'] = "UPDATE shi_dxd_fle_cum_aux
					set dxdMet = 0
					WHERE per = '" . $_SESSION['periodo'] . "';";

	$queries['ar'] = "UPDATE shi_dxd_fle_cum_aux
						inner join dxd_liz
						on shi_dxd_fle_cum_aux.solToPar = dxd_liz.solToPar
						and shi_dxd_fle_cum_aux.per = '" . $_SESSION['periodo'] . "'
						and dxd_liz.per = '" . $_SESSION['periodo'] . "'
						set shi_dxd_fle_cum_aux.dxdMet = dxd_liz.dxdMet;";

	$queries['as'] = "UPDATE shi_dxd_fle_cum_aux
						set dxdMet = 0
						where dxdMet IS NULL
						and per = '" . $_SESSION['periodo'] . "';";

	$queries['at'] = "UPDATE fle_del
					set dxdTotAux = 0
					WHERE per = '" . $_SESSION['periodo'] . "';";

	$queries['au'] = "UPDATE fle_del
					inner join shi_dxd_fle_cum_aux
					on 
					(
						fle_del.shiDocNum = shi_dxd_fle_cum_aux.shiDocNum
						and fle_del.solToPar = shi_dxd_fle_cum_aux.solToPar
						and fle_del.per = '" . $_SESSION['periodo'] . "'
						and  shi_dxd_fle_cum_aux.per = '" . $_SESSION['periodo'] . "'
					)
					and shi_dxd_fle_cum_aux.tip in (1, 2)
					set fle_del.dxdTotAux = fle_del.groSal * shi_dxd_fle_cum_aux.dxdMet;";


	$queries['av'] = "UPDATE fle_del
					inner join shi_dxd_fle_cum_aux
					on (
							fle_del.shiDocNum = shi_dxd_fle_cum_aux.shiDocNum
							and fle_del.solToPar = shi_dxd_fle_cum_aux.solToPar
							and fle_del.per = '" . $_SESSION['periodo'] . "'
							and  shi_dxd_fle_cum_aux.per = '" . $_SESSION['periodo'] . "'
						)
					and shi_dxd_fle_cum_aux.tip in (3)
					set fle_del.dxdTotAux = fle_del.netSal * shi_dxd_fle_cum_aux.dxdMet;";

	$queries['aw'] = "UPDATE fle_del
					inner join shi_dxd_fle_cum_aux
					on fle_del.shiDocNum = shi_dxd_fle_cum_aux.shiDocNum
					and fle_del.solToPar = shi_dxd_fle_cum_aux.solToPar
					and fle_del.per = '" . $_SESSION['periodo'] . "'
					and  shi_dxd_fle_cum_aux.per = '" . $_SESSION['periodo'] . "'
					and shi_dxd_fle_cum_aux.tip in (4, 51, 52, 53)
					set fle_del.dxdTotAux = fle_del.shiCubMet * shi_dxd_fle_cum_aux.dxdMet;";
	
	
	//Actualizacion por payer para aquellas cantidades que no se encuentran por Sold To Party
	$queries['ax'] = "DELETE from dxd_liz_pay
					where per= '" . $_SESSION['periodo'] . "';";

	$queries['ay'] = "INSERT into dxd_liz_pay(
						select per, pay, sum(dxd), 0, 0, 0
						from dxd_liz
						where enc = 0
						and per= '" . $_SESSION['periodo'] . "'
						group by per, pay
						having sum(dxd) > 0
					);";
					
	$queries['az'] = "UPDATE dxd_liz_pay
					set tip = 0
					where per = '" . $_SESSION['periodo'] . "';";
	
	$queries['ba'] = "UPDATE dxd_liz_pay
						inner join fac_dxd
						on dxd_liz_pay.pay = fac_dxd.pay
						and dxd_liz_pay.per= '" . $_SESSION['periodo'] . "'
						set dxd_liz_pay.tip = fac_dxd.tip;";

	$queries['bb'] = "UPDATE dxd_liz_pay
					set totMet = 0
					where per= '" . $_SESSION['periodo'] . "';";

	$queries['bc'] = "UPDATE dxd_liz_pay
					set totMet = (
						select sum(groSal)
						from shi_dxd_fle_cum_aux
						where shi_dxd_fle_cum_aux.pay = dxd_liz_pay.pay
						and shi_dxd_fle_cum_aux.per= '" . $_SESSION['periodo'] . "'
						and dxd_liz_pay.per = '" . $_SESSION['periodo'] . "'
					)
					where tip = 1
					AND per = '" . $_SESSION['periodo'] . "';";


	$queries['bd'] = "UPDATE dxd_liz_pay
					set totMet = (
						select sum(groSal)
						from shi_dxd_fle_cum_aux
						where shi_dxd_fle_cum_aux.pay = dxd_liz_pay.pay
						and shi_dxd_fle_cum_aux.per= '" . $_SESSION['periodo'] . "'
						and dxd_liz_pay.per = '" . $_SESSION['periodo'] . "'
						and shi_dxd_fle_cum_aux.dxdMet = 0
					)
					where tip = 2
					AND per = '" . $_SESSION['periodo'] . "';";

	$queries['be'] = "UPDATE dxd_liz_pay
					set totMet = (
						select sum(netSal)
						from shi_dxd_fle_cum_aux
						where shi_dxd_fle_cum_aux.pay = dxd_liz_pay.pay
						and shi_dxd_fle_cum_aux.per= '" . $_SESSION['periodo'] . "'
						and dxd_liz_pay.per = '" . $_SESSION['periodo'] . "'
						and shi_dxd_fle_cum_aux.dxdMet = 0
					)
					where tip = 3
					AND per = '" . $_SESSION['periodo'] . "';";

	$queries['bf'] = "UPDATE dxd_liz_pay
					set totMet = (
						select sum(shiCubMet)
						from shi_dxd_fle_cum_aux
						where shi_dxd_fle_cum_aux.pay = dxd_liz_pay.pay
						and shi_dxd_fle_cum_aux.per= '" . $_SESSION['periodo'] . "'
						and dxd_liz_pay.per = '" . $_SESSION['periodo'] . "'
						and shi_dxd_fle_cum_aux.dxdMet = 0
					)
					where tip = 4
					AND per = '" . $_SESSION['periodo'] . "';";

	$queries['bg'] = "UPDATE dxd_liz_pay
					set totMet = (
						select sum(shiCubMet)
						from shi_dxd_fle_cum_aux
						where shi_dxd_fle_cum_aux.pay = dxd_liz_pay.pay
						and shi_dxd_fle_cum_aux.per= '" . $_SESSION['periodo'] . "'
						and dxd_liz_pay.per = '" . $_SESSION['periodo'] . "'
						and shi_dxd_fle_cum_aux.dxdMet = 0
					)
					where tip = 51
					AND per = '" . $_SESSION['periodo'] . "';";

	$queries['bh'] = "UPDATE dxd_liz_pay
					set totMet = (
						select sum(shiCubMet)
						from shi_dxd_fle_cum_aux
						where shi_dxd_fle_cum_aux.pay = dxd_liz_pay.pay
						and shi_dxd_fle_cum_aux.per= '" . $_SESSION['periodo'] . "'
						and dxd_liz_pay.per = '" . $_SESSION['periodo'] . "'
						and shi_dxd_fle_cum_aux.dxdMet = 0
					)
					where tip = 52
					AND per = '" . $_SESSION['periodo'] . "';";

	$queries['bi'] = "UPDATE dxd_liz_pay
					set totMet = (
						select sum(shiCubMet)
						from shi_dxd_fle_cum_aux
						where shi_dxd_fle_cum_aux.pay = dxd_liz_pay.pay
						and shi_dxd_fle_cum_aux.per= '" . $_SESSION['periodo'] . "'
						and dxd_liz_pay.per = '" . $_SESSION['periodo'] . "'
						and shi_dxd_fle_cum_aux.dxdMet = 0
					)
					where tip = 53
					AND per = '" . $_SESSION['periodo'] . "';";

	$queries['bj'] = "UPDATE dxd_liz_pay
						set totMet = 0
						where totMet IS NULL
						AND per = '" . $_SESSION['periodo'] . "';";

	$queries['bk'] = "UPDATE dxd_liz_pay
					set dxdMet = dxd / totMet
					where dxd > 0 AND totMet > 0
					AND per = '" . $_SESSION['periodo'] . "';";

	$queries['bl'] = "UPDATE shi_dxd_fle_cum_aux
					set dxdMet = 0
					WHERE per = '" . $_SESSION['periodo'] . "';";

	$queries['bm'] = "UPDATE shi_dxd_fle_cum_aux
					inner join dxd_liz_pay
					on shi_dxd_fle_cum_aux.pay = dxd_liz_pay.pay
					AND shi_dxd_fle_cum_aux.per = '" . $_SESSION['periodo'] . "'
					AND dxd_liz_pay.per = '" . $_SESSION['periodo'] . "'
					set	shi_dxd_fle_cum_aux.dxdMet = dxd_liz_pay.dxdMet;";

	$queries['bn'] = "UPDATE fle_del
					inner join shi_dxd_fle_cum_aux
					on 
					(fle_del.shiDocNum = shi_dxd_fle_cum_aux.shiDocNum
					and fle_del.pay = shi_dxd_fle_cum_aux.pay
					and fle_del.pay = shi_dxd_fle_cum_aux.pay
					AND fle_del.per = '" . $_SESSION['periodo'] . "'
					AND shi_dxd_fle_cum_aux.per = '" . $_SESSION['periodo'] . "'
					)
					and shi_dxd_fle_cum_aux.tip in (1, 2)
					and shi_dxd_fle_cum_aux.dxdMet > 0
					set fle_del.dxdTotAux = fle_del.dxdTotAux + (fle_del.groSal * shi_dxd_fle_cum_aux.dxdMet);";

	$queries['bo'] = "UPDATE fle_del
						inner join shi_dxd_fle_cum_aux
						on 
						(
							fle_del.shiDocNum = shi_dxd_fle_cum_aux.shiDocNum
							and fle_del.pay = shi_dxd_fle_cum_aux.pay
							AND fle_del.per = '" . $_SESSION['periodo'] . "'
							AND shi_dxd_fle_cum_aux.per = '" . $_SESSION['periodo'] . "'
						)
						and shi_dxd_fle_cum_aux.tip in (3)
						and shi_dxd_fle_cum_aux.dxdMet > 0
						set fle_del.dxdTotAux = fle_del.dxdTotAux + (fle_del.netSal * shi_dxd_fle_cum_aux.dxdMet);";

	$queries['bp'] = "UPDATE fle_del
					inner join shi_dxd_fle_cum_aux
					on fle_del.shiDocNum = shi_dxd_fle_cum_aux.shiDocNum
					and fle_del.pay = shi_dxd_fle_cum_aux.pay
					AND fle_del.per = '" . $_SESSION['periodo'] . "'
					AND shi_dxd_fle_cum_aux.per = '" . $_SESSION['periodo'] . "'
					and shi_dxd_fle_cum_aux.tip in (4, 51, 52, 53)
					and shi_dxd_fle_cum_aux.dxdMet > 0
					set fle_del.dxdTotAux = fle_del.dxdTotAux + (fle_del.shiCubMet * shi_dxd_fle_cum_aux.dxdMet);";
					

	//echo "<br>" . var_dump($datosGenerales);
	$resumenUrl = "Resumen: ";		
	foreach($queries as $descripcion => $querie){
		
		if(!$conexion->query($querie)){
			 $resumenUrl = $resumenUrl. "<br><hr>Error: " . $descripcion . "=>" . $querie;
			 
		}else{
			$resumenUrl = $resumenUrl. "<br><hr>Exito: " . $querie;
		}
	}
	
?>