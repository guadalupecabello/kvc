<? 
	error_reporting(E_ALL);
	session_start();
	//echo var_dump($_SESSION);
	
	//Verificamos si se hizo un Login exitoso y continuamos normalmente, caso contrario redireccionamos al fakin index principal.
	if($_SESSION['sesion'] == 1){
		
		//Extraemos las variables generales
		require('../conexion.php');
		$conexion = conexion();
		
		echo var_dump($conexion);
		
	}else{
		session_destroy();
		header('Location: ../index.php');
	}
?>