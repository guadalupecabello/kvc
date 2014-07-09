<? 
	if(function_exists('conexion')){
		
	}else{

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
	
?>