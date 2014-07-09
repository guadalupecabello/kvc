<? 
	
	//Index lleva estas lineas de codigo
	session_start();
	$_SESSION['sesion'] = 1;
	require('datGen.php');

	//Los archivos diferentes al index solo llaman al encabezado
	require('../enc.php');

	
?>
	

	<!-- Cuerpo html-->


	<h1>
		Informaci&oacute;n General
	</h1>

	<p>
		Manipule los elementos en la pantalla para acceder a la informacion de Fill Rate deseada
	</p>


	<!-- Fin cuerpo html -->

<? 

	//Se declaran estas variables antes del pie

	/*
	* Exportador = 1 indica uso de archivos excel 97-2003 (*.xls)
	* Exportador = 0 indica uso de archivos con valores separados por comas (*.csv)
	*/
	$exportador = 1;

	/*
	*Si esta variable no tiene valor o no esta declarada deja un mensaje por dafault de "Finanzas"
	* Caso contrario adjunta los creditos al pie del documento HTML
	*/
    $desarrollado = "Customer Service - IT, KMDC";
	require('../pie.php'); 
?>