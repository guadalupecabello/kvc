//Funciones generales del sistema
// $(document).ready(function(){

/*
* Funciones Generales ----------------------------------------------------------------------------
*/
	var modoAdministracion = 0;
	//Funcion para bloquear los botones existentes a manera que se eviten cualquier accion mientras se carga un scritp
	function bloquearBotones(){

		$('.btn').each(function(){
			$(this).addClass('disabled');
		});

	}

	//Funcion para desbloquear los botones existentes a manera que se remueva el bloque por el metodo bloquearBotones
	function desbloquearBotones(){

		$('.btn').each(function(){
			$(this).removeClass('disabled');
		});

	}

	//Funcion que valida todos los inputs con la clase '.requerido' verificando que tenga algun valor
	function validarInputs(){

		//Booleano para indicar si procede o no procede la accion
		var bandera = true;

		//Recorremos la coleccion verificando los valores de cada input
		$('.requerido').each(function(){

			var valor = $(this).val();

			//Si no hay nada en el input cambiamos a falso la bandera
			if(valor.length == 0){

				bandera = false;

			}

		});

		if(bandera == false){
			alert('Hay campos de texto vacios\nFavor de Llenar el formulario');
		}

		return bandera;

	}

	//Funcion para mandar a consola algun mensaje
	function c(mensaje){
		$('#consola').append('<hr>' + mensaje);
	}





/*
* Fin Modulo Usuarios -----------------------------------------------------------------------------
*/


	
/*
* Funciones Modulo Usuarios -----------------------------------------------------------------------
*/


	//Funcion para mandar los datos del usuario y su nivel de vista en COST TO SERVE y enviarlos al scritp en el servidor
	$('body').delegate('.btnGuardarUsuario', 'click', function(){

		//Extraemos los valores de los inputs
		var nombreUsuario = $('#nombreUsuario').val();
		var contrasena = $('#contrasenaUsuario').val();
		var confirmarContrasena = $('#confirmarContrasenaUsuario').val();

		/*Extraemos el estado de los check de la forma de usuarios por Modulo agregando
		* la siguiente sintaxis: 
		* modulos = [
		*	{
		*		nombre : 'out',
		*		propiedades : {
		*			lectura : true,
		*			escritura: false
		*		}
		*	},
		*	{	
		*		nombre : 'ovh',
		*		propiedades : {
		*			lectura : false,
		*			escritura: true
		*		}
		*	}
		* ]
		*/

		var nombreModulos = ['out', 'ovh', 'dxd', 'inb', 'tpl', 'ren', 'que', 'adm'];

		var modulos = new Array();

		$.each(nombreModulos, function(indice, nombreModulo){

			var propiedades = new Object();

			$('[modulo = ' + nombreModulo +  ']').each(function(){
				
				var selfCheck = $(this);
				var atributo = $(selfCheck).attr('propiedad');
				var estado = $(selfCheck).is(':checked');

				if(atributo == 'r'){

					propiedades.lectura = estado;

				} else if (atributo == 'w'){

					propiedades.escritura = estado;

				}

			});

			var modulo = new Object();

			modulo.nombre = nombreModulo;
			modulo.propiedades = propiedades;

			modulos.push(modulo);

		});

		var bandera = validarInputs();

		if(bandera == true){

			if(contrasena == confirmarContrasena){

				$.ajax({
					url: 'administrarUsuarios.php',
					async: true,
					method: 'POST',
					dataType: 'json',
					data: {

						modo: modoAdministracion,
						usu: nombreUsuario,
						con : contrasena,
						mod : JSON.stringify(modulos)

					},
					beforeSend: function(){
						// c(nombreUsuario);
						// c(contrasena);
						// c(JSON.stringify(modulos));
					},
					success: function(respuesta){
						alert(respuesta.respuesta);
						location.reload();
					},
					error: function(respuesta){
						var m = 'Errora\n' + respuesta.responseText;
						alert(m);
					},
					complete: function(){

					}

				});

			} else {
				alert('Las contrase\u00F1as no coinciden');
			}

		}

	});

	$('body').delegate('.btnEditarUsuario', 'click', function(){
		
		modoAdministracion = 2;

		var mxk = $(this).attr('mxk');

		$.ajax({
			url: 'administrarUsuarios.php',
			async:true,
			method: 'POST',
			dataType: 'json',
			data: {
				modo: modoAdministracion,
				usu: mxk
			},
			beforeSend: function(){
				
				bloquearBotones();
			},
			success: function(respuesta){

				$.each(respuesta, function(indice, usuario){
					
					$('#nombreUsuario').val(usuario.mxk);
					$('#contrasenaUsuario').val(usuario.contrasena);
					$('#confirmarContrasenaUsuario').val(usuario.contrasena);

					// alert('\'' + usuario.modulos + '\'');

					$.each($.parseJSON(usuario.modulos), function(c, modulo){
						// alert(modulo.nombre);
						// alert(modulo.propiedades.lectura);

						$('[modulo = ' + modulo.nombre +  ']').each(function(){

							if($(this).attr('propiedad') == 'r'){
								$(this).prop('checked', modulo.propiedades.lectura);
							} else if($(this).attr('propiedad') == 'w'){
								$(this).prop('checked', modulo.propiedades.escritura);
							}

						});

					});

					
				});

				con += '</table>';

				$('#usuariosExistentes').html(con);

			},
			error: function(respuesta){
				alert('Error: ' + respuesta.responseText);
			},
			complete: function(){
				desbloquearBotones();
				modoAdministracion = 3;
			}
		});

	});

$('body').delegate('.btnEliminarUsuario', 'click', function(){
		
		modoAdministracion = 4;

		var mxk = $(this).attr('mxk');

		if (confirm('¿Seguro que desea eliminar al Usuario?')) { 

			$.ajax({
				url: 'administrarUsuarios.php',
				async:true,
				method: 'POST',
				dataType: 'json',
				data: {
					modo: modoAdministracion,
					usu: mxk
				},
				beforeSend: function(){
					bloquearBotones();
				},
				success: function(respuesta){
					alert(respuesta.respuesta);
					location.reload();
				},
				error: function(respuesta){
					alert('Error: ' + respuesta.responseText);
				},
				complete: function(){
					desbloquearBotones();
					modoAdministracion = 0;
				}
			});
			
		}

		

	});

	function cargarUsuariosExistentes(){

		$.ajax({
			url: 'administrarUsuarios.php',
			async:true,
			method: 'POST',
			dataType: 'json',
			data: {
				modo: 1
			},
			beforeSend: function(){
				bloquearBotones();
			},
			success: function(respuesta){

				con = '';

				con += '<table class="table table-bordered table-stripped table-hover">';
					con += '<thead class="bg-primary">';
						con += '<td class="text-center">';
							con += 'Usuario';
						con += '</td>';
						con += '<td class="text-center">';
							con += 'Editar';
						con += '</td>';
						con += '<td class="text-center">';
							con += 'Eliminar';
						con += '</td>';
					con += '</thead>';
				

				$.each(respuesta, function(indice, usuario){

					con += '<thead>';
						con += '<td>';
							con += usuario.mxk;
						con += '</td>';
						con += '<td class="text-center">';
							con += '<button type="button" class="btn btn-info btn-xs btnEditarUsuario" mxk="' + usuario.mxk + '">'
								con +='<i class="glyphicon glyphicon-pencil">';
								con +='</i>';
							con += '</button>';
						con += '</td>';
						con += '<td class="text-center">';
							con += '<button type="button" class="btn btn-danger btn-xs btnEliminarUsuario"  mxk="' + usuario.mxk + '">'
								con +='<i class="glyphicon glyphicon-remove">';
								con +='</i>';
							con += '</button>';
						con += '</td>';
					con += '</thead>';

				});

				con += '</table>';

				$('#usuariosExistentes').html(con);

			},
			error: function(respuesta){
				alert('Error: ' + respuesta.responseText);
			},
			complete: function(){
				desbloquearBotones();
			}
		});

	}
	

	


/*
* Fin Modulo Usuarios -----------------------------------------------------------------------------
*/




// });