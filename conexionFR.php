<? 
	if(function_exists('conexion')){
		
	}else{
		function conexion(){
			
				$bc = 'csp';
				$bk = 'kvirtualcenter';

				$contrasena = "";
				if(strpos($_SERVER['HTTP_HOST'], "local") !== false){
					
				}else{
					$contrasena = "";
				}

				$conexion = new mysqli('localhost', 'root', $contrasena,$bk);
				
				if($conexion->connect_errno){
					die("Error en tiempo de ejecucion con la conexi&oacuten No. $conexion->connect_errno: " . $conexion->connect_error);
				}else{
					return $conexion;
				}

				if(!$conexion->set_charset('utf8')){
					die('Error Cargando Conjunto de caract&eacute;res UTF8' . $conexion->error);
				}

		}
	}
	
	
?>