<!--Encabezado-->
<?

header('Content-Type: text/html; charset=UTF-8');

require('funciones.php');

validarLogin();

$_SESSION['nivelError'] = 0;
// $_SESSION['nivelError'] = 32767;

error_reporting($_SESSION['nivelError']);

?>

<!DOCTYPE html>
<html lang="en">
<meta name="viewport" content="initial-scale=1, maximum-scale=1">
<link rel="stylesheet" href="../c/bootstrap.css"/>
<link rel="stylesheet" href="../c/jquery.fileupload-ui.css">
<!--<link rel="stylesheet" href="../c/bsm/prism.css">-->
<link rel="stylesheet" href="../c/bootstrap-switch.css" />
<link rel="shortcut icon" href="../i/kelLog.png">

<!--Fin encabezado-->
<!-- <div class="resolucion">
</div> -->

<div class="contenedor">

<? require('men.php'); ?>

	<!--Inicio Cuerpo-->
    <div class="cuerpo">
	<!--Inicio Cuerpo-->