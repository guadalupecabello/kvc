<?
	
	if(function_exists('conexion') == false){

		function conexion(){

			$host = "127.0.0.1";
			$user = "";
			$contrasena = "";
			$base = "";

			if(strpos($_SERVER['HTTP_HOST'], "local") !== false){
				$user = "root";
				$contrasena = "";
				$base = "cts";
			}else{
				$user = "root";
				$contrasena = "yaniviendo";
				$base = "cts";
			}

			$conexion = new mysqli('127.0.0.1', $user, $contrasena, $base);
			
			if($conexion->connect_errno){
				die("Error Con la conexión No. " . $conexion->connect_errno . ": " .  $conexion->connect_error . "<br>Host: $host, Usuario: $user, Contrase&ntilde;a: $contrasena, Base: $base");
			}else{
				return $conexion;
			}
			
		}

	}

	if(function_exists('conexionFR') == false){

		function conexionFR(){

			$host = "127.0.0.1";
			$user = "";
			$contrasena = "";
			$base = "";

			if(strpos($_SERVER['HTTP_HOST'], "local") !== false){
				$user = "root";
				$contrasena = "";
				$base = "kvirtualcenter";
			}else{
				$user = "root";
				$contrasena = "yaniviendo";
				$base = "kvirtualcenter";
			}

			$conexion = new mysqli('127.0.0.1', $user, $contrasena, $base);
			
			if($conexion->connect_errno){
				die("Error Con la conexión No. " . $conexion->connect_errno . ": " .  $conexion->connect_error . "<br>Host: $host, Usuario: $user, Contrase&ntilde;a: $contrasena, Base: $base");
			}else{
				return $conexion;
			}
			
		}

	}

	//Funcion para los datos generales
	if(function_exists('agregarDatosGenerales') == false){

		function agregarDatosGenerales($queries){
			
			//Creamos la conexion
			$conexionTemporal = conexionTemporal();
			//Declaramos nuestro arreglo a devolver
			$datosGenerales = array();
			//Recorremos cada query
			foreach($queries as $descripcion => $query){
				//Ejecutamos el query
				$resultado = $conexionTemporal->query($query);
				if(!$resultado){
					echo $conexionTemporal->error . "<br>Query: " . $query;
				}
				//Transformamos el resultado a un arreglo asociativo
				$resultado->fetch_assoc();
				//Agregamos los datos devueltos a un arreglo con la referencia del alias dado en el querie
				foreach($resultado as $clave => $valor){
					foreach($valor as $c => $v){
						$datosGenerales[$c] = $v;
						$datosGenerales[$c . ' f'] = number_format($v, 2);
						$_SESSION[$c] = $v;
						$_SESSION[$c . ' f'] = number_format($v, 2);
					}
				}
				
			}

			return $datosGenerales;

		}
	}

	//Funcion para los datos generales
	if(function_exists('agregarDatosGeneralesFR') == false){

		function agregarDatosGeneralesFR($queries){
			
			//Creamos la conexion
			$conexionTemporal = conexionTemporalFR();
			//Declaramos nuestro arreglo a devolver
			$datosGenerales = array();
			//Recorremos cada query
			foreach($queries as $descripcion => $query){
				//Ejecutamos el query
				$resultado = $conexionTemporal->query($query);
				if(!$resultado){
					echo $conexionTemporal->error . "<br>Query: " . $query;
				}
				//Transformamos el resultado a un arreglo asociativo
				$resultado->fetch_assoc();
				//Agregamos los datos devueltos a un arreglo con la referencia del alias dado en el querie
				foreach($resultado as $clave => $valor){
					foreach($valor as $c => $v){
						$datosGenerales[$c] = $v;
						$datosGenerales[$c . ' f'] = number_format($v, 2);;
						$_SESSION[$c] = $v;
						$_SESSION[$c . ' f'] = number_format($v, 2);
					}
				}
				
			}

			return $datosGenerales;

		}
	}

	/*
	* Verificamos si existe la funcion auxiliar para la extraccion de datps generales, en caso de que no la declaramos
	*/

	if(function_exists('conexionTemporal') == false){

		function conexionTemporal(){

			$host = "127.0.0.1";
			$user = "";
			$contrasena = "";
			$base = "";

			if(strpos($_SERVER['HTTP_HOST'], "local") !== false){
				$user = "root";
				$contrasena = "";
				$base = "cts";
			}else{
				$user = "root";
				$contrasena = "yaniviendo";
				$base = "cts";
			}

			$conexion = new mysqli('127.0.0.1', $user, $contrasena, $base);
			
			if($conexion->connect_errno){
				die("Error Con la conexión No. " . $conexion->connect_errno . ": " .  $conexion->connect_error . "<br>Host: $host, Usuario: $user, Contrase&ntilde;a: $contrasena, Base: $base");
			}else{
				return $conexion;
			}

		}

	}

	if(function_exists('conexionTemporalFR') == false){

		function conexionTemporalFR(){

			$host = "127.0.0.1";
			$user = "";
			$contrasena = "";
			$base = "";

			if(strpos($_SERVER['HTTP_HOST'], "local") !== false){
				$user = "root";
				$contrasena = "";
				$base = "kvirtualcenter";
			}else{
				$user = "root";
				$contrasena = "yaniviendo";
				$base = "kvirtualcenter";
			}

			$conexion = new mysqli('127.0.0.1', $user, $contrasena, $base);
			
			if($conexion->connect_errno){
				die("Error Con la conexión No. " . $conexion->connect_errno . ": " .  $conexion->connect_error . "<br>Host: $host, Usuario: $user, Contrase&ntilde;a: $contrasena, Base: $base");
			}else{
				return $conexion;
			}

		}

	}

	//Funcion para activar la sesion en caso de que no este activa
	if(function_exists('verificarSesion') == false){

		function verificarSesion(){
			if (session_status() == PHP_SESSION_NONE) {
		    	session_start();
			}

		}
	}

	//Funcion para verificar si existe un Login valido
	if(function_exists('validarLogin') == false){
		
		function validarLogin(){
			//Verificamos la sesion
			verificarSesion();

			//Si existe no existe la variable Sesion con Valor de 1 (1 inica un Login valido), entonces se manda a la pagina de Inicio
			if($_SESSION['sesion'] != 1){
				session_destroy();
				header('Location: ../index.php');
			}
		}
		
	}

	//Funcion para verificar si existe un Login valido
	if(function_exists('cerrarSesion') == false){
		
		function cerrarSesion(){
			//Verificamos la sesion
			verificarSesion();

			//Cerramos la sesion y redireccionamos
			session_destroy();
			header('Location: ../index.php');
		}
		
	}


	/*
	* Funcion para correr queries a traves de un array de queries
	* Devuelve una cadena de texto con el tiempo transcurrido y los errores en caso de haberlos
	*/

	if(function_exists('procesarQueries') == false){

		function procesarQueries($conexion, $queries){
			
			$inicio = Date('h') . ":" . Date('i') . ":" . Date('s');

			$info = "<hr><br>Proceso de Queries<br>";

			foreach ($queries as $descripcion => $query) {
				
				if(!$conexion->query($query)){					
					$info .= "<br>Error en Ejecuci&oacute;n:<br>Instrucci&oacute;n " . $descripcion . " -> " . $query;
				}else{
					$info .= "<br>Exito :<br>Instrucci&oacute;n " . $descripcion . " -> " . $query;
				}

			}

			$final = Date('h') . ":" . Date('i') . ":" . Date('s');

			$info .= "<br>Tiempo de Ejecuci&oacute;n: " . obtenerTiempoEjecucion($inicio, $final);

		}
	}

	if(function_exists('obtenerTiempoEjecucion') == false){

		function obtenerTiempoEjecucion($inicio, $final){

			//Construimos el tiempo transcurrido
			$diferencia = strtotime($final) - strtotime($inicio);

			$minutos = floor( ($diferencia - (0 * 3600)) / 60 );
			$segundos = $diferencia - ( 0 * 3600 ) - ( $minutos * 60 );

			if($minutos < 10){
				$minutos = "0" . $minutos;
			}
			if($segundos < 10){
				$segundos = "0" . $segundos;
			}

			$tiempo = "00:" . $minutos . ":" . $segundos;

			return $tiempo;

		}

	}

	//Funcion que recibe una cadena de texto como query y devuelve un arreglo JSON para el procesamiento Front End
	if(function_exists('obtenerQueryToJson') == false){

		function obtenerQueryToJson($conexion, $query){

			$respuesta;

			if(!$respuesta = $conexion->query($query)){
				die("Error en ejecuci&oacute;n: Instrucci&oacute;n - " . $query);
			}else{
				
				if($respuesta->num_rows > 0){

					$arreglo = array();

					while($registro = $respuesta->fetch_array(MYSQLI_ASSOC)){
						array_push($arreglo, $registro);
					}

					return json_encode($arreglo);

				} else {

					return NULL;

				}

			}

		}

	}

	//Funcion que recibe una cadena de texto como query y devuelve un arreglo JSON para el procesamiento Front End
	if(function_exists('obtenerQueryToArray') == false){

		function obtenerQueryToArray($conexion, $query){

			$respuesta;

			if(!$respuesta = $conexion->query($query)){
				die("Error en ejecuci&oacute;n: Instrucci&oacute;n - " . $query);
			}else{
				
				if($respuesta->num_rows > 0){

					$arreglo = array();

					while($registro = $respuesta->fetch_array(MYSQLI_ASSOC)){
						array_push($arreglo, $registro);
					}

					return $arreglo;

				} else {

					return NULL;

				}

			}

		}

	}

	if(function_exists('queryToData') == false){

		function queryToData($conexion, $query){

			$respuesta;

			if(!$respuesta = $conexion->query($query)){
				die("Error en ejecuci&oacute;n: Instrucci&oacute;n - " . $query);
			}else{
				
				if($respuesta->num_rows > 0){

					$dato = NULL;
					while($registro = $respuesta->fetch_row()){
						$dato = $registro[0];
					}

					return $dato;

				} else {

					return NULL;

				}

			}

		}
	}


	//Funcion que devuelve la hora actual en un formato de texto HH:MM:SS
	if(function_exists('obtenerHora') == false){

		function obtenerHora(){
			$hora = Date('h') . ":" . Date('i') . ":" . Date('s');
			return $hora;	
		}

	}

	/*
	* Funcion que ejecuta un query devolviendo la informacion general como una cadena de texto
	* la cual incluye el Query, la Descripcion del Query, Tiempo de Ejecucion y Estatus de Exito o Error.
	* Toma como parametros:
	* Una $conexion de tipo MYSQLI
	* Un $query de tipo String representando la consulta a la BD
	* Un $modo de tipo entero que representa el formato para el texto de retroalimentacion de salida
	*		0 = Formato en HTML
	*		1 = Formato en Texto Plano
	*/	

	if(function_exists('ejecutarQuery') == false){

		function ejecutarQuery($conexion, $query, $modo){

			//Salto de linea

			$break = '';

			//Verificamos el modo y ajustamos el salto de linea
			if($modo == 0){

				$break = "\n";

			} else if($modo == 1){

				$break = "<hr>";

			}

			//Declaramos la cadena para el resumen de la ejecucion
			$resumen = $break . "Status:";

			//Obtenemos la hora de Inicio de ejecucion
			$inicio = obtenerHora();

			//Ejecutamos el query
			if(!$conexion->query($query)){
				$resumen.= " Error en => "  . $query ." - " . $conexion->error;
			}else{
				// $resumen.= "<hr>Exito<br>Status: " . $query ." => " . $conexion->affected_rows;
				$resumen.= " Exito => Filas Afectadas: " . $conexion->affected_rows;
			}

			//Obtenemos la hora de Fin de ejecucion
			$final = obtenerHora();

			$tiempoEjecucion = obtenerTiempoEjecucion($inicio, $final);

			$resumen .= $break . "Tiempo: " . $tiempoEjecucion;

			return $resumen;

		}

	}

	/*
	* Funcion para ejecutar un arreglo de String en Formato MYSQL
	* Se recorre el ciclo y se ejecuta cada sentencia llamando al metodo ejecutarQuery()
	* Recibe como parametros una $conexion de tipo MYSQLI, un $arregloQueries de tipo Array y un $modo de tipo Int
	* Retorna un String con el resumen de los queries
	*/

	if(function_exists('ejecutarQueries') == false){

		function ejecutarQueries($conexion, $queries, $modo){

			$break;

			if($modo == 0){
				$break = "\n";
			} else if($modo == 1){
				$break = "<hr>";
			}

			$resumen = "";

			$inicioGeneral = obtenerHora();

			foreach ($queries as $descripcion => $query) {
					
				$resumen .= $break . $descripcion . ejecutarQuery($conexion, $query, $modo);

			}	

			$finalGeneral = obtenerHora();

			$tiempoGeneral = obtenerTiempoEjecucion($inicioGeneral, $finalGeneral);

			$resumen .= $break . "Tiempo General: " . $tiempoGeneral;

			return $resumen;

		}

	}


	/*
	* Funcion que indica si se esta accediendo de manera local o por el dominio
	*/

	if(function_exists('esLocal') == false){

		function esLocal(){

			$local;

			if(strpos($_SERVER['HTTP_HOST'], "local") !== false){	
				$local = true;
			}else{
				$local = false;
			}

			return $local;

		}

	}

	if(function_exists('limpiarCadena') == false){

		function limpiarCadena($cadena){

			return addslashes(stripslashes(strip_tags(htmlentities($cadena))));

		}

	}

	if(function_exists('limpiarRequest') == false){

		function limpiarRequest($request){

			foreach($request as $indice => $valor){
				$request[$indice] = limpiarCadena($valor);
			}

		}

	}

	//Funcion para insertar el registro de un evento de actualizacion
	if(function_exists('registrarEvento') == false){

		function registrarEvento($conexion, $periodo, $usuario, $modulo){

			$query = "INSERT INTO kvc_mod VALUES ('" . $periodo . "', '" . $usuario . "', '" . date('d/m/y H:i:s') . "', '" . $modulo. "')";

			return ejecutarQuery($conexion, $query, 1);

		}

	}









?>