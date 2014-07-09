<? 
	//Funcion que nos permite agregar los datos generales de cada modulo en base a un areglo de String denominado Queries
	if(!$_SESSION){
			session_start();
	}
	if(function_exists('agregarDatosGenerales')){
		
	}else{
		function agregarDatosGenerales($queries){
			
			if($_SESSION['sesion'] == 1){
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
					}else{
						// echo "<hr>" . $query;
					}
					//Transformamos el resultado a un arreglo asociativo
					$resultado->fetch_assoc();
					//Agregamos los datos devueltos a un arreglo con la referencia del alias dado en el querie
					foreach($resultado as $clave => $valor){
						foreach($valor as $c => $v){
							$datosGenerales[$c] = $v;
							$_SESSION[$c] = $v;
							$_SESSION[$c . ' f'] = number_format($v, 2);
						}
					}
					
				}
				return $datosGenerales;
			}else{
				session_destroy();
				header('Location: ../index.php');
			}
		}
	}
	//Declaramos la funcion
	

	//Agregamos la rutina de la conexion
	if(function_exists('conexionTemporal')){
		
	}else{
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
				$user = "kvirtualcenter";
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
	
?>