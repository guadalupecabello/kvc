<? 

session_start();
$_SESSION['sesion'] = 1;

require('datGen.php');

require('../enc.php');

$conexion = conexion();

$registrosBase = obtenerQueryToArray($conexion, "SELECT * FROM se_ejemplo");

?>

<h1>
	Sistema de Ejemplo
</h1>

                       <!--  <button
                            type="button" 
                            class="activarModal btn btn-danger btn-xs"  
                            tabla="fr_mae_mat" 
                            columnasVacias="0"
                            archivo="Archivo de Case Fill"
                            url="fr/postMaestroMateriales.php"
                        >
                                <i class="glyphicon glyphicon-refresh"></i> Actualizar
                        </button> -->
                    

<button 
	type="button"
	class="btn btn-primary btn-xs activarModal"
	tabla="se_ejemplo"
	columnasVacias="1"
	archivo="Suba su archivo"
	url="se/procesarTabla.php"
>

	<i class="glyphicon glyphicon-upload">
		
	</i>

	Boton ejemplo
</button>

<h4>Datos en base <?= var_dump($registrosBase) ?></h4>
<? 	
	// $exportador = 1; 
	$desarrollado = "Sistema de ejemplo";
	require('../pie.php');
?>