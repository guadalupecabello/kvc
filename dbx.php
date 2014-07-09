<?

require('funciones.php');

// validarLogin();

error_reporting(E_ALL);

$inicio = obtenerHora();

$mensaje = "<h4>Resumen:</h4><hr><p>";

//Extraemos variables
extract($_POST);

/*$tabla='fle_del';
$url = 'cts/conFleDel.php';
$columnasVacias = 28;
$archivo = "pbmp.xls";
$complemento = "false";*/

//Creamos la conexion
$conexion = conexion();

//Importamos libreria
require_once 'per/excel_reader2.php';

//Procesamos el Archivo
$data = new Spreadsheet_Excel_Reader("s/php/files/" . $archivo . "", false);

if(!$data){
	die("Error cargando Archivo " . $archivo);
}

//Hacemos el conteo de columnas
$columnas = 1;
while($data->val(1, $columnas, 0)){
	//echo "Col: ".$columnas.", ".$data->val(1, $columnas, 0);
	$columnas++;
}

//Verificamos que el numero de columnas coincida dadas las columnas del archivo mas las consideradas como Nulas
$qry = "show columns from cts." . $tabla . "";
$resultado = $conexion->query($qry);
$columnasTabla = $resultado->num_rows;
$columnasInsertar = $columnas + $columnasVacias;

//echo $columnas . ", " . $columnasVacias;

//echo "<br>" . $columnasTabla;
//echo "<br>" . (($columnas + $columnasVacias) - 1);

//En caso de ser asi podemos realizar el proceso
if($columnasTabla == $columnasInsertar){
	
	$registrosInsertados = 0;
	$registrosErroneos = 0;
	
	//Verificamos la cantidad de registros
	$registros = count($data->sheets[0]['cells']);
	
	if($complemento == 'false'){
		//Eliminamos el repositorio cuando la bandera 'subida' este en 1 o Verdadero -Pendiente- 
		$queryEliminacion = "DELETE FROM " . $tabla . "
							WHERE per = '" . $per . "'";
		$conexion->query($queryEliminacion);
	}
	
	//Iniciamos las inserciones
	$query = "INSERT INTO " . $tabla . " VALUES ";
	
	$registro = "";
	$registrosError="";
	$valor;
	$diagonales;
	
	//echo $data->val(2, 1, 0);
	$porcentaje = 0;
	$kilos = 0;
	
	for($i = 2; $i <= $registros; $i++){
		
		for($j = 1; $j < $columnas; $j++){
	
			$valor = $data->val($i, $j, 0)."";
			
			$diagonales = 0;
			
			//Depuracion para que los Strings con comillas simples (')  se inserten como tal en la base de datos
			$valorTemporal = "";
		
			for($k = 0; $k<strlen($valor); $k++){
		
				if($k == 0 || $k == (strlen($valor)-1)){
					$valorTemporal = $valorTemporal . $valor[$k];
					
				}else{
					if($valor[$k] == '\''){
						$valorTemporal = $valorTemporal . '\\\'';
					}else{
						$valorTemporal = $valorTemporal . $valor[$k];
					}
					
				}
				
			}
			
			$valor = $valorTemporal;
			
			//Depuracion para verificar si el String viene en un formato de fecha en texto y pasarlo posteriormente al formato en MySql
			for($k = 0; $k<strlen($valor); $k++){
				if($valor[$k] == '/'){
					$diagonales++;
				}
			}
			
			if($diagonales == 2){
				$valor = explode("/", $valor);
				$valor = $valor[2]."-".$valor[1]."-".$valor[0];
			}
			
			if($j==$columnas-1){
				$registro =$registro."'".$valor."'";
			}else{
				$registro =$registro."'".$valor."', ";
			}
			
		}
		
		
		//Depuracion para las columnas vacias que contiene la tabla al final
		for($k = 0; $k < $columnasVacias; $k++){
			if($k == $columnasVacias - 1){
				$registro = $registro.", NULL";
			}else{
				$registro = $registro.", NULL";
			}
		}
		
		//Complemento del registro
		$registro = "('" . $per . "', ".$registro.")";
		
		//Insercion del registro atrapando la excepcion en una cadena de caracteres que contiene a los registros erroneos
		if(!$res = $conexion->query($query.$registro)){
			$registrosError = $registrosError.$registro."<br>";
			$registrosErroneos++;
		}else{
			$registrosInsertados++;
		}
		
		//Se limpia el registro para volverlos a trabajar en el siguiente ciclo
		$registro = "";
		
	}
	$mensaje .= "Periodo: " . $per . "<br>"; 
	$mensaje .= "Registros Insertados:" . $registrosInsertados . "<br>";
	$mensaje .= "Registros Erroneos: " . $registrosErroneos . "<br>";
	
	//Se verifica la cantidad de registros insertados a la base.
	$registrosBase = $conexion->query("SELECT * FROM " . $tabla . " where per='" . $per . "'");
	
	//Ejecutamos el archivo que lleva a cabo el proceso de prorrateo llamandolo desde la URL especificada en caso de exitir
	if($url != ''){
		require($url);
		//Adjuntamos al mensaje General la respuesta en texto del archivo de ejecucion
		$mensaje .= $resumenUrl;
	}
	
	//Actualizamos los datos generales e indicamos que estamos llamando el archivo desde el Cost To Serve
	if($url != ''){
		$cts = 1;
		require('cts/datGen.php');
	}
	
	
}else{
	
	$mensaje .= "Error:<br>
				El numero de columnas del archivo enviado no coincide con el requerido por la base de datos<br>
				Columnas En Tabla: " . $columnasTabla . "<br>Columnas A Insertar: " . $columnasInsertar;
	
}

//Obtenemos tiempo de finalizacion
$final = obtenerHora();

//Construimos el tiempo de ejecucion
$tiempoEjecucion = obtenerTiempoEjecucion($inicio, $final);

//Construimos el mensaje de respuesta
$mensaje .= "<br>Tiempo de Ejecuci&oacute;n: " . $tiempoEjecucion . "<br></p>" ;

//$mensaje .= "\nCol" . $columnasTabla . "\nC: " .($columnas + $columnasVacias) ;
$respuesta = array();
$respuesta['respuesta'] = utf8_encode($mensaje);
echo json_encode($respuesta);

?>