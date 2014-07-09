<? 
	//Funcion que nos permite agregar los datos generales de cada modulo en base a un areglo de String denominado Queries
	if(!$_SESSION){
			session_start();
	}
	if(function_exists('agregarDatosGenerales')){
		
	}else{
		function agregarDatosGenerales($queries){
			//if($_SESSION['sesion'] == 1){
				//Creamos la conexion
			echo "asdasdasdasdasdasdasd";
				$conexionTemporal = conexionTemporal();
				//Declaramos nuestro arreglo a devolver
				$datosGenerales = array();
				//Recorremos cada query
				foreach($queries as $descripcion => $query){
					//Ejecutamos el query
					if(!$resultado = $conexionTemporal->query($query)){
						echo "<br>Error: " . $query;
					}else{
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
					
				}
				
				return $datosGenerales;
			//}else{
				//session_destroy();
				//header('Location: ../index.php');
			//}
		}
	}
	//Declaramos la funcion
	

	//Agregamos la rutina de la conexion
	if(function_exists('conexionTemporal')){
		
	}else{
		function conexionTemporal(){
				
				$bc = 'csp';
				$bk = 'kvirtualcenter';
				$contrasena = "";
				if(strpos($_SERVER['HTTP_HOST'], "local") !== false){
					
				}else{
					$contrasena = "";
				}

				$conexion = new mysqli('127.0.0.1', 'root', $contrasena ,$bk);
				if($conexion->connect_errno){
					die("Error Con la conexión No. " . $conexion->connect_errno . ": " .  $conexion->connect_error);
				}else{
					return $conexion;
				}
		}
	}
	
?>