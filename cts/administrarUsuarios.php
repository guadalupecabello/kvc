

<? 
	error_reporting(E_ALL);
	require('../funciones.php');
	validarLogin();
	limpiarRequest($_REQUEST);

	extract($_REQUEST);

	$conexion = conexion();

	$mensaje = "Resumen";

	// $modo = 1;
	// $usu = "a";
	// $con = "a";
	// $mod = '[{"nombre":"out","propiedades":{"lectura":false,"escritura":false}},{"nombre":"ovh","propiedades":{"lectura":false,"escritura":false}},{"nombre":"dxd","propiedades":{"lectura":false,"escritura":false}},{"nombre":"inb","propiedades":{"lectura":false,"escritura":false}},{"nombre":"tpl","propiedades":{"lectura":false,"escritura":false}},{"nombre":"ren","propiedades":{"lectura":false,"escritura":false}},{"nombre":"que","propiedades":{"lectura":false,"escritura":false}},{"nombre":"adm","propiedades":{"lectura":false,"escritura":false}}]';
	// $mod = "'" . $mod . "'";
	$admUse = new AdministradorUsuarios();

	switch($modo){
		case 0:
			$mensaje .= $admUse->insertarUsuario($conexion, $usu, $con, $mod);

			$respuesta = array();
			$respuesta['respuesta'] = utf8_encode($mensaje);
			echo json_encode($respuesta);

		break;
		
		case 1;
			$admUse->extraerUsuarios($conexion);
		break;

		case 2;
			$admUse->extraerUsuario($conexion, $usu);
		break;

		case 3;
			$mensaje .= $admUse->actualizarUsuario($conexion, $usu, $con, $mod);
			$respuesta = array();
			$respuesta['respuesta'] = utf8_encode($mensaje);
			echo json_encode($respuesta);
		break;

		case 4;
			$mensaje .= $admUse->eliminarUsuario($conexion, $usu);
			$respuesta = array();
			$respuesta['respuesta'] = utf8_encode($mensaje);
			echo json_encode($respuesta);
		break;


	}

	

	class AdministradorUsuarios{

		public function insertarUsuario($conexion, $usuario, $contrasena, $nivel){

			$retro = "";

			$existeUsuario = $this->existeUsuario($conexion, $usuario);

			if($existeUsuario == false){

				$query = "INSERT INTO kvc_use VALUES('" . $usuario . "', aes_encrypt('" . $contrasena . "', '" . $usuario . "'), '" . $nivel . "')";

				$respuesta;

				if(!$respuesta = $conexion->query($query)){
					die('Error en insertarUsuario : ' . $query);
				}else{

					$retro .= "\nUsuario Agregado Con Exito";

				}

			}else{

				$retro .= "\nUsuario ya existente";
				
			}

			return $retro;

		}

		public function actualizarUsuario($conexion, $usuario, $contrasena, $nivel){

			$retro = "";

			$existeUsuario = $this->existeUsuario($conexion, $usuario);

			if($existeUsuario == true){

				$query = "UPDATE kvc_use SET mxk = '" . $usuario . "', con = aes_encrypt('" . $contrasena . "', '" . $usuario . "'), modulos = '" . $nivel . "' WHERE mxk = '" . $usuario . "' LIMIT 1; ";

				$respuesta;

				if(!$respuesta = $conexion->query($query)){
					die('Error en actualizarUsuario : ' . $query);
				}else{

					$retro .= "\nUsuario Actualizado Con Exito";

				}

			}else{

				$retro .= "\nUsuario no existente";
				
			}

			return $retro;

		}

		public function eliminarUsuario($conexion, $usuario){

			$retro = "";

			$existeUsuario = $this->existeUsuario($conexion, $usuario);

			if($existeUsuario == true){

				$query = "DELETE FROM kvc_use WHERE mxk = '" . $usuario . "' LIMIT 1; ";

				$respuesta;

				if(!$respuesta = $conexion->query($query)){
					die('Error en eliminarUsuario : ' . $query);
				}else{

					$retro .= "\nUsuario Eliminado Con Exito";

				}

			}else{

				$retro .= "\nUsuario no existente";
				
			}

			return $retro;

		}

		public function existeUsuario($conexion, $usuario){

			$query = "SELECT mxk FROM kvc_use WHERE mxk = '" . $usuario . "' LIMIT 1";

			$respuesta = $conexion->query($query);

			if(!$respuesta){
				die('Error en existeUsuario: ' . $query);
			}

			$registros = $respuesta->num_rows;

			$bandera;

			if($registros == 0){

				$bandera = false;

			} else {

				$bandera = true;

			}

			return $bandera;

		}

		public function extraerUsuarios($conexion){

			$query = "SELECT mxk, modulos FROM kvc_use";

			$resultado;

			if(!$resultado = $conexion->query($query)){
				$mensaje .= "\nError: " . $conexion->error;
			} else {

				$registros = array();

				while($registro = $resultado->fetch_array(MYSQLI_ASSOC)){

					array_push($registros, $registro);

				}

				echo json_encode($registros);

			}

		}

		public function extraerUsuario($conexion, $usuario){

			$query = "SELECT mxk, aes_decrypt(con, mxk) as 'contrasena', modulos FROM kvc_use WHERE mxk='" . $usuario . "' LIMIT 1;";

			$resultado;

			if(!$resultado = $conexion->query($query)){
				$mensaje .= "\nError: " . $conexion->error;
			} else {

				$registros = array();

				while($registro = $resultado->fetch_array(MYSQLI_ASSOC)){

					array_push($registros, $registro);
					
				}

				echo json_encode($registros);

			}

		}

	}	


?>