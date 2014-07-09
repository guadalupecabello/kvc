<? 
	function conexion(){
			$conexion = new mysqli('127.0.0.1', 'root', 'yaniviendo','kvirtualcenter') ;
			if($conexion->connect_errno){
				die("Error Con la conexión No. $conexion->connect_errno: " . $conexion->connect_error);
			}else{
				return $conexion;
			}
	}
	
	//$conexion = conexion();
	
	//echo var_dump($conexion);
	
?>