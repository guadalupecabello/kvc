<? 
	/*
	* Rutina para extraer los datos generales del sistema con la finalidad de eficientar los tiempos de carga
	*/
	if(!$_SESSION['sesion']){
		session_start();
	}
	
	//Evaluamos si hay un login valido
	if($_SESSION['sesion'] == 1){
		
		
			require('agrDatGen.php');
		
		$queries = array();
		
		//Definimos los queries
		
		//Queries para info general
		$queries['a'] = "SELECT ROUND(sum(shiKil), 2) AS 'Kilos', 
								ROUND(sum(shiCubMet), 2) AS 'Metros Cubicos', 
								ROUND(sum(delQua), 0) AS 'Cajas',
							ROUND((sum(cosDel) + sum(gasEve) + sum(fijOutBou)), 2) AS 'Outbound',
							ROUND((sum(ovhDel) + sum(ovhCtaEsp)), 2)AS 'Overhead',
							ROUND((sum(inbOri) + sum(inbDes) + sum(inbRec)), 2) AS 'Inbound',
							ROUND((sum(tplInb) + sum(tplFij) + sum(tplFijRec)), 2) AS '3PL',
							ROUND(SUM(dxdLogAux), 2) AS 'Dxd Logistico',
							
							SUM(cosDel) AS 'ob tar bm',
							SUM(gasEve) AS 'ob gas adi bm',
							SUM(fijOutBou) AS 'ob fij bm',
							SUM(outMan) AS 'ob man bm'
							
							
					FROM fle_del";
		
		$queries['b'] = "SELECT SUM(cosCar) AS 'Costo Carga' FROM fle_pic_dep";
		$queries['c'] = "SELECT val AS 'Costo Renta' FROM var_ent WHERE nom like 'cosRen';";
		
		//Queries para Outbound
		$queries['totTarBas'] = "SELECT SUM(cos) AS 'ob tar or'
								FROM fletes";
		$queries['totGasEveBas'] = "SELECT SUM(tot) AS 'ob gas adi or'
									FROM gas_eve";
		$queries['totGasFijBas'] = "SELECT SUM(mon) AS 'ob fij or'
									FROM inp_fij_out_bou";
		$queries['totManBasOri'] = "SELECT SUM(man) AS 'ob man or'
									FROM inp_dxd_mfm";
		
		//Procesamos los Queries
		agregarDatosGenerales($queries);
		
		//Agregamos los datos derivados de los queries
		$_SESSION['Total Costo Distribucion'] = $_SESSION['Outbound'] + 
												$_SESSION['Overhead'] + 
												$_SESSION['Inbound'] + 
												$_SESSION['3PL'] + 
												$_SESSION['Dxd Logistico'] + 
												$_SESSION['Costo Carga'] +
												$_SESSION['Costo Renta'];
												
		$_SESSION['3PL'] = $_SESSION['3PL'] + $_SESSION['Costo Carga'];
		
		
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
		
		$_SESSION['rta/kg'] = $_SESSION['Costo Renta'] / $_SESSION['Kilos'];
		$_SESSION['rta/kg f'] = number_format($_SESSION['rta/kg'], 2);
		$_SESSION['rta/m3'] = $_SESSION['Costo Renta'] / $_SESSION['Metros Cubicos'];
		$_SESSION['rta/m3 f'] = number_format($_SESSION['rta/m3'], 2);
		$_SESSION['rta/cs'] = $_SESSION['Costo Renta'] / $_SESSION['Cajas'];
		$_SESSION['rta/cs f'] = number_format($_SESSION['rta/cs'], 2);
		
		
		$_SESSION['ob or'] = $_SESSION['ob tar or'] + $_SESSION['ob gas adi or'] + $_SESSION['ob fij or'] + $_SESSION['ob man or'];
		$_SESSION['ob or f'] = number_format($_SESSION['ob or'], 2);
		$_SESSION['ob bm'] = $_SESSION['ob tar bm'] + $_SESSION['ob gas adi bm'] + $_SESSION['ob fij bm'] + $_SESSION['ob man bm'];
		$_SESSION['ob bm f'] = number_format($_SESSION['ob bm'], 2);
		
		//echo var_dump($_SESSION);
		
	}else{
		//Si no hay una sesion valida redireccionamos al login
		session_destroy();
		header('Location: ../index.php');
	}
	
?>