<?
require('../enc.php');
require('../scrSub.php');
?>
<div class="row">
        <div class="col-lg-12">
            <h1>
                3PL
            </h1>
        </div>
    </div>

	<div class="row">
    	
        <div class="col-lg-12">
        
        <h4>
        	Informaci&oacute;n General
            <i id="comentarios" class="glyphicon glyphicon-comment" modulo="tpl">
            </i>
        </h4>
        <br>
        <table class="table table-bordered table-hover">
            	
            <thead class="bg-primary">
                <th class="text-center">
                    Nombre
                </th class="text-center">
                <th class="text-center">
                    Total Base Origen
                </th class="text-center">
                <th class="text-center">
                    Total Base Maestra
                </th>
                <th class="text-center">
                    Variaci&oacute;n
                </th>

                <? 
                  if($_SESSION['modulos']['tpl']->escritura == true){
                ?>

                    <th class="text-center">
                        Actualizar
                    </th>

                <?
                  }
                ?>
            </thead>
            
            <tr>
                <td>
                    Descargas:
                </td>
                <td>
                    <div class="pull-left">
                            $    
                        </div>
                    <div class="pull-right">
                        <?= $_SESSION['tpl inb or f']?>
                    </div>
                    
                </td>
                <td>
                    <div class="pull-left">
                            $    
                        </div>
                    <div class="pull-right">
                        <?= $_SESSION['tpl inb bm f']?>
                    </div>
                </td>
                <td>
	                <div class="pull-left">
                        $    
                    </div>
                    <div class="pull-right">
                    	<?= $_SESSION['tpl var inb f']?>
                    </div>
                </td>

                <? 
                  if($_SESSION['modulos']['tpl']->escritura == true){
                ?>

                    <td class="text-center">
                        <button
                            type="button" 
                            class="activarModal btn btn-danger btn-xs"  
                            tabla="inp_3pl" 
                            columnasVacias="3"
                            archivo="Input de 3PL General"
                            url="cts/calTplIfd.php"
                        >
                                <i class="glyphicon glyphicon-refresh"></i> Actualizar
                        </button>
                    </td>

                <?
                  }
                ?>
            </tr>
            
            <tr>
                <td>
                    <a class="pop" id="fijTpl">Fijos:</a>
                </td>
                <td>
                    <div class="pull-left">
                        $    
                    </div>
                    <div class="pull-right">
                        <?= $_SESSION['tpl fij or f']?>
                    </div>
                    
                </td>
                <td>
                    <div class="pull-left">
                        $    
                    </div>
                    <div class="pull-right">
                        <?= $_SESSION['tpl fij bm f']?>
                    </div>
                </td>
                <td>
                    
                </td>
                <? 
                  if($_SESSION['modulos']['tpl']->escritura == true){
                ?>

                    <td class="text-center">
                        <button
                            type="button" 
                            class="activarModal btn btn-danger btn-xs"  
                            tabla="inp_3pl" 
                            columnasVacias="3"
                            archivo="Input de 3PL General"
                            url="cts/calTplIfd.php"
                        >
                                <i class="glyphicon glyphicon-refresh"></i> Actualizar
                        </button>
                    </td>

                <?
                  }
                ?>
            </tr>
            
            <tr>
                <td>
                    Cargas:
                </td>
                <td>
                    <div class="pull-left">
                        $    
                    </div>
                    <div class="pull-right">
                        <?= $_SESSION['tpl cos car or f']?>
                    </div>
                    
                </td>
                <td>
                    <div class="pull-left">
                        $    
                    </div>
                    <div class="pull-right">
                        <?= $_SESSION['tpl cos car bm f']?>
                    </div>
                </td>
                <td>

                <? 
                  if($_SESSION['modulos']['tpl']->escritura == true){
                ?>

                    </td>
                        <td class="text-center">
                        <button
                            type="button" 
                            class="activarModal btn btn-danger btn-xs"  
                            tabla="fle_pic" 
                            columnasVacias="7"
                            archivo="Archivo de Porcentajes de Picking en Fletes"
                            url="cts/calTplCosCar.php"
                        >
                                <i class="glyphicon glyphicon-refresh"></i> Actualizar
                        </button>
                    </td>

                <?
                  }
                ?>
    
                
            </tr>
            <? 
				
			?>
            <tr>
                <td>
                    Reclasificaci&oacute;n:
                </td>
                <td>
                	
                    <div id="conFij">
	                    <div class="pull-left">
                            $    
                        </div>
                    	<div class="pull-right">
                            <?= $_SESSION['tpl fij rec or f']?>
                        </div>
                    </div>
                    <div id="conActFij">
                        <div class="input-group input-group-sm" style="width:110px;">
                          <span class="input-group-addon">$</span>
                          <input id="tplFijRec" type="text" class="entorno form-control" placeholder="00.00">
                        </div>
                        <button id="canFij" type="button" class="btn btn-primary btn-xs">Cancelar</button>
                        <button id="actFij"type="button" class="btn btn-primary btn-xs">Actualizar</button>
                    </div>
                </td>
                <td>	
                	<div class="pull-left">
                        $    
                    </div>
                    <div class="pull-right">
						<?= $_SESSION['tpl fij rec bm f']?>
                    </div>
                </td>
                <td class="text-center">
                    <? 
                      if($_SESSION['modulos']['tpl']->escritura == true){
                    ?>

                        <button id="mosFij" type="button" class="btn btn-primary btn-xs">Actualizar Monto</button>                    	

                    <?
                      }
                    ?>
                </td>

                <? 
                  if($_SESSION['modulos']['tpl']->escritura == true){
                ?>

                    <td class="text-center">
                        <button 
                        	type="button" 
                            data-loading-text="Prorrateando..."
                        	id="prorratear"
                            class="btn btn-danger btn-xs" 
                            back="calTplFijRec.php" 
                            modulo="Fijos Reclasificaci&oacute;n Fijos"
    					>
    	                    <i class="glyphicon glyphicon-refresh"></i> Actualizar
                        </button>
                    </td>

                <?
                  }
                ?>
            </tr>
            
            <tr>
                <td>
                    <b>Totales:</b>
                </td>
                <td>
                    <div class="pull-left">
                        $    
                    </div>
                    <div class="pull-right">
						<?= $_SESSION['tpl or f']?>
                    </div>
                </td>
                <td>
                    <div class="pull-left">
                        $    
                    </div>
                    <div class="pull-right">
						<?= $_SESSION['tpl bm f']?>
                    </div>
                </td>
                <td>
                </td>

                <? 
                  if($_SESSION['modulos']['tpl']->escritura == true){
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

<?  
    require('pie.php');
    require('../j/funcionComentarios.php');
?>

<script>
	$(document).ready(function(){
		
		$('#prorratear').button();
		
		
		$('#fijTpl').popover({
			html: true,
			placement: 'top',
			trigger: 'hover',
			title: 'Gastos Incluidos en el Concepto',
			content: 'Almacenaje cedis foráneos<br>Tiempos extras<br>MO administrativa'
		});
		
		$('#conActFij').hide();
		
		$('#mosFij').click(function(){
			$('#conActFij').show('slow');
			$('#conFij').hide('slow');
			$(this).prop('disabled', true);
		});
		
		$('#canFij').click(function(){
			$('#conActFij').hide('slow');
			$('#conFij').show('slow');
			$('#mosFij').prop('disabled', false);
		});
		
		$('#actFij').click(function(){
			$.ajax({
				url: 'actTplFijRec.php',
				async: false,
				type: 'POST',
				dataType: 'json',
				data:{
					'tplFijosReclasificacion' : $('#tplFijRec').val()
				},
				beforeSend: function(){
					$.each($('.btn'), function(indice, boton){
						$(boton).prop('disabled', true);
					});
				},
				success: function(respuesta){
					alert(respuesta.resumen);
					location.reload();
					$.each($('.btn'), function(indice, boton){
						$(boton).prop('disabled', false);
					});
					$('#inbFij').val('');
					$('#conActFij').hide('slow');
					$('#conFij').show('slow').text('$' + respuesta.valorActual);
					$('#mosFij').prop('disabled', false);
					
				},
				error: function(respuesta){
					alert(respuesta.responseText);
					$.each($('.btn'), function(indice, boton){
						$(boton).prop('disabled', false);
					});
				}
			});
		});
		
		$('#prorratear').click(function(){
			//alert($(this).attr('back'));
			var self = this;
			$.ajax({
				url: $(self).attr('back'),
				async: true,
				type: 'POST',
				dataType: 'json',
				beforeSend: function(){
					$.each($('.btn'), function(indice, boton){
						$(boton).prop('disabled', true);
					});
					$(self).button('loading');
				},
				success: function(respuesta){
					alert(respuesta.resumen);
					location.reload();
					$.each($('.btn'), function(indice, boton){
						$(boton).prop('disabled', false);
					});
				},
				error: function(respuesta){
					alert(respuesta.responseText);
					$.each($('.btn'), function(indice, boton){
						$(boton).prop('disabled', false);
					});
				},
				complete: function(){
					$(self).button('reset');
				}
			});
		});
		
	});
</script>