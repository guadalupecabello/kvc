<? 
	/*
	* Rutina para extraer los datos generales del sistema con la finalidad de eficientar los tiempos de carga
	*/

	error_reporting(0);
	
	//Evaluamos si hay un login valido
	extract($_REQUEST);
	
	//Esto es para tener una manra de identificar desde donde se esta llamando si dsde la carpeta Origen o desde el directorio del susbsitema
	//1 Indica que esta siendo llamado desde el cost to serve, cualquier otro valor viene dentro de la carpeta raiz
	if($cts == 1){
		require('funciones.php');
	}else{
		require('../funciones.php');
	}

	//Validamos Login
	validarLogin();

	//Verificamos si se ha recibido un periodo o si no existe tomar como parametro el mas actual
	$conexion = conexion();
	if($_SESSION['periodo'] == '' && $periodo == ''){

		$queryPeriodo = "select max(per) as 'periodo' from periodos";
		$resultado = $conexion->query($queryPeriodo);
		$resultado->fetch_array();
		foreach($resultado as $valor){
			$periodo = $valor['periodo'];
		}

		$_SESSION['periodo'] = $periodo;
		
	}else if($periodo != ''){
		$_SESSION['periodo'] = $periodo;
	}	

	$queries = array();
	
	//Definimos los queries
	
	//Queries para info general
	$queries['a'] = "SELECT ROUND(sum(shiKil), 2) AS 'Kilos', 
							ROUND(sum(shiCubMet), 2) AS 'Metros Cubicos', 
							ROUND(sum(delQua), 0) AS 'Cajas',
						ROUND((sum(cosDel) + sum(gasEve) + sum(fijOutBou)+SUM(outMan)), 2) AS 'Outbound',
						ROUND((sum(ovhDel) + sum(ovhCtaEsp)), 2)AS 'Overhead',
						ROUND((sum(inbOri) + sum(inbDes) + sum(inbRec)), 2) AS 'Inbound',
						ROUND((sum(tplInb) + sum(tplFij) + sum(tplFijRec) + sum(varTplInb) + sum(tplCosCar)) , 2) AS '3PL',
						ROUND(SUM(dxdLogAux)+ SUM(mfmDxd), 2) AS 'Dxd Logistico',
						ROUND(SUM(ren) + SUM(renImpBen) + SUM(renCapOpe), 2) AS 'Renta',
						
						SUM(cosDel) AS 'ob tar bm',
						SUM(gasEve) AS 'ob gas adi bm',
						SUM(fijOutBou) AS 'ob fij bm',
						SUM(outMan) AS 'ob man bm',
						
						SUM(ovhDel) AS 'ovh gen bm',
						SUM(ovhCtaEsp) AS 'ovh cta esp bm',
						
						sum(dxdTotAux) AS 'dxd tot bm',
						sum(mfmDxd) AS 'dxd mfm bm',
						sum(dxdLogAux) AS 'dxd log bm',
						sum(dxdRecAux) AS 'dxd rec bm',
						(sum(dxdLogAux) + sum(mfmDxd)) AS 'dxd bm',
						
						SUM(inbOri) AS 'inb ori bm',
						SUM(inbDes) AS 'inb des bm',
						SUM(inbRec) AS 'inb fij bm',
						
						SUM(tplInb) + SUM(varTplInb)  AS 'tpl inb bm',
						SUM(tplFij) AS 'tpl fij bm',
						SUM(tplCosCar) AS 'tpl cos car bm',
						SUM(tplFijRec) AS 'tpl fij rec bm',
						SUM(varTplInb) AS 'tpl var inb',

						SUM(ren) AS 'rta bm',
						SUM(renImpBen) AS 'rta imp ben bm',
						SUM(renCapOpe) AS 'rta cap ope bm'
						
				FROM fle_del
				where per = '" . $_SESSION['periodo'] . "'";
	
	$queries['b'] = "SELECT SUM(tplCosCar) AS 'Costo Carga' FROM fle_del";
	
	$queries['c'] = "SELECT val AS 'Costo Renta' 
					FROM var_ent 
					WHERE nom like 'cosRen'
					AND per = '" . $_SESSION['periodo'] . "';";

	$queries['cccccc'] = "SELECT val AS 'Renta Impactos Beneficios' 
						FROM var_ent 
						WHERE nom like 'renInpBen'
						AND per = '" . $_SESSION['periodo'] . "';";
	
	
	//Ren
	$queries['v'] = "SELECT val AS 'rta or'
	FROM var_ent
	WHERE nom like 'cosRen'
	AND per = '" . $_SESSION['periodo'] . "'";
	
	$queries['w'] = "SELECT sum(val) AS 'rta inp ben or'
	FROM ren_imp_ben
	WHERE per = '" . $_SESSION['periodo'] . "'";
	
	//tpl	
	$queries['m'] = "SELECT sum(inb) AS 'tpl inb or'
					from inp_3pl
					WHERE per = '" . $_SESSION['periodo'] . "'";
						
	$queries['n'] = "select sum(fij) AS 'tpl fij or'
					from inp_3pl
					WHERE per = '" . $_SESSION['periodo'] . "'";
						
	$queries['o'] = "SELECT SUM(cosCar) AS 'tpl cos car or'
			FROM fle_pic_dep
			WHERE per = '" . $_SESSION['periodo'] . "'";
	
	$queries['p'] = "SELECT val AS 'tpl fij rec or'
			FROM var_ent
			WHERE nom = 'tplFijRec'
			AND per = '" . $_SESSION['periodo'] . "';";
	
	//Inb
	$queries['q'] = "SELECT sum(inp_inb.gasTot) AS 'inb ori or'
						FROM inp_inb
						WHERE inp_inb.pla > 0 
						AND per = '" . $_SESSION['periodo'] . "'";

	$queries['r'] = "SELECT sum(inp_inb.gasTot) AS 'inb des or'
					FROM inp_inb
					WHERE (shiPoi IS NOT NULL AND shiPoi > 0)
					AND (inp_inb.pla = 0 
					OR inp_inb.pla IS NULL)
					AND per = '" . $_SESSION['periodo'] . "'";
			
	$queries['s'] = "SELECT val AS 'inb fij or'
			FROM var_ent
			WHERE nom = 'inbFij'
			AND per = '" . $_SESSION['periodo'] . "';";
	// echo $queries['s'];
	
	//Queries para Outbound
	$queries['d'] = "SELECT SUM(cos) AS 'ob tar or'
							FROM fletes
							WHERE per = '" . $_SESSION['periodo'] . "'";
	$queries['e'] = "SELECT SUM(tot) AS 'ob gas adi or'
								FROM gas_eve
								WHERE per = '" . $_SESSION['periodo'] . "'";
	$queries['f'] = "SELECT SUM(mon) AS 'ob fij or'
								FROM inp_fij_out_bou
								WHERE per = '" . $_SESSION['periodo'] . "'";
	$queries['g'] = "SELECT SUM(man) AS 'ob man or'
								FROM inp_dxd_mfm
								WHERE per = '" . $_SESSION['periodo'] . "'";
								
	//Queries para overhead
	$queries['h'] = "SELECT SUM(totCta) AS 'ovh gen or'
		FROM inp_ovh
		WHERE cal LIKE '%si%'
		AND per = '" . $_SESSION['periodo']. "';";
		
	$queries['i'] = "SELECT sum(((actCur + sum) - ((actCur + sum)*por))) AS 'ovh cta esp or'
					FROM inp_ovh
					WHERE cta > 0
					AND per = '" . $_SESSION['periodo']. "';";

	//Dxd

	$queries['j'] = "select sum(dxd) AS 'dxd tot or'
					from dxd_liz
					where per = '" . $_SESSION['periodo'] . "'";
				
	$queries['k'] = "select (sum(filRat) + sum(mer)+ sum(pro) + sum(benImp) + sum(citPer) + sum(por)) AS 'dxd mfm or'
			from inp_dxd_mfm
			where per = '" . $_SESSION['periodo'] . "';";

	$queries['l'] = "select sum(allo) AS 'dxd rec or'
				from dxd_rec_liz
				where per = '" . $_SESSION['periodo'] . "';";
				
	//Procesamos los Queries
	agregarDatosGenerales($queries);
	
	//Agregamos los datos derivados de los queries
	
	$_SESSION['Total Costo Distribucion'] = $_SESSION['Outbound'] + 
									$_SESSION['Overhead'] + 
									$_SESSION['Inbound'] + 
									($_SESSION['3PL'] ) + 
									$_SESSION['Dxd Logistico'] + +
									$_SESSION['Renta'];
	
	$_SESSION['Total Costo Distribucion f'] = number_format($_SESSION['Total Costo Distribucion'], 2);
	
	$_SESSION['Total Costo Distribucion / Kilos'] = number_format($_SESSION['Total Costo Distribucion'] / $_SESSION['Kilos'], 2);
	
	//Totales entre metricas
	$_SESSION['ob/kg'] = $_SESSION['Outbound'] / $_SESSION['Kilos'];
	$_SESSION['ob/kg f'] = number_format($_SESSION['ob/kg'], 2);
	$_SESSION['ob/m3'] = $_SESSION['Outbound'] / $_SESSION['Metros Cubicos'];
	$_SESSION['ob/m3 f'] = number_format($_SESSION['ob/m3'], 2);
	$_SESSION['ob/cs'] = $_SESSION['Outbound'] / $_SESSION['Cajas'];
	$_SESSION['ob/cs f'] = number_format($_SESSION['ob/cs'], 2);
	
	$_SESSION['ovh/kg'] = $_SESSION['Overhead'] / $_SESSION['Kilos'];
	$_SESSION['ovh/kg f'] = number_format($_SESSION['ovh/kg'], 2);
	$_SESSION['ovh/m3'] = $_SESSION['Overhead'] / $_SESSION['Metros Cubicos'];
	$_SESSION['ovh/m3 f'] = number_format($_SESSION['ovh/m3'], 2);
	$_SESSION['ovh/cs'] = $_SESSION['Overhead'] / $_SESSION['Cajas'];
	$_SESSION['ovh/cs f'] = number_format($_SESSION['ovh/cs'], 2);
	
	$_SESSION['dxd/kg'] = $_SESSION['Dxd Logistico'] / $_SESSION['Kilos'];
	$_SESSION['dxd/kg f'] = number_format($_SESSION['dxd/kg'], 2);
	$_SESSION['dxd/m3'] = $_SESSION['Dxd Logistico'] / $_SESSION['Metros Cubicos'];
	$_SESSION['dxd/m3 f'] = number_format($_SESSION['dxd/m3'], 2);
	$_SESSION['dxd/cs'] = $_SESSION['Dxd Logistico'] / $_SESSION['Cajas'];
	$_SESSION['dxd/cs f'] = number_format($_SESSION['dxd/cs'], 2);
	
	$_SESSION['dxd log or'] = $_SESSION['dxd tot or'] - $_SESSION['dxd rec or'];
	$_SESSION['dxd log or f'] = number_format($_SESSION['dxd log or'], 2);



	$_SESSION['inb/kg'] = $_SESSION['Inbound'] / $_SESSION['Kilos'];
	$_SESSION['inb/kg f'] = number_format($_SESSION['inb/kg'], 2);
	$_SESSION['inb/m3'] = $_SESSION['Inbound'] / $_SESSION['Metros Cubicos'];
	$_SESSION['inb/m3 f'] = number_format($_SESSION['inb/m3'], 2);
	$_SESSION['inb/cs'] = $_SESSION['Inbound'] / $_SESSION['Cajas'];
	$_SESSION['inb/cs f'] = number_format($_SESSION['inb/cs'], 2);
	
	$_SESSION['tpl/kg'] = $_SESSION['3PL'] / $_SESSION['Kilos'];
	$_SESSION['tpl/kg f'] = number_format($_SESSION['tpl/kg'], 2);
	$_SESSION['tpl/m3'] = $_SESSION['3PL'] / $_SESSION['Metros Cubicos'];
	$_SESSION['tpl/m3 f'] = number_format($_SESSION['tpl/m3'], 2);
	$_SESSION['tpl/cs'] = $_SESSION['3PL'] / $_SESSION['Cajas'];
	$_SESSION['tpl/cs f'] = number_format($_SESSION['tpl/cs'], 2);
	
	$_SESSION['rta/kg'] = $_SESSION['Renta'] / $_SESSION['Kilos'];
	$_SESSION['rta/kg f'] = number_format($_SESSION['rta/kg'], 2);
	$_SESSION['rta/m3'] = $_SESSION['Renta'] / $_SESSION['Metros Cubicos'];
	$_SESSION['rta/m3 f'] = number_format($_SESSION['rta/m3'], 2);
	$_SESSION['rta/cs'] = $_SESSION['Renta'] / $_SESSION['Cajas'];
	$_SESSION['rta/cs f'] = number_format($_SESSION['rta/cs'], 2);
	
	
	$_SESSION['ob or'] = $_SESSION['ob tar or'] + $_SESSION['ob gas adi or'] + $_SESSION['ob fij or'] + $_SESSION['ob man or'];
	$_SESSION['ob or f'] = number_format($_SESSION['ob or'], 2);
	$_SESSION['ob bm'] = $_SESSION['ob tar bm'] + $_SESSION['ob gas adi bm'] + $_SESSION['ob fij bm'] + $_SESSION['ob man bm'];
	$_SESSION['ob bm f'] = number_format($_SESSION['ob bm'], 2);
	
	$_SESSION['ovh or'] = $_SESSION['ovh gen or'] + $_SESSION['ovh cta esp or'];
	$_SESSION['ovh or f'] = number_format($_SESSION['ovh or'],2);
	
	$_SESSION['ovh bm'] = $_SESSION['ovh gen bm'] + $_SESSION['ovh cta esp bm'];
	$_SESSION['ovh bm f'] = number_format($_SESSION['ovh bm'],2);
	
	$_SESSION['tpl or f'] = number_format($_SESSION['tpl inb or'] + $_SESSION['tpl fij or'] + $_SESSION['tpl cos car or'] + $_SESSION['tpl fij rec or'],2);
	
	$_SESSION['tpl bm f'] = number_format($_SESSION['tpl inb bm'] + $_SESSION['tpl fij bm'] + $_SESSION['tpl cos car bm'] + $_SESSION['tpl fij rec bm'], 2);
	
	//Renta y capacidad operativa
	// $_SESSION['rta cap op'] = number_format((($_SESSION['rta bm'] + $_SESSION['rta inp ben bm']) - $_SESSION['rta bm']), 2);
	
	$tabla = "<table>";
	
	foreach($_SESSION as $campo => $valor){
		$tabla .= "<tr>";
			$tabla .= "<td>";
				$tabla .= $campo;
			$tabla .= "</td>";
			$tabla .= "<td>";
				$tabla .= $valor;
			$tabla .= "</td>";
		$tabla .= "</tr>";
	}
	
	$tabla .= "</table>";
	 // echo $tabla;

	if($periodo != ''){
		// echo "¡Hecho!";
	}

?>