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
	
	$queries['a'] = "UPDATE dxd_rec_liz
					set tip = 0
					WHERE per = '" . $_SESSION['periodo'] . "';";

	$queries['b'] = "UPDATE dxd_rec_liz
					inner join fac_dxd
					on dxd_rec_liz.solToPar = fac_dxd.shiToPar
					and dxd_rec_liz.per = '" . $_SESSION['periodo'] . "'
					set dxd_rec_liz.tip = fac_dxd.tip;";

	$queries['c'] = "UPDATE dxd_rec_liz
					set totMet = 0
					WHERE per = '" . $_SESSION['periodo'] . "';";

	$queries['d'] = "UPDATE dxd_rec_liz
					set totMet = (
						select sum(groSal)
						from shi_dxd_fle_cum_aux
						where shi_dxd_fle_cum_aux.solToPar = dxd_rec_liz.solToPar
						and shi_dxd_fle_cum_aux.per = '" . $_SESSION['periodo'] . "'
						and dxd_rec_liz.per = '" . $_SESSION['periodo'] . "'

					)
					where tip = 1
					and dxd_rec_liz.per = '" . $_SESSION['periodo'] . "';";

	$queries['e'] = "UPDATE dxd_rec_liz
					set totMet = (
						select sum(groSal)
						from shi_dxd_fle_cum_aux
						where shi_dxd_fle_cum_aux.solToPar = dxd_rec_liz.solToPar
						and shi_dxd_fle_cum_aux.per = '" . $_SESSION['periodo'] . "'
						and dxd_rec_liz.per = '" . $_SESSION['periodo'] . "'
					)
					where tip = 2
					and dxd_rec_liz.per = '" . $_SESSION['periodo'] . "';";

	$queries['f'] = "UPDATE dxd_rec_liz
					set totMet = (
						select sum(netSal)
						from shi_dxd_fle_cum_aux
						where shi_dxd_fle_cum_aux.solToPar = dxd_rec_liz.solToPar
						and shi_dxd_fle_cum_aux.per = '" . $_SESSION['periodo'] . "'
						and dxd_rec_liz.per = '" . $_SESSION['periodo'] . "'
					)
					where tip = 3
					and dxd_rec_liz.per = '" . $_SESSION['periodo'] . "';";
	
	$queries['g'] = "UPDATE dxd_rec_liz
					set totMet = (
						select sum(shiCubMet)
						from shi_dxd_fle_cum_aux
						where shi_dxd_fle_cum_aux.solToPar = dxd_rec_liz.solToPar
						and shi_dxd_fle_cum_aux.per = '" . $_SESSION['periodo'] . "'
						and dxd_rec_liz.per = '" . $_SESSION['periodo'] . "'
					)
					where tip = 4
					and dxd_rec_liz.per = '" . $_SESSION['periodo'] . "';";

	$queries['h'] = "UPDATE dxd_rec_liz
					set totMet = (
						select sum(shiCubMet)
						from shi_dxd_fle_cum_aux
						where shi_dxd_fle_cum_aux.solToPar = dxd_rec_liz.solToPar
						and shi_dxd_fle_cum_aux.per = '" . $_SESSION['periodo'] . "'
						and dxd_rec_liz.per = '" . $_SESSION['periodo'] . "'
					)
					where tip = 51
					and dxd_rec_liz.per = '" . $_SESSION['periodo'] . "';";

	$queries['i'] = "UPDATE dxd_rec_liz
					set totMet = (
						select sum(shiCubMet)
						from shi_dxd_fle_cum_aux
						where shi_dxd_fle_cum_aux.solToPar = dxd_rec_liz.solToPar
						and shi_dxd_fle_cum_aux.per = '" . $_SESSION['periodo'] . "'
						and dxd_rec_liz.per = '" . $_SESSION['periodo'] . "'
					)
					where tip = 52
					and dxd_rec_liz.per = '" . $_SESSION['periodo'] . "';";

	$queries['j'] = "UPDATE dxd_rec_liz
					set totMet = (
						select sum(shiCubMet)
						from shi_dxd_fle_cum_aux
						where shi_dxd_fle_cum_aux.solToPar = dxd_rec_liz.solToPar
						and shi_dxd_fle_cum_aux.per = '" . $_SESSION['periodo'] . "'
						and dxd_rec_liz.per = '" . $_SESSION['periodo'] . "'
					)
					where tip = 53
					and dxd_rec_liz.per = '" . $_SESSION['periodo'] . "';";

	$queries['l'] = "UPDATE dxd_rec_liz
					set totMet = 0
					where totMet IS NULL
					and per = '" . $_SESSION['periodo'] . "';";

	$queries['o'] = "UPDATE dxd_rec_liz
					set allMet = 0
					and per = '" . $_SESSION['periodo'] . "';";

	$queries['m'] = "UPDATE dxd_rec_liz
					set allMet = allo / totMet
					where allo > 0 AND totMet > 0
					and per = '" . $_SESSION['periodo'] . "';";


	$queries['n'] = "UPDATE dxd_rec_liz
					set allMet = 0
					where allMet IS NULL
					and per = '" . $_SESSION['periodo'] . "';";


	$queries['o'] = "UPDATE shi_dxd_fle_cum_aux
					set dxdMet = 0
					WHERE per = '" . $_SESSION['periodo'] . "';";


	$queries['p'] = "UPDATE shi_dxd_fle_cum_aux
					inner join dxd_rec_liz
					on shi_dxd_fle_cum_aux.solToPar = dxd_rec_liz.solToPar

					and shi_dxd_fle_cum_aux.per = '" . $_SESSION['periodo'] . "'
					and dxd_rec_liz.per = '" . $_SESSION['periodo'] . "'

					set shi_dxd_fle_cum_aux.dxdMet = dxd_rec_liz.allMet;";



	$queries['q'] = "UPDATE shi_dxd_fle_cum_aux
					inner join fac_dxd
					on shi_dxd_fle_cum_aux.solToPar = fac_dxd.shiToPar
					and shi_dxd_fle_cum_aux.per = '" . $_SESSION['periodo'] . "'
					set shi_dxd_fle_cum_aux.tip = fac_dxd.tip";

	$queries['r'] = "UPDATE fle_del
					set dxdRecAux = 0
					where per = '" . $_SESSION['periodo'] . "';";

	$queries['s'] = "UPDATE fle_del
					inner join shi_dxd_fle_cum_aux
					on 
					(
						fle_del.solToPar = shi_dxd_fle_cum_aux.solToPar
						AND fle_del.shiDocNum = shi_dxd_fle_cum_aux.shiDocNum
						and fle_del.per = '" . $_SESSION['periodo'] . "'
						and shi_dxd_fle_cum_aux.per = '" . $_SESSION['periodo'] . "'

					)
					and shi_dxd_fle_cum_aux.tip in (1, 2)
					set fle_del.dxdRecAux = fle_del.dxdRecAux + (fle_del.groSal * shi_dxd_fle_cum_aux.dxdMet);";


	$queries['t'] = "UPDATE fle_del
					inner join shi_dxd_fle_cum_aux
					on (
						fle_del.shiDocNum = shi_dxd_fle_cum_aux.shiDocNum
						and fle_del.solToPar = shi_dxd_fle_cum_aux.solToPar
						and fle_del.per = '" . $_SESSION['periodo'] . "'
						and shi_dxd_fle_cum_aux.per = '" . $_SESSION['periodo'] . "'
					)
					and shi_dxd_fle_cum_aux.tip in (3)
					set fle_del.dxdRecAux = fle_del.dxdRecAux + (fle_del.netSal * shi_dxd_fle_cum_aux.dxdMet);";

	$queries['u'] = "UPDATE fle_del
					inner join shi_dxd_fle_cum_aux
					on fle_del.shiDocNum = shi_dxd_fle_cum_aux.shiDocNum
					and fle_del.solToPar = shi_dxd_fle_cum_aux.solToPar
					and fle_del.per = '" . $_SESSION['periodo'] . "'
					and shi_dxd_fle_cum_aux.per = '" . $_SESSION['periodo'] . "'
					and shi_dxd_fle_cum_aux.tip in (4, 51, 52, 53)
					set fle_del.dxdRecAux = fle_del.dxdRecAux + (fle_del.shiCubMet * shi_dxd_fle_cum_aux.dxdMet);";

	$queries['v'] = "DELETE from dxd_rec_liz_pay
					WHERE per = '" . $_SESSION['periodo'] . "';";

	$queries['w'] = "INSERT into dxd_rec_liz_pay(
						select per, pay, sum(allo), 0, 0, 0
						from dxd_rec_liz
						where allMet = 0
						and per = '" . $_SESSION['periodo'] . "'
						group by per, pay
					)
			";
	$queries['x'] = "UPDATE dxd_rec_liz_pay
					set dxd_rec_liz_pay.tip = 0
					WHERE per = '" . $_SESSION['periodo'] . "';";

	$queries['y'] = "UPDATE dxd_rec_liz_pay
					inner join fac_dxd
					on dxd_rec_liz_pay.pay = fac_dxd.pay
					and dxd_rec_liz_pay.per = '" . $_SESSION['periodo'] . "'
					set dxd_rec_liz_pay.tip = fac_dxd.tip;";

	$queries['z'] = "UPDATE dxd_rec_liz_pay
					set totMet = (
						select sum(groSal)
						from shi_dxd_fle_cum_aux
						where shi_dxd_fle_cum_aux.pay = dxd_rec_liz_pay.pay
						and shi_dxd_fle_cum_aux.per = '" . $_SESSION['periodo'] . "'
						and dxd_rec_liz_pay.per = '" . $_SESSION['periodo'] . "'
					)
					where tip = 1;";
	
	$queries['aa'] = "UPDATE dxd_rec_liz_pay

					set totMet = (
						select sum(groSal)
						from shi_dxd_fle_cum_aux
						where shi_dxd_fle_cum_aux.pay = dxd_rec_liz_pay.pay
						and shi_dxd_fle_cum_aux.per = '" . $_SESSION['periodo'] . "'
						and dxd_rec_liz_pay.per = '" . $_SESSION['periodo'] . "'
					)
					where tip = 2;";
	
	$queries['ab'] = "UPDATE dxd_rec_liz_pay
					set totMet = (
						select sum(netSal)
						from shi_dxd_fle_cum_aux
						where shi_dxd_fle_cum_aux.pay = dxd_rec_liz_pay.pay
						and shi_dxd_fle_cum_aux.per = '" . $_SESSION['periodo'] . "'
						and dxd_rec_liz_pay.per = '" . $_SESSION['periodo'] . "'
					)
					where tip = 3;";

	$queries['ac'] = "UPDATE dxd_rec_liz_pay
					set totMet = (
						select sum(shiCubMet)
						from shi_dxd_fle_cum_aux
						where shi_dxd_fle_cum_aux.pay = dxd_rec_liz_pay.pay
						and shi_dxd_fle_cum_aux.per = '" . $_SESSION['periodo'] . "'
						and dxd_rec_liz_pay.per = '" . $_SESSION['periodo'] . "'
					)
					where tip = 4;";
	$queries['ad'] = "UPDATE dxd_rec_liz_pay
					set totMet = (
						select sum(shiCubMet)
						from shi_dxd_fle_cum_aux
						where shi_dxd_fle_cum_aux.pay = dxd_rec_liz_pay.pay
						and shi_dxd_fle_cum_aux.per = '" . $_SESSION['periodo'] . "'
						and dxd_rec_liz_pay.per = '" . $_SESSION['periodo'] . "'
					)
					where tip = 51;";

	$queries['ae'] = "UPDATE dxd_rec_liz_pay
					set totMet = (
						select sum(shiCubMet)
						from shi_dxd_fle_cum_aux
						where shi_dxd_fle_cum_aux.pay = dxd_rec_liz_pay.pay
						and shi_dxd_fle_cum_aux.per = '" . $_SESSION['periodo'] . "'
						and dxd_rec_liz_pay.per = '" . $_SESSION['periodo'] . "'

					)
					where tip = 52;";
	$queries['af'] = "UPDATE dxd_rec_liz_pay
					set totMet = (
						select sum(shiCubMet)
						from shi_dxd_fle_cum_aux
						where shi_dxd_fle_cum_aux.pay = dxd_rec_liz_pay.pay
						and shi_dxd_fle_cum_aux.per = '" . $_SESSION['periodo'] . "'
						and dxd_rec_liz_pay.per = '" . $_SESSION['periodo'] . "'
					)
					where tip = 53;";

	$queries['ag'] = "UPDATE dxd_rec_liz_pay
					set allMet = allo / totMet
					where allo > 0 AND totMet > 0
					and per = '" . $_SESSION['periodo'] . "';";


	$queries['ah'] = "UPDATE dxd_rec_liz_pay
					set allMet = 0
					where allMet IS NULL
					and per = '" . $_SESSION['periodo'] . "';";

	$queries['ai'] = "UPDATE shi_dxd_fle_cum_aux
					set dxdMet = 0
					WHERE per = '" . $_SESSION['periodo'] . "';";

	$queries['aj'] = "UPDATE shi_dxd_fle_cum_aux
					inner join dxd_rec_liz_pay
					on shi_dxd_fle_cum_aux.pay = dxd_rec_liz_pay.pay
					and shi_dxd_fle_cum_aux.per = '" . $_SESSION['periodo'] . "'
					and dxd_rec_liz_pay.per = '" . $_SESSION['periodo'] . "'
					set shi_dxd_fle_cum_aux.dxdMet = dxd_rec_liz_pay.allMet;";

	$queries['al'] = "UPDATE fle_del
					inner join shi_dxd_fle_cum_aux
					on 
					(
						fle_del.pay = shi_dxd_fle_cum_aux.pay
						AND fle_del.shiDocNum = shi_dxd_fle_cum_aux.shiDocNum
						and fle_del.per = '" . $_SESSION['periodo'] . "'
						and shi_dxd_fle_cum_aux.per = '" . $_SESSION['periodo'] . "'
					)
					and shi_dxd_fle_cum_aux.tip in (1, 2)
					set fle_del.dxdRecAux = fle_del.dxdRecAux  + (fle_del.groSal * shi_dxd_fle_cum_aux.dxdMet);";
	
	$queries['am'] = "UPDATE fle_del
						inner join shi_dxd_fle_cum_aux
						on (fle_del.shiDocNum = shi_dxd_fle_cum_aux.shiDocNum
						and fle_del.pay = shi_dxd_fle_cum_aux.pay
						and fle_del.per = '" . $_SESSION['periodo'] . "'
						and shi_dxd_fle_cum_aux.per = '" . $_SESSION['periodo'] . "')
						and shi_dxd_fle_cum_aux.tip in (3)
						set fle_del.dxdRecAux = fle_del.dxdRecAux  + (fle_del.netSal * shi_dxd_fle_cum_aux.dxdMet);";
	
	$queries['an'] = "UPDATE fle_del
						inner join shi_dxd_fle_cum_aux
						on fle_del.shiDocNum = shi_dxd_fle_cum_aux.shiDocNum
						and fle_del.pay = shi_dxd_fle_cum_aux.pay
						and fle_del.per = '" . $_SESSION['periodo'] . "'
						and shi_dxd_fle_cum_aux.per = '" . $_SESSION['periodo'] . "'
						and shi_dxd_fle_cum_aux.tip in (4, 51, 52, 53)
						set fle_del.dxdRecAux = fle_del.dxdRecAux  + (fle_del.shiCubMet * shi_dxd_fle_cum_aux.dxdMet);";
	

	//echo "<br>" . var_dump($datosGenerales);
	$resumenUrl = "Resumen: ";		
	foreach($queries as $descripcion => $querie){
		//echo "<br>" . $querie;
		if(!$conexion->query($querie)){
			 $resumenUrl = $resumenUrl. "<br><hr>Error: " . $descripcion . "=>" . $querie;
		}else{
			$resumenUrl = $resumenUrl. "<br><hr>Exito: " . $querie;
		}
	}
	
?>