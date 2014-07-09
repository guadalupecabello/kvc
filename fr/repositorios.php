<? 
	$validacion = 0;
	
	//Variable para saber que importador usaremos, 1 indica por Infile y Nulo o cualquier otro valor indica importacion por dbx
	$exportador = 1;
    
	require('../enc.php');
	
    $conexion = conexion();

	
    //Agregamos los datos generales
	$queries['b'] = "select count(*) AS 'Reg Cas Fil'
					from fr_cas_fil;";

	$queries['c'] = "select count(*) AS 'Reg Zro'
					from fr_zro";

	$queries['d'] = "select count(*) AS 'Reg Cau'
					from fr_mae_cau";					

	$queries['e'] = "select count(*) AS 'Reg Mat'
					from fr_mae_mat";

	$queries['f'] = "select count(*) AS 'Reg Cli'
					from fr_mae_cli";

    $queries['l'] = "select count(*) AS 'Reg Gro5'
                    from fr_mae_gro5";
    $queries['m'] = "select count(*) AS 'Reg Pla'
                    from fr_mae_pla";

    $queries['n'] = "select count(*) AS 'Reg Shi'
    from fr_mae_shi";

	$queries['g'] = "SELECT count(*) AS 'reg cf', sum(c17) AS 'tot cf'
					from fr_con
                    WHERE per = '" . $_SESSION['periodo'] . "'
                    AND c0 = 'Case Fill'";

	$queries['h'] = "SELECT count(*) AS 'registros zro', sum(c17) AS 'tot zro'
					from fr_con
                    WHERE per = '" . $_SESSION['periodo'] . "'
                    AND c0 = 'Rechazos'";

	$queries['i'] = "select sum(c17) AS 'tot con mod'
					from fr_con_agr
                    WHERE per = '" . $_SESSION['periodo'] . "'";	

    $queries['j'] = "select count(c4) AS 'registros con', sum(c17) AS 'tot con'
                    from fr_con
                    WHERE per = '" . $_SESSION['periodo'] . "'";




	$datosGenerales = agregarDatosGenerales($queries);

    // echo var_dump($datosGenerales);
    $actZro = queryToData($conexion, "SELECT max(fecha) from kvc_mod WHERE per = '" . $_SESSION['periodo'] . "' AND modulo = 'fr_zro'");
    $actCasFil = queryToData($conexion, "SELECT max(fecha) from kvc_mod WHERE per = '" . $_SESSION['periodo'] . "' AND modulo = 'fr_cas_fil'");
    $actConMod = queryToData($conexion, "SELECT max(fecha) from kvc_mod WHERE per = '" . $_SESSION['periodo'] . "' AND modulo = 'fr_con_mod'");
    $actCon = queryToData($conexion, "SELECT max(fecha) from kvc_mod WHERE per = '" . $_SESSION['periodo'] . "' AND modulo = 'fr_con'");
    $actMaeMat = queryToData($conexion, "SELECT max(fecha) from kvc_mod WHERE per = '" . $_SESSION['periodo'] . "' AND modulo = 'fr_mae_mat'");
    $actMaeCli = queryToData($conexion, "SELECT max(fecha) from kvc_mod WHERE per = '" . $_SESSION['periodo'] . "' AND modulo = 'fr_mae_cli'");
    $actMaeCau = queryToData($conexion, "SELECT max(fecha) from kvc_mod WHERE per = '" . $_SESSION['periodo'] . "' AND modulo = 'fr_mae_cau'");
    $actMaeGro5 = queryToData($conexion, "SELECT max(fecha) from kvc_mod WHERE per = '" . $_SESSION['periodo'] . "' AND modulo = 'fr_mae_gro5'");
    $actMaePla = queryToData($conexion, "SELECT max(fecha) from kvc_mod WHERE per = '" . $_SESSION['periodo'] . "' AND modulo = 'fr_mae_pla'");
    $actMaeShi = queryToData($conexion, "SELECT max(fecha) from kvc_mod WHERE per = '" . $_SESSION['periodo'] . "' AND modulo = 'fr_mae_shi'");

?>
    
	<h1>
    	Fill Rate
    </h1>
    
    <!-- <div class="row">
    	<div class="col-lg-12">
        	
            <p>
                Seleccione el origen para el Fill Rate, recuerde que para procesar el archivo  es necesario tener actualizados todos los repositorios asi como las bases auxiliares.
            </p>

        </div>
    </div>
    
    <h4>
        Parametros
    </h4>
    
    

    <div class="row">

        <div class="col-lg-2">
            <p>
                <button type="button" id="generarFillRate" class="btn btn-danger">
                    <i class="glyphicon glyphicon-play"></i> Generar FR
                </button>
            </p>
        </div>
    
       

        <div class="col-lg-3">
            <p>
                Origen:
                <input type="checkbox" id="switchOrigen" checked class="switch-large">
            </p>
        </div>

        
    </div>


    <div class="row">
            
         <form action="exportarFillRate.php" method="post" id="expTabCon">
                    
            <input type="hidden" name="tablaOrigen" value="fr_con" id="ocultoTabla">

            <div class="col-lg-2">
                <p>
                    <button type="submit" class="btn btn-danger" id="exportarConsolidado">
                        <i class="glyphicon glyphicon-cloud-download"></i> Descargar FR
                    </button>
                </p>
            </div>

            <div class="col-lg-2">

            <p>
                Nombre de Archivo:
            </p>

        </div>
        <div class="col-lg-3">
            <div class="input-group-sm">
                <input type="text" name="nombreArchivo" class="form-control">
            </div>            
        </div>

        </form>
        
    </div>

    <br /> -->
    
    
    <p>
        Informaci&oacute;n Sobre archivos Actuales
    </p>
    
    
    <h4>
    	Repositorios
    </h4>
    
    <div class="table-responsive">
    
    
    <table class="table table-bordered table-hover table-condensed">
        	<thead class="bg-primary">
            	<td class="text-center">
                	Base
                </td>
                <td class="text-center">
                	Registros
                </td>
                <td class="text-center">
                	Total Cuts Qty
                </td>

                <td class="text-center">
                    Ultima Actualizaci&oacute;n
                </td>

                <td class="text-center">
                	Actualizar
                </td>
                
            </thead>
            <tbody>
            	<tr>
                	<td>
                    	Case Fill
                    </td>
                    <td class="text-right">
                    	<?= $datosGenerales['reg cf f']; ?>
                    </td>
                    <td class="text-right">
                    	<?= $datosGenerales['tot cf f']; ?>
                    </td>
                    <td class="text-right">
                        <?= $actCasFil ?>
                    </td>
                    <td class="text-center">
                        <button
                            type="button" 
                            class="activarModal btn btn-danger btn-xs"  
                            tabla="fr_cas_fil" 
                            columnasVacias="0"
                            archivo="Archivo de Case Fill"
                            url="fr/actualizarCaseFill.php"
                        >
                                <i class="glyphicon glyphicon-refresh"></i> Actualizar
                        </button>
                    </td>
                </tr>
                <tr>
                	<td>
                    	Rechazos
                    </td>
                    <td class="text-right">
                    	<?= $datosGenerales['registros zro f']; ?>
                    </td>
                    <td class="text-right">
                    	<?= $datosGenerales['tot zro f']; ?>
                    </td>
                    <td class="text-right">
                        <?= $actZro ?>
                    </td>
                    <td class="text-center">
                        <button
                            type="button" 
                            class="activarModal btn btn-danger btn-xs"  
                            tabla="fr_zro"
                            columnasVacias="0"
                            archivo="Archivo de Rechazos"
                            url="fr/actualizarRechazos.php"
                        >
                                <i class="glyphicon glyphicon-refresh"></i> Actualizar
                        </button>
                    </td>
                </tr>

                <tr>
                    <td>
                        Concentrado Autom&aacute;tico
                    </td>
                    <td class="text-right">
                        <?= $datosGenerales['registros con f']; ?>
                    </td>
                    <td class="text-right">
                        <?= $datosGenerales['tot con f']; ?>
                    </td>
                    <td class="text-right">
                        <?= $actCon ?>
                    </td>
                    <td class="text-center">
                        <!-- <button
                            type="button" 
                            class="activarModal btn btn-danger btn-xs"  
                            tabla="fr_con_mod" 
                            columnasVacias="0"
                            archivo="Archivo de Case Fill"
                            url=""
                        >
                                <i class="glyphicon glyphicon-refresh"></i> Actualizar
                        </button> -->
                    </td>
                </tr>

                <tr>
                	<td>
                    	Concentrado Modificado
                    </td>
                    <td class="text-right">
                    	<?
                            // $datosGenerales['registros con mod f']; 
                        ?>
                    </td>
                    <td class="text-right">
                    	<?= $datosGenerales['tot con mod f']; ?>
                    </td>
                    <td class="text-right">
                        <?= $actConMod ?>
                    </td>
                    <td class="text-center">
                        <button
                            type="button" 
                            class="activarModal btn btn-danger btn-xs"  
                            tabla="fr_con_mod" 
                            columnasVacias="0"
                            archivo="Archivo de Case Fill"
                            url="fr/actualizarConcentradoModificado.php"
                        >
                                <i class="glyphicon glyphicon-refresh"></i> Actualizar
                        </button>
                    </td>
                </tr>
                
            </tbody>
        </table>
        </div>
        
        <h4>
            Diccionarios
        </h4>

        <div class="table-responsive">
         <table class="table table-bordered table-hover table-condensed">
        	<thead class="bg-primary">
            	<td class="text-center">
                	Base
                </td>
                <td class="text-center">
                	Registros
                </td>
                <td class="text-center">
                    Ultima Actualizaci&oacute;n
                </td>
                <td class="text-center">
                	Actualizar
                </td>
            </thead>
            <tbody>
            	<tr>
                	<td>
                    	Maestro de Materiales
                    </td>
                    <td  class="text-right">
                    	<?=$datosGenerales['Reg Mat f']?>
                    </td>
                    <td class="text-right">
                        <?= $actMaeMat ?>
                    </td>
                    <td class="text-center">
                        <button
                            type="button" 
                            class="activarModal btn btn-danger btn-xs"  
                            tabla="fr_mae_mat" 
                            columnasVacias="0"
                            archivo="Archivo de Case Fill"
                            url="fr/postMaestroMateriales.php"
                        >
                                <i class="glyphicon glyphicon-refresh"></i> Actualizar
                        </button>
                    </td>
                </tr>
                
                <tr>
                	<td>
                    	Maestro de Clientes
                    </td>
                    <td  class="text-right">
                    	<?=$datosGenerales['Reg Cli f']?>
                    </td>
                    <td class="text-right">
                        <?= $actMaeCli ?>
                    </td>
                    <td class="text-center">
                        <button
                            type="button" 
                            class="activarModal btn btn-danger btn-xs"  
                            tabla="fr_mae_cli" 
                            columnasVacias="0"
                            archivo="Archivo de Case Fill"
                            url="fr/postMaestroClientes.php"
                        >
                                <i class="glyphicon glyphicon-refresh"></i> Actualizar
                        </button>
                    </td>
                </tr>
                
                <tr>
                	<td>
                    	Maestro de Causas
                    </td>
                    <td class="text-right">
                    	<?=$datosGenerales['Reg Cau f']?>
                    </td>
                    <td class="text-right">
                        <?= $actMaeCau ?>
                    </td>
                    <td class="text-center">
                        <button
                            type="button" 
                            class="activarModal btn btn-danger btn-xs"  
                            tabla="fr_mae_cau" 
                            columnasVacias="0"
                            archivo="Archivo de Case Fill"
                            url="fr/postMaestroCausas.php"
                        >
                                <i class="glyphicon glyphicon-refresh"></i> Actualizar
                        </button>
                    </td>
                   
                </tr>

                <tr>
                    <td>
                        Maestro Material Group 5 - Demand Planner
                    </td>
                    <td class="text-right">
                        <?=$datosGenerales['Reg Gro5 f']?>
                    </td>
                    <td class="text-right">
                        <?= $actMaeGro5 ?>
                    </td>
                    <td class="text-center">
                        <button
                            type="button" 
                            class="activarModal btn btn-danger btn-xs"  
                            tabla="fr_mae_gro5" 
                            columnasVacias="0"
                            archivo="Maestro Material Group 5 - Demand Planner"
                            url="fr/postMaestroGroup5.php"
                        >
                                <i class="glyphicon glyphicon-refresh"></i> Actualizar
                        </button>
                    </td>
                   
                </tr>

                <tr>
                    <td>
                        Maestro Plantas
                    </td>
                    <td class="text-right">
                        <?=$datosGenerales['Reg Pla f']?>
                    </td>
                    <td class="text-right">
                        <?= $actMaePla ?>
                    </td>
                    <td class="text-center">
                        <button
                            type="button" 
                            class="activarModal btn btn-danger btn-xs"  
                            tabla="fr_mae_pla" 
                            columnasVacias="0"
                            archivo="Maestro Plantas"
                            url="fr/postMaestroPlantas.php"
                        >
                                <i class="glyphicon glyphicon-refresh"></i> Actualizar
                        </button>
                    </td>
                   
                </tr>

                <tr>
                    <td>
                        Maestro Ship To's
                    </td>
                    <td class="text-right">
                        <?=$datosGenerales['Reg Shi f']?>
                    </td>
                    <td class="text-right">
                        <?= $actMaeShi ?>
                    </td>
                    <td class="text-center">
                        <button
                            type="button" 
                            class="activarModal btn btn-danger btn-xs"  
                            tabla="fr_mae_shi" 
                            columnasVacias="0"
                            archivo="Maestro Ship To's"
                            url="fr/postMaestroShip.php"
                        >
                                <i class="glyphicon glyphicon-refresh"></i> Actualizar
                        </button>
                    </td>
                   
                </tr>
                
            </tbody>
        </table>
     </div>

<div class="modal fade" id="modalInformacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close cerrarModal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel">Un momento por favor</h4>  
      </div>
      <div class="modal-body">
          <div id="progreso" class="progress progress-striped active">
              <div class="progress-bar">
              </div>
          </div>                    
      </div>            
  </div>
</div>
</div>

<? 
    $desarrollado = "Customer Service - IT, KMDC";
	require('../pie.php'); 
?>

<script>

	$(document).ready(function(){

        $('#modalInformacion').modal({
          show: false,
          keyboard: false,
          backdrop: 'static'
        });

        $('#generarFillRate').click(function(){

            $.ajax({
                url: 'generarConsolidado.php',
                methond: 'POST',
                dataType: 'text',
                async: true,
                data: {
                  'tablaOrigen' : $('#ocultoTabla').val()
                },
                beforeSend: function(){
                  // alert(periodo);
                  $('#modalInformacion').modal('show');
                  $('#progreso .progress-bar').css(
                    'width','100%'
                  );
                  
                  $('#progreso .progress-bar').text(
                    'Generando Fill Rate'
                  );

                },
                success: function(respuesta){
                    alert('Proceso Comleto\n' + respuesta.respuesta);
                    location.reload();
                },
                error: function(respuesta){
                  var mensaje = "Error:";
                  mensaje = mensaje + '\n' + respuesta.status + '->' + respuesta.responseText;
                  alert(mensaje);
                }
            });

        });

		$('#switchOrigen').bootstrapSwitch({
			'size': 'large',
			'onText' : 'Auto',
			'offText' : 'Manual'
		});

		$('#switchOrigen').on('switchChange.bootstrapSwitch', function(event, state) {
			var estado = '' + $('#switchOrigen').bootstrapSwitch('state');
			
			if(estado == 'true'){
				$('#ocultoTabla').val('fr_con');
			}else{
				$('#ocultoTabla').val('fr_con_mod');
			}
		});

	});

</script>