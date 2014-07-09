<?
require('../enc.php');
require('../scrSub.php');
?>

<div class="row">
        <div class="col-lg-12">
            <h1>
                Renta
            </h1>
        </div>
    </div>

	<div class="row">
    	
        <div class="col-lg-12">
        
        <h4>
        	Informaci&oacute;n General
        	<i id="comentarios" class="glyphicon glyphicon-comment" modulo="ren">
            </i>
        </h4>
        <br>
        <table class="table table-bordered table-hover">
            	<? 
				  if($_SESSION['modulos']['ren']->escritura == true){
				?>

	                <tr>
	                	<td>
	                    	<b>Base:</b>
	                        Inventario Promedio
	                    </td>
	                    <td class="text-center" colspan="2">
	                    	<button
	                            type="button" 
	                            class="btn btn-danger btn-xs activarModal"  
	                            columnasVacias="0"
	                            archivo="Archivo de Inventario Promedio"
	                            url="calTplRen.php"
	                        >
	                                <i class="glyphicon glyphicon-refresh"></i> Actualizar
	                        </button>
	                    </td>                   
	                </tr>

				<?
				  }
				?>
            
            	<tr>
                	<td>
                    	<b>Nombre</b>
                    </td>
                    
                    <td class="text-center">
                    	<b>Total</b>
                    </td>
                    <? 
					  if($_SESSION['modulos']['ren']->escritura == true){
					?>

	                    <td>
	                    </td>

					<?
					  }
					?>
                </tr>
                <tr>
                	<td>
                    	Costo de Almacenaje:
                    </td>
                    
                    <td>
                    	$
                        <div class="pull-right">
                            <?= $_SESSION['rta bm f']?>
                        </div>
                    </td>
                    <? 
					  if($_SESSION['modulos']['ren']->escritura == true){
					?>

	                    <td>
	                    </td>

					<?
					  }
					?>
                </tr>
                
                <tr>
                	<td>
                    	Capacidad Operativa: 
                    </td>
                    
                    <td>
                    	$
                        <div class="pull-right">
                            <?= $_SESSION['rta cap ope bm f']?>
                        </div>
                    </td>
                    <? 
					  if($_SESSION['modulos']['ren']->escritura == true){
					?>

	                    <td>
	                    </td>

					<?
					  }
					?>
                </tr>
                
                <tr>
                	<td>
                    	Costo de Renta: 
                    </td>
                    <td>
                        	<div id="conCosRen">
	                    $ 
							<div class="pull-right" id="conCanCosRen">
                            	<?= $_SESSION['Costo Renta f'] ?>
							</div>
                    </div>
                    <div id="conActCosRen">
                        <div class="input-group input-group-sm" style="width:110px;">
                          <span class="input-group-addon">$</span>
                          <input id="renCosRen" type="text" class="entorno form-control" placeholder="00.00">
                        </div>
                        <button id="canCosRen" type="button" class="btn btn-primary btn-xs">Cancelar</button>
                        <button id="actCosRen"type="button" class="btn btn-primary btn-xs">Actualizar</button>
                    </div>
                    </td>
                    <? 
					  if($_SESSION['modulos']['ren']->escritura == true){
					?>

	                    <td class="text-center">
	                    	<button id="mosCosRen" type="button" class="btn btn-primary btn-xs">Actualizar Monto</button>                    	
	                    </td>

					<?
					  }
					?>
                    
                </tr>
                
                <tr>
                	<td>
                    	Impactos/Beneficios:
                    </td>
                    <td>
                        	<div id="conInpBen">
	                    $ 
							<div class="pull-right" id="conCanInpBen">
                            	<?= $_SESSION['rta inp ben or f'] ?>
							</div>
                    </div>
                    <div id="conActInpBen">
                        <div class="input-group input-group-sm" style="width:110px;">
                          <span class="input-group-addon">$</span>
                          <input id="renInpBen" type="text" class="entorno form-control" placeholder="00.00">
                        </div>
                        <button id="canInpBen" type="button" class="btn btn-primary btn-xs">Cancelar</button>
                        <button id="actInpBen"type="button" class="btn btn-primary btn-xs">Actualizar</button>
                    </div>
                    </td>
                    <? 
					  if($_SESSION['modulos']['ren']->escritura == true){
					?>

	                    <td class="text-center">
	                    	<button id="mosInpBen" type="button" class="btn btn-primary btn-xs">Actualizar Monto</button>                    	
	                    </td>

					<?
					  }
					?>
                </tr>
                
                <tr>
                	<td>
                    	<b>Costo de Renta Total:</b>
                    </td>
                    <td>
                    	<b>
                        	$
                            <div class="pull-right">
                                <?= $_SESSION['Renta f'] ?>
                            </div>
                        </b>
                    </td>
                    <? 
					  if($_SESSION['modulos']['ren']->escritura == true){
					?>

	                    <td>
	                    </td>

					<?
					  }
					?>

                </tr>
                
            </table>
        
	</div>
</div>

<!--Fin Cuerpo-->
    </div>
    <!--Fin Cuerpo-->
	
    <!--Pie Aqui lo agregamos manualmente para no cargar el JFU ya que el del inventario promedio tiene que ser personalizado-->
    <br />
    <hr>
        <div class="row">	
        	
        	<div class="col-lg-4 text-center">
            </div>
            <div class="col-lg-4 text-center">
            	<div class="col-lg-12 small">
                        	Desarrollado por <a class="pop">Finanzas - IT, KMDC</a>
                </div>
                <div class="col-lg-12 small">
                        	El Marquez, Qro 2014
                </div>
            </div>
            <div class="col-lg-4 text-center">
            </div>
        </div>
	<!--Fin Pie-->

</div>

<? 
	require('medQue.php');
	require('../j/funcionComentarios.php');	
?>
<link rel="stylesheet" href="../c/bootstrap.css" />
<link rel="stylesheet" href="../c/jquery.fileupload-ui.css" />
<div class="modal fade" id="jfuModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

	<div class="modal-dialog">
	    <div class="modal-content">
        
    	  <div class="modal-header">
            <button type="button" class="close cerrarModal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Actualizar Base de Datos</h4>  
          </div>
			<div class="modal-body">
            
            	<!--Inicio jfu-->	
	            <span><b>Archivo Solicitado:</b> </span><span id="archivo"></span>
                <div id="pbCargaArchivo">
                        
                    <div id="contenedorAgregar">
                        <span class="btn btn-primary btn-xs fileinput-button">
                            <i class="glyphicon glyphicon-folder-open"></i>
                            <span>Agregar</span>
                            <!-- The file input field used as target for the file upload widget -->
                            <input id="fileupload" type="file" name="files[]" accept=".xls" class="btn">
                        </span>
                        <br />
                    </div> 
                    
                    <div id="files" class="files" style="margin-bottom:5px;"></div>
                    
                    <!--Boton de complemento, deshabilitado desde la actualizacion de exportacion dbx.php a INFILE
                    <input type="checkbox" id="comSus" data-on-label="Complemento" data-off-label="Sustituc&iacute;on" checked class="switch-mini">
                    -->
                    <div class="btn-toolbar" style="margin-top:5px;">
                        <div class="btn-group btn-group-xs">
                        
                            <input type="hidden" id="tfTabla" />
                            <input type="hidden" id="tfColVac" />
                            <input type="hidden" id="tfUrl" />
                            
                        </div>
                    </div>
                    <br />
                    <div id="progress" class="progress progress-striped active">
                        <div class="progress-bar"></div>
                    </div>
                    
                    <!--Retro del DBX-->
                    <div class="row">
                    	<div class="col-lg-12" id="retro">
                            
                        </div>
                    </div>
                    <!--Fin Retro del DBX-->
                    
				</div>            
				<!--Fin jfu-->
                
            </div>

          <div class="modal-footer">
          	<button type="button" class="btn btn-danger cerrarModal" id="btnCancelar">
            	<i id="boton" class="glyphicon glyphicon-remove"></i>
                Cancelar
			</button>
            <button type="button" class="btn btn-success cerrarModal" id="btnAceptar">
            	<i class="glyphicon glyphicon-ok"></i>
            	Aceptar
            </button>
          </div>
	    </div>
  </div>
  
</div>


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
		
		$('#conActCosRen').hide();
		$('#conActInpBen').hide();
		
		$('#mosCosRen').click(function(){
			$('#conActCosRen').show('slow');
			$('#conCosRen').hide('slow');
			$(this).prop('disabled', true);
		});
		
		$('#canCosRen').click(function(){
			$('#conActCosRen').hide('slow');
			$('#conCosRen').show('slow');
			$('#mosCosRen').prop('disabled', false);
		});
		
		$('#actCosRen').click(function(){
			$.ajax({
				url: 'actCosRen.php',
				async: false,
				type: 'POST',
				dataType: 'json',
				data:{
					'cosRen' : $('#renCosRen').val()
				},
				beforeSend: function(){
					$.each($('.btn'), function(indice, boton){
						$(boton).prop('disabled', true);
					});
				},
				success: function(respuesta){
					alert(respuesta.resumen);
					location.reload();
					
				},
				error: function(respuesta){
					alert(respuesta.responseText);
					$.each($('.btn'), function(indice, boton){
						$(boton).prop('disabled', false);
					});
				}
			});
		});
		
		$('#conActInpBen').hide();
		
		$('#mosInpBen').click(function(){
			$('#conActInpBen').show('slow');
			$('#conInpBen').hide('slow');
			$(this).prop('disabled', true);
		});
		
		$('#canInpBen').click(function(){
			$('#conActInpBen').hide('slow');
			$('#conInpBen').show('slow');
			$('#mosInpBen').prop('disabled', false);
		});
		
		$('#actInpBen').click(function(){
			$.ajax({
				url: 'actInpBen.php',
				async: false,
				type: 'POST',
				dataType: 'json',
				data:{
					'cosRen' : $('#renInpBen').val()
				},
				beforeSend: function(){
					$.each($('.btn'), function(indice, boton){
						$(boton).prop('disabled', true);
					});
				},
				success: function(respuesta){
					alert(respuesta.resumen);
					location.reload();
					
				},
				error: function(respuesta){
					alert(respuesta.responseText);
					$.each($('.btn'), function(indice, boton){
						$(boton).prop('disabled', false);
					});
				}
			});
		});
		
		
		//Creamos la forma de login
		$('#jfuModal').modal({
			show: false,
			keyboard: false,
			backdrop: 'static'
		});
		
		//Ocultamos el boton de aceptar del Dialogo
		$('#btnAceptar').hide();
	
		//Habilitar/Deshabilitar cerrar
		//$('#cerrarModal').attr('disabled', 'disabled');
		//$('#cerrarModal').removeAttr('disabled');
		
		
		//Funcionalidad para cerrar el dialogo
		$('.cerrarModal').click(function(){
			$('#jfuModal').modal('hide');
			$('#progress').removeClass('progress-striped');
			$('#progress').removeClass('active');
			$('#progress .progress-bar').text('');
			$('#progress .progress-bar').css('width','0%');
			$('#contenedorArchivo').hide('slow');
			$('#contenedorArchivo').remove();
			$('#contenedorAgregar').show('slow');
			$('#retro').html('');
		});
		
		//Activar el modal
		$('.activarModal').click(function(){
			$('#tfUrl').val($(this).attr('url'));
			$('#archivo').html($(this).attr('archivo'));
			$('#jfuModal').modal('show');
			$('#btnCancelar').show('fast');
			$('#btnAceptar').hide('fast');
		});
		
		//Funcion para limpiar el JFU
		function limpiarJfu(){
			//$('#jfuModal').modal('hide');
			$('#progress').removeClass('progress-striped');
			$('#progress').removeClass('active');
			$('#progress .progress-bar').text('');
			$('#progress .progress-bar').css('width','0%');
			$('#contenedorArchivo').hide('slow');
			$('#contenedorArchivo').remove();
			$('#contenedorAgregar').show('slow');
			$('#retro').html('');
			
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
				acceptFileTypes: /(\.|\/)(xls)$/i,
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
				
				if( $('#nombreArchivo').text() != ''){
					
					var periodo = $('#periodo').text();
					periodo = periodo.trim();

					$.ajax({
						url: 'dbxSkuRen.php',
						method: 'POST',
						dataType: 'json',
						async: true,
						data:{
							'archivo' : $('#nombreArchivo').text(),
							'url': $('#tfUrl').val(),
							'per' : periodo
						},
						beforeSend: function(){
							$('#progress .progress-bar').text(
								'¡Actualizando Modulo!'
							);
							$('#progress').addClass('progress-striped');
							$('#progress').addClass('active');
							$.each($('.cerrarModal'), function(clave, elemento){
								$(elemento).attr('disabled', 'disabled');
							});
						},
						success: function(respuesta){
							$('#retro').html(respuesta.respuesta);
						},
						error: function(respuesta){
							var mensaje = "Error:";
							mensaje = mensaje + '<br>' + respuesta.status + '->' + respuesta.responseText;
							$('#retro').html(mensaje);
						},
						complete: function(){
							$('#progress').removeClass('progress-striped');
							$('#progress').removeClass('active');
							$('#progress .progress-bar').text('¡Hecho!');
							$('#btnCancelar').hide('fast');
							$('#btnAceptar').show('fast');
							$.each($('.cerrarModal'), function(clave, elemento){$(elemento).removeAttr('disabled');});
						}
					});
					
				}else{
					alert('Error: Faltan datos auxiliares para la exportaci&oacute;n\n'+
						'Favor de contactar al Administrador de IT de KVC'
					);
				}
								
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