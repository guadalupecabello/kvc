<?

error_reporting(E_ALL);

require('../enc.php');
require('../scrSub.php');

?>

	<div class="row">
        <div class="col-lg-12">
            <h1>
                Periodos
            </h1>
        </div>
    </div>

	<div class="row">
        <div class="col-lg-12">
            <h4>
            	
            </h4>   
        </div>
    </div>

    <div class="row">
        
        <div class="col-lg-6">
            <p>
                <h4>Dar de alta un nuevo Periodo</h4>
                <input id="textPeriodo" type="text" class="form-control">
            </p>
            <p>
                <button id="botonActivarPeriodo" class="btn btn-primary btn-lg" data-loading-text="Activando Periodo...">
                    <i class="glyphiconn glyphicon-plus"></i> Agregar
                </button>
            </p>
        </div>
        <div class="col-lg-6">
            <div id="contenido" class="invisible">
            asd
            </div>
            <div class="cargando" id='cargando'><div class="progress progress-striped active"><div class="progress-bar " style="width: 100%">Cargando...</div></div>
        </div>
        </div>
    

    </div>
    
    <br>
    
<? require('pie.php');?>

<script>
	$(document).ready(function(){

        var info = false;

        $('#botonActivarPeriodo').button();

        $('#botonActivarPeriodo').click(function(){

            var periodoActivar = $('#textPeriodo').val();

            if(periodoActivar != ''){
                $.ajax({
                    url: 'activarPeriodo.php',
                    method: 'POST',
                    async: true,
                    dataType: 'json',
                    data:{
                        per : periodoActivar
                    },
                    beforeSend: function(){
                        $('#botonActivarPeriodo').button('loading');
                    },
                    success: function(respuesta){
                        alert(respuesta.respuesta);
                        location.reload();
                    },
                    error: function(respuesta){
                        alert(respuesta.responseText);
                    },
                    complete: function(){
                        $('#botonActivarPeriodo').button('reset');
                    }

                });
            }else{
                alert('Favor de Ingresar un Periodo Valido');
            }

            

        });        

        $.ajax({
            url: 'extraerPeriodos.php',
            method: 'POST',
            async: true,
            dataType: 'json',
            data:{
            },
            success: function(respuesta){
                if(info == true){
                    $('#consola').html(print_r(respuesta));
                }else{

                    var con = "<h4>Periodos Actuales</h4>";

                    con += "<table class='table table-bordered table-condensed table-hover table-condensed' >";

                        con += "<thead>";

                        con += "</thead>";

                        $.each(respuesta, function(c, v){
                            con += "<tr>";
                                con += "<td>";
                                    con += v.per;
                                con += "</td>";                        
                            con += "</tr>"; 
                        });

                    con += "</table>";
                    
                    $('#contenido').html(con);

                }
            },
            error: function(respuesta){
                var mensaje = 'Error:';
                mensaje = mensaje + '<br>' + respuesta.status + '<br>' + respuesta.responseText;
                $('#contenido').html(mensaje);
            },
            complete: function(){
                $('#contenido').toggleClass('invisible');
                $('#cargando').toggleClass('invisible');
            }
        });

        function deshabilitarBotones(){

            $('.btn').each(function(){
                $(this).attr('disabled', 'disabled');
            });

        }

        function print_r(arr,level) {
            var dumped_text = "";
            if(!level) level = 0;

            //The padding given at the beginning of the line.
            var level_padding = "";
            for(var j=0;j<level+1;j++) level_padding += "    ";

            if(typeof(arr) == 'object') { //Array/Hashes/Objects 
                for(var item in arr) {
                    var value = arr[item];

                    if(typeof(value) == 'object') { //If it is an array,
                        dumped_text += level_padding + "'" + item + "' ...<br>";
                        dumped_text += print_r(value,level+1);
                    } else {
                        dumped_text += level_padding + "'" + item + "' => \"" + value + "\"<br>";
                    }
                }
            } else { //Stings/Chars/Numbers etc.
                dumped_text = "===>"+arr+"<===("+typeof(arr)+")";
            }
            return dumped_text;
        }
		
	});
</script>