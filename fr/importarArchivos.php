<? 
	//Definimos la codificacion
	header('Content-Type: text/html; charset=UTF-8');
	
	//Agregamos los datos generales
	require('../agrDatGenFR.php');
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
	$queries['g'] = "select count(*) AS 'reg cf', sum(c15) AS 'tot cf'
					from fr_cas_fil";	
	$queries['h'] = "select count(*) AS 'registros zro', sum(c30) AS 'tot zro'
					from fr_zro";	
	$queries['i'] = "select count(c1) AS 'registros con mod', sum(c15) AS 'tot con mod'
					from fr_con_mod";	
	$datosGenerales = agregarDatosGenerales($queries);

?>

<!DOCTYPE html>
<html lang="en">
<meta name="viewport" content="initial-scale=1, maximum-scale=1">

<link href="../c/bootstrap.css" rel="stylesheet"/>
<link rel="stylesheet" href="../c/jquery.fileupload-ui.css">
<link rel="stylesheet" href="../c/bsm/prism.css">
<link rel="stylesheet" href="../c/bsm/bootstrap-switch.min.css" />

<br>
<br>
<div class="row">
	<div class="col-lg-2">
    
    </div>
	<div class="col-lg-8">
    	<h1><span class="glyphicon glyphicon-cloud-upload"></span>Importar Archivos</h1>

        <p>
            Seleccione el archivo que desea importar al sistema.
        </p>
        
        <div class="row">
        	<div class="col-lg-6 text-center">
            	<button type="button" class="btn btn-danger btn-lg" id="genCon"><i class="glyphicon glyphicon-cog"></i> Generar FR</button>
            	<button type="button" class="btn btn-danger btn-lg" id="expCon"><i class="glyphicon glyphicon-cloud-download"></i> Descargar FR</button>
                <form action="../exportarTablaExcelFR.php" method="post" id="expTabCon">
                	<input type="hidden" name="tablaOrigen" value="">
                </form>
            </div>
            <div class="col-lg-6">
            	
            </div>
            
        </div>
        
        <!--Las siguientes columnas van dentro del Col-lg-8 de arriba-->
        <div class="col-lg-3 text-center">
            <b>Repositorios:</b>
            <div class="btn-group-vertical">
            	<label class="btn btn-primary btn-xs actualizar" tabla="fr_con_mod" columnasVacias="0" archivo="Concentrado Modificado">
                    Concentrado Modificado <b>(<?= $datosGenerales['registros con mod'] ?>)</b>
                </label>
                <label class="btn btn-primary btn-xs actualizar" tabla="fr_cas_fil" columnasVacias="0" archivo="Case Fill">
                    Case Fill <b>(<?=$datosGenerales['Reg Cas Fil']?>)</b>
                </label>
                <label class="btn btn-primary btn-xs actualizar"  tabla="fr_zro" columnasVacias="0" archivo="ZRor">
                    ZRor <b>(<?=$datosGenerales['Reg Zro']?>)</b>
                </label>
                <label class="btn btn-primary btn-xs actualizar"  tabla="fr_mae_mat" columnasVacias="0" archivo="Maestro de Materiales">
                    Maestro de materiales <b>(<?=$datosGenerales['Reg Mat']?>)</b>
                </label>
                <label class="btn btn-primary btn-xs actualizar"  tabla="fr_mae_cau" columnasVacias="0" archivo="Maestro de Causas">
                    Maestro de Causas <b>(<?=$datosGenerales['Reg Cau']?>)</b>
                </label>
                <label class="btn btn-primary btn-xs actualizar"  tabla="fr_mae_cli" columnasVacias="0" archivo="Maestro de Clientes">
                    Maestro de Clientes <b>(<?=$datosGenerales['Reg Cli']?>)</b>
                </label>
	        </div>
        </div>

        <div class="col-lg-9">
        	
            <span><b>Archivo:</b> </span><span id="archivo"></span>
            
            <div id="pbCargaArchivo">
                
                <div id="contenedorAgregar">
                    <span class="btn btn-primary btn-xs fileinput-button">
                        <i class="glyphicon glyphicon-folder-open"></i>
                        <span>Agregar</span>
                        <!-- The file input field used as target for the file upload widget -->
                        <input id="fileupload" type="file" name="files[]" accept=".csv" class="btn">
                    </span>
                    <br />
                </div> 
                
                <div id="files" class="files" style="margin-bottom:5px;"></div>
                
                <!--Boton de complemento, deshabilitado desde la actualizacion de exportacion dbx.php a INFILE
                -->
                
                <div class="btn-toolbar" style="margin-top:5px;">
                    <div class="btn-group btn-group-xs">
                    
                        <input type="hidden" id="tfTabla" />
                        <input type="hidden" id="tfColVac" />
                    
                        <button type="button" class="btn btn-primary btn-xs" id="btnExportar" disabled="disabled">
                            <i class="glyphicon glyphicon-circle-arrow-up"></i>
                            Exportar
                        </button>
                        <button type="button" class="btn btn-primary btn-xs" id="btnCancelar">
                            <i class="glyphicon glyphicon-remove-sign"></i>
                            Cancelar
                        </button>
                        
                    </div>
                </div>
                <br />
                <div id="progress" class="progress progress-striped active">
                    <div class="progress-bar"></div>
                </div>
    
            </div>
        </div>
         <!--Aqui termina el Col-lg-8 de arriba-->  
    </div>
</div>
<br>
<br>
<input type="checkbox" id="comSus" data-on-label="Complemento" data-off-label="Sustituc&iacute;on" checked class="switch-mini">
<div class="row">
	<div class="col-lg-8 col-xs-offset-2 col-xs-pull-2 text-center">
    	<table class="table table-bordered table-hover">
        	<thead class="bg-primary">
            	<th>
                	Base
                </th>
                <th>
                	Registros
                </th>
                <th>
                	Totales
                </th>
            </thead>
            <tbody>
            	<tr>
                	<td>
                    	Case Fill
                    </td>
                    <td>
                    	<?= $datosGenerales['reg cf']; ?>
                    </td>
                    <td>
                    	<?= $datosGenerales['tot cf']; ?>
                    </td>
                </tr>
                <tr>
                	<td>
                    	ZRor
                    </td>
                    <td>
                    	<?= $datosGenerales['registros zro']; ?>
                    </td>
                    <td>
                    	<?= $datosGenerales['tot zro']; ?>
                    </td>
                </tr>
                <tr>
                	<td>
                    	Concentrado Modificado
                    </td>
                    <td>
                    	<?= $datosGenerales['registros con mod']; ?>
                    </td>
                    <td>
                    	<?= $datosGenerales['tot con mod']; ?>
                    </td>
                </tr>
                
            </tbody>
        </table>
    </div>
</div>
<div id="consola">
	
</div>

</html>

<script src="../j/jquery.js"></script>
<script src="../j/bootstrap.min.js"></script>

<script src="../j/bsm/bootstrap-switch.min.js"></script>
<script src="../j/bsm/prism.js"></script>


<script src="../j/jquery.ui.widget.js"></script>
<script src="../j/load-image.min.js"></script>
<script src="../j/canvas-to-blob.min.js"></script>
<script src="../j/jquery.iframe-transport.js"></script>
<script src="../j/jquery.fileupload.js"></script>
<script src="../j/jquery.fileupload-process.js"></script>
<script src="../j/jquery.fileupload-image.js"></script>
<script src="../j/jquery.fileupload-audio.js"></script>
<script src="../j/jquery.fileupload-video.js"></script>
<script src="../j/jquery.fileupload-validate.js"></script>

<script>

	$(document).ready(function(){
		
		//Generaro Consolidado
		$('#genCon').click(function(){
			$.ajax({
				
				url:'generarConsolidado.php',
				async: true,
				dataType: 'json',
				data: {},
				beforeSend: function(){
					$('#progress .progress-bar').text(
							'¡Generando Concentrado!'
						);
					$('#progress').addClass('progress-striped');
					$('#progress').addClass('active');
					$('#progress .progress-bar').css(
						'width','100%'
					);
				},
				success: function(respuesta){
					alert('¡Exito!\nArchivo Generado Correctamente');
					$('#progress').removeClass('progress-striped');
					$('#progress').removeClass('active');
					$('#progress .progress-bar').css(
						'width','0%'
					);
				},
				error: function(respuesta){
					
					var mensaje = "Error de ejecición\n" + 
								+ "Detalles:\n" 
								+ respuesta.status + " - "
								+ respuesta.statusText + "\n"
								+ respuesta.responseText;
					
					alert(mensaje);
					
					$('#progress').removeClass('progress-striped');
					$('#progress').removeClass('active');
					$('#progress .progress-bar').css(
						'width','0%'
					);
				}
				
			});
		});
		
		
		//Exportar Consolidado
		$('#expCon').click(function(){
			$('#expTabCon').submit();
		});
		
		//Creamos todos los checkbox
		$('input[type="checkbox"],[type="radio"]').not('#create-switch').bootstrapSwitch();
		
		
		//Accion del button radio para definir los parametros para el exportador de base de datos
		$('.actualizar').click(function(){
			$('#tfTabla').val($(this).attr('tabla'));
			$('#tfColVac').val($(this).attr('columnasVacias'));
			$('#archivo').html($(this).attr('archivo'));
		});
		
		//Evento del boton Exportar
		$('#btnExportar').click(
			function(){				
				if( $('#nombreArchivo').text() != '' &&  $('#tfTabla').val() != '' && $('#tfColVac').val() != ''){
					
					exportar(
						$('#tfTabla').val(), $('#nombreArchivo').text(), $('#tfColVac').val()
					);
					
				}else{
					alert('Favor de complementar todos los campos');
				}
			}
		);
		
		//Funcion que se activa desde el boton exportar
		//Iniciamos la exportacion
		function exportar(tabla, archivo, columnaVacias){
			//alert('tabla: ' + tabla + 'archivo: ' + archivo + ' Columna vacias: ' + columnaVacias);
			setTimeout(
				function(){
					$('#progress .progress-bar').text(
						'¡Exportando Excel a la Base de Datos!'
					)
				}
				,
				3000
			);
			
			$.ajax({
				url: '../dbxInfFR.php',
				async: true,
				type: 'POST',
				dataType: 'json',
				data: {
					'tabla' : tabla,
					'archivo' : archivo,
					'columnasVacias' : columnaVacias
					
				},
				beforeSend: function(){
						$('#progress .progress-bar').text(
							'¡Exportando Excel "' + archivo + '" a la Base de Datos!'
						);
						$('#progress').addClass('progress-striped');
						$('#progress').addClass('active');
						$('#btnExportar').prop('disabled', true);
				},
				success: function(respuesta){

					alert(respuesta.resumen);
					//$('#consola').text(respuesta.resumen);
					
					//$('#queries').html('<b>Registros Insertados:</b><br>' + respuesta.registrosInsertados);
						
					//if(respuesta.registrosErroneos.length > 0){
						//$('#queries').append('<b>Registros Erroneos:</b><br>' + respuesta.registrosErroneos);
					//}

					//$('#progress').hide('slow');
					$('#progress .progress-bar').text('');
					$('#progress .progress-bar').css(
						'width','0%'
					);
				
					$('#progress .progress-bar').text(
						'0%'
					);
					
					$('#progress').removeClass('progress-striped');
					$('#progress').removeClass('active')
					
					$('#contenedorArchivo').hide('slow');
					$('#contenedorArchivo').remove();
					$('#contenedorAgregar').show('slow');
					$('#btnExportar').prop('disabled', true);
					
				},
				error: function(e){
					
					var mensaje = "Error de ejecucióna\n"
								+ "Detalles:\n" 
								+ e.status + " - "
								+ e.statusText + "\n"
								+ e.responseText;
					
					alert(mensaje);
					
					//$('#consola').html(mensaje);
					$('#progress').hide('slow');
					$('#progress .progress-bar').text('');
					$('#progress .progress-bar').css(
						'width','0%'
					);
				
					$('#progress .progress-bar').text(
						'0%'
					);
					$('#progress').removeClass('progress-striped');
					$('#progress').removeClass('active')
					
					$('#contenedorArchivo').hide('slow');
					$('#contenedorArchivo').remove();
					$('#contenedorAgregar').show('slow');
					
					$('#btnExportar').prop('disabled', true);
				}				
				
			});
			
		}

		//Funcionalidad del File Uploader
		$(function () {
			
			'use strict';
			// Change this to the location of your server-side upload handler:
			var url = window.location.hostname === 'localhost/fu/server/php' ?
						'localhost' : '../s/php/',
				
				
				uploadButton = $('<button/>')
					.addClass('btn btn-primary')
					.prop('disabled', true)
					.attr('id', 'btnCargar')
					.text('Procesando...')
					.on(
						'click', 
						function () {
							var $this = $(this),
							data = $this.data();
							$this
								.off('click')
								.text('Abortar')
								.on(
									'click', 
									function () {
										$this.remove();
										data.abort();
									}
								);
					
							data.submit().always(
								function () {
									$this.remove();
									$('#btnEliminar').remove();
								}
							);
						}
					);
					
			$('#fileupload').fileupload({
				url: url,
				dataType: 'json',
				autoUpload: false,
				acceptFileTypes: /(\.|\/)(csv)$/i,
				maxFileSize: 40000000, // 40 MB
				// Enable image resizing, except for Android and Opera,
				// which actually support image resizing, but fail to
				// send Blob objects via XHR requests:
				disableImageResize: /Android(?!.*Chrome)|Opera/
					.test(window.navigator.userAgent),
				previewMaxWidth: 50,
				previewMaxHeight: 50,
				previewCrop: true
			}).on('fileuploadadd', function (e, data) {
				$('#progress').show('fast');
				data.context = $('<div/>')
							.appendTo('#files')
							.attr('id', 'contenedorArchivo');
							
				$.each(data.files, function (index, file) {
					var node = $('<p/>')
							.append(
								$('<div/>')
									.attr('class', 'glyphicon glyphicon-file')
									.text(file.name)
									.attr('id', 'nombreArchivo')
							)							
							.addClass('text-muted');
					if (!index) {
						node
							//.append('<br>')
							.append(uploadButton.clone(true).data(data));
							
							var btnEliminar = $('<button/>')
							.attr('id', 'btnEliminar')
							.addClass('btn btn-danger btn-xs')
							.text('Eliminar')
							.on(
								'click', 
								function(){
									$('#contenedorArchivo').hide('slow');
									$('#contenedorArchivo').remove();
									$('#contenedorAgregar').show('slow');
									
								}
							);
							
							node.append(btnEliminar);
							
					}
							
					node.appendTo(data.context);
					
					
				$('#contenedorAgregar').hide('slow');
					
				});
			}).on('fileuploadprocessalways', function (e, data) {
				var index = data.index,
					file = data.files[index],
					node = $(data.context.children()[index]);
				if (file.preview) {
					node
						.prepend('<br>')
						.prepend(file.preview);
				}
				if (file.error) {
					node
						.append('<br>')
						.append(file.error);
				}
				if (index + 1 === data.files.length) {
						$('#btnCargar')
						.text('Cargar')
						.prop('disabled', !!data.files.error)
						.addClass('btn-xs');
				}
			}).on('fileuploadprogressall', function (e, data) {
				var progress = parseInt(data.loaded / data.total * 100, 10);
				$('#progress .progress-bar').css(
					'width',
					progress + '%'
				);
				
				$('#progress .progress-bar').text(
					progress + '%'
				);
				
			}).on('fileuploaddone', function (e, data) {
				$.each(data.result.files, function (index, file) {
					var link = $('<a>')
						.attr('target', '_blank')
						.attr('id', file.name)
						//.prop('href', file.url)
						;
					$(data.context.children()[index])
						//.wrap(link)
						;				
				});
				
				$('#progress .progress-bar').text(
					'¡Archivo Recibido!'
				);
				
				
				$('#btnExportar').prop('disabled', false);
				$('#progress').removeClass('progress-striped');
				$('#progress').removeClass('active');
				
				//alert($('#archivo').text());
				/*setInterval(
					function(){
						actProBD()
					},
					1000				
				);*/
								
			}).on('fileuploadfail', function (e, data) {
				$.each(data.result.files, function (index, file) {
					var error = $('<span/>').text(file.error);
					$(data.context.children()[index])
						.append('<br>')
						.append(error);
				});
			}).prop('disabled', !$.support.fileInput)
				.parent().addClass($.support.fileInput ? undefined : 'disabled');
		});
		
		
	});

		

</script>
