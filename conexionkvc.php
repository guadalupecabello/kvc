<? 
	function conexion(){
			
			$bc = 'csp';
			$bk = 'kvirtualcenter';
			$conexion = new mysqli('localhost', 'root', 'yaniviendo',$bc);
			if($conexion->connect_errno){
				die("Error en tiempo de ejecucion con la conexi&oacuten No. $conexion->connect_errno: " . $conexion->connect_error);
			}else{
				return $conexion;
			}
	}
	
?>