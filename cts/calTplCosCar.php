<? 

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
	
	$queries['a'] = "DELETE FROM fle_pic
					WHERE (shiDocNum < 500000
					OR shiDocNum IS NULL)
					AND per = '" . $_SESSION['periodo'] . "';";

	$queries['d'] = "UPDATE fle_pic
					INNER JOIN pay_shi_sol
					ON fle_pic.shiToPar = pay_shi_sol.shiToPar
					AND fle_pic.per = '" . $_SESSION['periodo'] . "'
					SET fle_pic.pay = pay_shi_sol.pay";
	
	
	$queries['b'] = "UPDATE fle_pic
					SET
						cosCaj = 0,
						cosMatFle = 0,
						cosTotCaj = 0,
						cosCar = 0
					WHERE fle_pic.per = '" . $_SESSION['periodo'] . "';";

	$queries['c'] = "UPDATE fle_pic
					SET porPic = 0
					WHERE porPic IS NULL
					AND per = '" . $_SESSION['periodo'] . "';";
	
	$queries['e'] = "UPDATE fle_pic
					INNER JOIN tab_por
					ON fle_pic.pay = tab_por.pay
					AND fle_pic.per = '" . $_SESSION['periodo'] . "'
					AND tab_por.pay > 0
					SET fle_pic.cosMatFle = tab_por.cosMat;";

	$queries['f'] = "UPDATE fle_pic
					SET pay = 0
					WHERE cosMatFle = 0
					AND per = '" . $_SESSION['periodo'] . "';";

	$queries['g'] = "UPDATE fle_pic
					INNER JOIN tab_por
					ON fle_pic.pay = tab_por.pay
					AND fle_pic.per = '" . $_SESSION['periodo'] . "'
					AND tab_por.pay = 0
					SET fle_pic.cosMatFle = tab_por.cosMat;";

	$queries['h'] = "UPDATE fle_pic
					INNER JOIN tab_por
					on (fle_pic.porPic >= 0 AND fle_pic.porPic <= 19)
					AND fle_pic.pay = tab_por.pay
					AND fle_pic.per = '" . $_SESSION['periodo'] . "'
					set fle_pic.cosCaj = tab_por.val0019;";

	$queries['i'] = "UPDATE fle_pic
					INNER JOIN tab_por
					on (fle_pic.porPic >= 20 AND fle_pic.porPic <= 29)
					AND fle_pic.pay = tab_por.pay
					AND fle_pic.per = '" . $_SESSION['periodo'] . "'
					set fle_pic.cosCaj = tab_por.val2029;";

	$queries['j'] = "UPDATE fle_pic
					INNER JOIN tab_por
					on (fle_pic.porPic >= 30 AND fle_pic.porPic <= 39)
					AND fle_pic.pay = tab_por.pay
					AND fle_pic.per = '" . $_SESSION['periodo'] . "'
					set fle_pic.cosCaj = tab_por.val3039;";

	$queries['k'] = "UPDATE fle_pic
					INNER JOIN tab_por
					on (fle_pic.porPic >= 40 AND fle_pic.porPic <= 59)
					AND fle_pic.pay = tab_por.pay
					AND fle_pic.per = '" . $_SESSION['periodo'] . "'
					set fle_pic.cosCaj = tab_por.val4059;";

	$queries['l'] = "UPDATE fle_pic
					INNER JOIN tab_por
					on (fle_pic.porPic >= 60 AND fle_pic.porPic <= 79)
					AND fle_pic.pay = tab_por.pay
					AND fle_pic.per = '" . $_SESSION['periodo'] . "'
					set fle_pic.cosCaj = tab_por.val6079;";

	$queries['m'] = "UPDATE fle_pic
					INNER JOIN tab_por
					on (fle_pic.porPic >= 80 AND fle_pic.porPic <= 100)
					AND fle_pic.pay = tab_por.pay
					AND fle_pic.per = '" . $_SESSION['periodo'] . "'
					set fle_pic.cosCaj = tab_por.val80100;";
					
	//Insertamos los registros unicos en la tabla depurada
	$queries['s'] = "DELETE from fle_pic_dep
					WHERE per = '" . $_SESSION['periodo'] . "'";

	$queries['t'] = "INSERT into fle_pic_dep(
						SELECT per, shiDocNum, porPic, cosCaj, cosMatFle, 0,0, 0, 0
						from fle_pic
						WHERE per = '" . $_SESSION['periodo'] . "'
						group by per, shiDocNum
					);";

	//Actualizamos las cajas de cada flete en picking de acuerdo a lo existente en Base Maesrra
	$queries['u'] = "delete from fle_del_qua
					WHERE per = '" . $_SESSION['periodo'] . "';";
	
	$queries['v'] = "insert into fle_del_qua(
						select per, shiDocNum, sum(delQua)
						from fle_del
						WHERE per = '" . $_SESSION['periodo'] . "'
						group by per, shiDocNum
					);";
	
	
					
	$queries['w'] = "UPDATE fle_pic_dep
					inner join fle_del_qua
					on fle_pic_dep.shiDocNum = fle_del_qua.shiDocNum
					AND fle_pic_dep.per = '" . $_SESSION['periodo'] . "'
					set fle_pic_dep.delQua = fle_del_qua.delQua;";

	//Calculamos los datos adicionales de la tabla de picking
	$queries['n'] = "UPDATE fle_pic_dep
					SET cosTotCaj = (cosCaj * delQua),
					cosCar = ((cosCaj * delQua) + cosMatFle)
					WHERE per = '" . $_SESSION['periodo'] . "';";
					
	$queries['p'] = "UPDATE fle_pic_dep
					 SET cosCarCaj = cosCar / delQua
					 where cosCar > 0 and delQua > 0
					 AND per = '" . $_SESSION['periodo'] . "';";
					
	$queries['q'] = "UPDATE fle_del
					SET tplCosCar = 0
					WHERE per = '" . $_SESSION['periodo'] . "';";

	//Bajamos a nivel clave
	$queries['r'] = "UPDATE fle_del
					INNER JOIN fle_pic_dep
					ON fle_del.shiDocNum = fle_pic_dep.shiDocNum
					AND fle_del.per = '" . $_SESSION['periodo'] . "'
					AND fle_pic_dep.per = '" . $_SESSION['periodo'] . "'
					SET fle_del.tplCosCar = fle_del.delQua * fle_pic_dep.cosCarCaj;";

	//echo "<br>" . var_dump($datosGenerales);
	$resumenUrl = "Resumen: ";		
	foreach($queries as $descripcion => $querie){
		//echo "<br>" . $querie;
		if(!$conexion->query($querie)){
			 $resumenUrl = $resumenUrl. "<br><br>Error: " . $descripcion . "=>" . $conexion->error;
		}else{
			$resumenUrl = $resumenUrl. "<br><br>Exito: " . $querie;
		}
	}
		
?>