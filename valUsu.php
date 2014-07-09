<? 
	
	require('funciones.php');

	//Desactivamos los errores
	error_reporting(E_ALL);
	
	//Declaramos la funcion de limpiado
	function limpiar($cadena){
	 	return addslashes(stripslashes(strip_tags(htmlentities($cadena))));
	}
	
	//Limpiamos las variables
	foreach($_POST as $indice => $valor){
		$_POST[$indice] = limpiar($valor);
	}
	
	//Extraemos las variables
	extract($_POST);
	
	//Definimos nuestros auxiliares para la respuesta al cliente
	$respuesta = array();
	$mensaje = "";
	$sesion = 0;
	
	//Creamos la conexion, ejecutamos el query y verificamos si hubo un resultado valido
	$conexion = conexion();
	
	$query = "	select mxk, modulos
				from kvc_use
				where mxk = '" . $mxk . "'
				and '" . $con . "' = aes_decrypt(con, '" . $mxk . "')
				limit 1;";
				
	$resultado = $conexion->query($query);
	
	/*
	* Si existe el usuario y al contraseña es valida devolvemos verdadero al cliente, 
	* Caso contrario dejamos en 0 la variable de sesion	
	*/
	if($resultado->num_rows == 1){
		
		session_start();

		$_SESSION['sesion'] = 1;

		$modulos = array();

		$usuario;
		$modulosJson;

		while($registro = $resultado->fetch_array(MYSQLI_ASSOC)){

			$usuario = $registro['mxk'];
			$modulosJson = json_decode($registro['modulos']);

		}

		$modulos = array();

		foreach ($modulosJson as $indice => $valor) {
			$modulos[$valor->nombre] = $valor->propiedades;
		}

		$_SESSION['usuario'] = $usuario;
		$_SESSION['modulos'] = $modulos;

		$sesion = 1;

		$mensaje = utf8_encode("Ingresando...");

	}else{
		session_start();
		session_unset();
		session_destroy();
		$mensaje =utf8_encode("Usuario y/o Password invalidos");
	}
	
	//Construimos la respuesta
	$respuesta['mensaje'] = $mensaje;
	$respuesta['sesion'] = $sesion;
	$respuesta['query'] = $query;
	
	echo json_encode($respuesta);
	
?>