<? 
	header('Content-Type: text/html; charset=UTF-8');
	require('funciones.php');
?>

<!DOCTYPE html>

<html lang="en">

<meta name="viewport" content="initial-scale=1, maximum-scale=1">
<link href="c/bootstrap.css" rel="stylesheet"/>
<link rel="stylesheet" href="c/jquery.fileupload-ui.css">
<link rel="stylesheet" href="c/bsm/prism.css">
<link rel="stylesheet" href="c/bsm/bootstrap-switch.min.css" />

<!-- <div class="resolucion">
</div> -->


<!-- <div class="row"> -->
	<div class="col-lg-12 text-center">
    	
    	<img src="i/klt.png" id="l">
    
    	<h1 >Centro Virtual Kellogg</h1>

	    <button type="button" class="btn btn-primary btn-lg" id="a">
        	<i class="glyphicon glyphicon-user"></i>
        	Iniciar Sesi&oacute;n
		</button>
    </div>
<!-- </div> -->
	<br />


	<div class="col-lg-12 text-center">
		<br>
		
		<a class="pop"><small>TI KMDC - 2014</small></a>
	</div>

<div class="modal fade" id="mLogin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

	<div class="modal-dialog">
	    <div class="modal-content">
    	  <div class="modal-header">
            
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Ingresar</h4>
            
          </div>
          <div class="modal-body">
          	<div class="form-group has-error text-center" id="contenedorMensaje">
                <label class="control-label" id="mensaje"></label>
            </div>
          	<div class="row">
            	<div class="col-lg-3 text-center">
                	<p><b>Usuario:</b></p>
                </div>
                <div class="col-lg-9">
                	<input id="mxk" class="form-control input-sm has-error requerido" type="text" placeholder="Usuario">
                </div>
            </div>
            <br>
            <div class="row">
            	<div class="col-lg-3 text-center">
                	<p><b>Contrase&ntilde;a:</b></p>
                </div>
                <div class="col-lg-9">
                	<input id="con" class="form-control input-sm requerido" type="password" placeholder="************">
                </div>
            </div>
          </div>


          
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" id= "cancelar" data-dismiss="modal">
            	<i class="glyphicon glyphicon-remove"></i>
            	Cancelar
			</button>
            <button type="button" class="btn btn-primary" id="login">
	            <i class="glyphicon glyphicon-ok"></i>
            	Ingresar
			</button>
          </div>
	    </div>
  </div>
  
</div>
<script src="j/jquery.js"></script>
<script src="j/bootstrap.min.js"></script>

<script>
	$(document).ready(function(){
		
		//Ocultamos el mensaje de error al iniciar
		$('#mensaje').hide();
		
		//Creamos la forma de login
		$('#mLogin').modal({
			show: false
		});
		
		//Mostramos la forma de Login al hacer click en Centro Virtual Kellogg
		$('#a').click(function(){
			$('#mLogin').modal('show');
		});
		
		$('#cancelar').click(function(){
			$('#mensaje').hide();
		});
		
		//Funcion para el login
		$('#login').click(function(){
			
			if($('#mxk').val() == '' || $('#con').val() == ''){
				$('#mensaje').text('Error: Favor de llenar ambos campos');
				$('#contenedorMensaje').removeClass('has-success');
				$('#contenedorMensaje').addClass('has-error');
				$('#mensaje').show('fast');
			}else{
				$.ajax({
					url: 'valUsu.php',
					method: 'POST',
					dataType: 'json',
					data: {
						mxk : $('#mxk').val(),
						con : $('#con').val()
					},
					beforeSend: function(){
					},
					success: function(respuesta){
						//alert(respuesta.query + ', '+ respuesta.sesion + ', ' + respuesta.mensaje);
						if(respuesta.sesion == 0){
							
							$('#mensaje').text('Error: ' + respuesta.mensaje);
							$('#contenedorMensaje').removeClass('has-success');
							$('#contenedorMensaje').addClass('has-error');
							$('#mensaje').show('slow');
							
						}else if(respuesta.sesion == 1){
							
							$('#mensaje').text(respuesta.mensaje);
							$('#contenedorMensaje').removeClass('has-error');
							$('#contenedorMensaje').addClass('has-success');
							$('#mensaje').show('slow');
							$(location).attr('href', 'cts/index.php');
						}
					},
					error: function(error){
						$('#mensaje').text('Error: ' + error.responseText);
						$('#contenedorMensaje').removeClass('has-success');
						$('#contenedorMensaje').addClass('has-error');
						$('#mensaje').show('slow');
					}
				});
			}
			
			
		});
		
	});
</script>

<style>
@media screen and (min-width: 1200px) {
	body{
		background:url(i/fonTri.jpg) no-repeat center center fixed;
	}
	#l{
		margin-top:100px;
	}
	.resolucion{
		height:10px;
		width:10px;
		background-color:#F00;
	}
	.pop{cursor: pointer;text-decoration: none;}
	.pop:hover{text-decoration: none;}

	body{
		background:url(i/fonTri.jpg) no-repeat center center fixed;
	}

}

@media screen and (max-width: 1200px) {	
	
	#l{
		margin-top:100px;
	}
	.resolucion{
		height:10px;
		width:10px;
		background-color:#FF0;
	}

	.pop{cursor: pointer;text-decoration: none;}
	.pop:hover{text-decoration: none;}

	body{
		background:url(i/fonTri.jpg) no-repeat center center fixed;
	}
}

@media screen and (max-width: 980px) {	
	#l{
		margin-top:100px;
	}
	
	.resolucion{
		height:10px;
		width:10px;
		background-color:#00FF40;
	}

	.pop{cursor: pointer;text-decoration: none;}
	.pop:hover{text-decoration: none;}

	body{
		background:url(i/fonTri.jpg) no-repeat center center fixed;
	}
}

@media screen and (max-width: 650px) {
	#l{
		margin-top:100px;
		height:124px;
		width:355px;
	}
	#logo{
		
	}
	
	.resolucion{
		height:10px;
		width:10px;
		background-color:#0FF;
	}

	.pop{cursor: pointer;text-decoration: none;}
	.pop:hover{text-decoration: none;}

	body{
		background:url(i/fonTri.jpg) no-repeat center center fixed;
	}
}

@media screen and (max-width: 480px) {
	#l{
		margin-top:100px;
		height:80px;
		width:231px;
	}
	
	.resolucion{
		height:10px;
		width:10px;
		background-color:#F0F;
	}
	
	.pop{cursor: pointer; text-decoration: none;}
	.pop:hover{text-decoration: none;}

	body{
		background:url(i/fonTri.jpg) no-repeat center center fixed;
	}
}
	
</style>

