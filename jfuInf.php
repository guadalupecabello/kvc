<!--
Este plugin esta contruido bajo jQuery y el componente jFileUploader http://blueimp.github.io/jQuery-File-Upload/
Para hacer uso de este componente basta con importar este archivo llamado jfu y sobre todo
crear botones con las siguientes propiedades para llevar a cabo las siguientes accione

Propiedades

activarModal -> Es necesario que el boton tenga esta clase para poder activar un cuadro de fialogo
tabla -> Es un texto en formato mySql con el nombre de la tabla sobre la cual actuara la exportacion del archivo de excel
columnasVacias -> Es un valor entero que indica el numero de columnas en Nulo que tiene la tabla para el posterior procesamiento
archivo -> Es un texto que contiene una descripcion breve sobre el archivo para mostrar dentro del cuadro de dialogo al ser activado
url -> Es un texto que contiene la URL relativa del archivo que procesara las instrucciones para la actualizacion de las bases de datos

<button
	type="button" 
    class="activarModal btn btn-primary"  
    tabla="nombre_tabla" 
    columnasVacias="0"
    archivo="Descripcion de Archivo"
    url="urlEjemplo.php"
>
    	Boton De Ejemplo
</button>

-->

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
                            <input id="fileupload" type="file" name="files[]" accept=".csv" class="btn">
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
            <button type="button" class="btn btn-success" id="btnAceptar">
            	<i class="glyphicon glyphicon-ok"></i>
            	Aceptar
            </button>
          </div>
	    </div>
  </div>
  
</div>

<script src="../j/jquery.js"></script>
<script src="../j/bootstrap.min.js"></script>

<script src="../j/bootstrap-switch.js"></script>
<!--<script src="../j/bsm/prism.js"></script>-->
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
		//Creamos la forma de login
		$('#jfuModal').modal({
			show: false,
			keyboard: false,
			backdrop: 'static'
		});
		
		/*
		* Funcionalidades para el boton aceptar
		*/
		//Oculamos el boton
		$('#btnAceptar').hide();
		//Definimos el evento al hacer clic para recargar la pagina
		$('#btnAceptar').click(function(){
			location.reload();
		});		
		
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
			$('#tfTabla').val($(this).attr('tabla'));
			$('#tfColVac').val($(this).attr('columnasVacias'));
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
				
				if( $('#nombreArchivo').text() != '' &&  $('#tfTabla').val() != '' && $('#tfColVac').val() != ''){
					
					// var url = $('#tfUrl').val() + "?periodo=" + $('#periodo').text() + "&columnasVacias=" + $('#tfColVac').val();
					// url = url.replace(' ','');

					var periodo = $('#periodo').text();
					periodo = periodo.trim();

					$.ajax({
						url: '../dbxInf.php',
						method: 'POST',
						dataType: 'json',
						async: true,
						data:{
							'tabla' : $('#tfTabla').val(),
							'archivo' : $('#nombreArchivo').text(),
							'columnasVacias' : $('#tfColVac').val(),
							'url': $('#tfUrl').val(),
							'periodo': periodo,
							'complemento' : 'false'
						},
						beforeSend: function(){
							//alert(periodo);
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

							// var mensaje = '';
							// $.each(respuesta, function(clave, valor){
							// 	mensaje = mensaje + clave + '=>' + valor + '<br>';
							// });
							// $('#retro').html(mensaje);

							$('#retro').html(respuesta.respuesta);
							

						},
						error: function(respuesta){

							var mensaje = 'Error: ';
							$.each(respuesta, function(clave, valor){
								mensaje = mensaje + clave + '=>' + valor + '<br>';
							});

							// var mensaje = "Error:";
							// mensaje = mensaje + '<br>' + respuesta.status + '->' + respuesta.statusText;
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