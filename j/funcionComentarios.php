<script>
$(document).ready(function(){

        var hayComentario = false;
        var comentarios = '';
        var periodo = $('#periodo').text();
        var modulo = $('#comentarios').attr('modulo');

        var administrador =0; 

        <? 
            if($_SESSION['modulos']['adm']->escritura){
        ?>

            administrador = 1;

        <?
            } 
        ?>


        $.ajax({

            url: 'extraerComentarios.php',
            async: true,
            method: 'POST',
            dataType: 'json',
            data: {
                per: periodo.trim(),
                mod: modulo.trim()
            },
            beforeSend: function(){

            },
            success: function(respuesta){
                hayComentario = '' + respuesta.hayComentario;
                comentarios = respuesta.comentarios;               
            },
            error: function(respuesta){
                var mensaje = '<b>Error</b>:\n' + respuesta.responseText;
                alert(mensaje);
            },
            complete: function(){

                crearComentario(comentarios, administrador);

            }

        });


        function crearComentario(comentarios, administrador){

            var textarea = '<textarea disabled cols="25" rows="10" id="textarea" class="" value="">' + comentarios + '</textarea>';
            
            var botonEditar = '<br><button id="btnEditarComentario" type="button" class="btnEditarComentario btn btn-primary btn-xs">'
                                    + '<i class="glyphicon glyphicon-pencil"></i>' 
                                +'</button> ';

            var botonCancelar = '<button id="btnCancelarComentario" type="button" class="btnCancelarComentario disabled btn btn-primary btn-xs">'
                                    + '<i class="glyphicon glyphicon-remove"></i>' 
                                +'</button> ';

            var botonActualizar = '<button id="btnActualizarComentario" type="button" class="btnActualizarComentario disabled btn btn-primary btn-xs">'
                                    + '<i class="glyphicon glyphicon-ok"></i>' 
                                +'</button> ';

            var contenido = textarea;

            if(administrador == 1){

                contenido += botonEditar + botonCancelar + botonActualizar;

            }

            $('#comentarios').popover({

                html: true,
                placement: 'bottom',
                trigger: 'click',
                title: 'Comentarios',
                content: contenido

            });

        }
        

        $('body').delegate('.btnEditarComentario', 'click', function(){
            
            var comentarioActual = '';

            if(hayComentario == 'true'){
                var comentarioActual = $('#textarea').text();
            }

            $('#textarea').val(comentarioActual);
            $('#textarea').removeAttr('disabled');

            cambiarClases();
            
        });

        $('body').delegate('.btnCancelarComentario', 'click', function(){
            $('#textarea').attr('disabled', 'true');
            cambiarClases();
        });  

        $('body').delegate('.btnActualizarComentario', 'click', function(){

            $('#textarea').attr('disabled', 'true');

            var comentarioNuevo = $('#textarea').val();

            if(comentarioNuevo.length > 0){

                $('#textarea').text(comentarioNuevo);
            
                $.ajax({

                    url: 'insertarComentario.php',
                    async: true,
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        per: periodo.trim(),
                        mod: modulo.trim(),
                        com: comentarioNuevo,
                        hayCom: hayComentario
                    },
                    beforeSend: function(){

                    },
                    success: function(respuesta){
                        alert(respuesta.respuesta);
                        location.reload();
                    },
                    error: function(respuesta){
                        var mensaje = '<b>Error</b>:<br>' + respuesta.responseText;
                        alert(mensaje);
                    }

                });

                cambiarClases();

            } else {

                alert('Favor de Ingresar un comentario valido');

                $('#textarea').text('Sin Comentarios');

            }

            
        });  

        function cambiarClases(){

            $('#btnEditarComentario').toggleClass('disabled');
            $('#btnActualizarComentario').toggleClass('disabled');
            $('#btnCancelarComentario').toggleClass('disabled');

        }
        
		
	});

</script>