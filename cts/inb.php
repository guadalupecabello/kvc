<?
require('../enc.php');
require('../scrSub.php');
?>
<div class="row">
        <div class="col-lg-12">
            <h1>
                Inbound
            </h1>
        </div>
    </div>

	<div class="row">
    	
        <div class="col-lg-12">
        
        <h4>
        	Informaci&oacute;n General
            <i id="comentarios" class="glyphicon glyphicon-comment" modulo="inb">
            </i>
        </h4>
        <br>
        
         <table class="table table-bordered table-hover">
            	<thead class="bg-primary">
                	<th class="text-center">
                    	Nombre
                    </th>
                    <th class="text-center">
                    	Total Base Origen
                    </th>
                    <th class="text-center">
                    	Total Base Maestra
                    </th>
                    

                    <? 
                      if($_SESSION['modulos']['inb']->escritura == true){
                    ?>

                        <th class="text-center">
                            Actualizar
                        </th>
                        <th class="text-center">
                        	Actualizar
                        </th>

                    <?
                      }
                    ?>
                </thead>
                <tr>
                	<td>
                    	Circuitos: 
                    </td>
                    <td>
                    	<div class="pull-left">
                            $    
                        </div>
                        <div class="pull-right">
                        	<?= $_SESSION['inb ori or f']?>
                        </div>
                    	
                    </td>
                    <td>
                    	<div class="pull-left">
                            $    
                        </div>
                        <div class="pull-right">
                        	<?= $_SESSION['inb ori bm f']?>
                        </div>
                    </td>
                    
                    <? 
                      if($_SESSION['modulos']['inb']->escritura == true){
                    ?>

                        <td>
                            
                        </td>
                        <td class="text-center">                    	
                            <button
                                type="button" 
                                class="activarModal btn btn-danger btn-xs"  
                                tabla="inp_inb" 
                                columnasVacias="0"
                                archivo="Input de Inbound de Juan Pablo Gonzales"
                                url="cts/calInbCir.php"
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
                    	Bodegas: 
                    </td>
                    <td>
                    	<div class="pull-left">
                            $    
                        </div>
                        <div class="pull-right">
                        	<?= $_SESSION['inb des or f']?>
                        </div>
                    	
                    </td>
                    <td>
                    	<div class="pull-left">
                            $    
                        </div>
                        <div class="pull-right">
                        	<?= $_SESSION['inb des bm f']?>
                        </div>
                    </td>
                    
                    <? 
                      if($_SESSION['modulos']['inb']->escritura == true){
                    ?>

                        <td>
                            
                        </td>
                        <td class="text-center">
                            <button
                                type="button" 
                                class="activarModal btn btn-danger btn-xs"  
                                tabla="inp_inb" 
                                columnasVacias="0"
                                archivo="Input de Inbound de Juan Pablo Gonzales"
                                url="cts/calInbBod.php"
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
                    	<a id="fijIb" class="pop">Gastos Fijos:</a>
                    </td>
                    <td>
                    	<div id="conFij">
                        	<div class="pull-left">
                                $    
                            </div>
                            <div class="pull-right">
                                <?= $_SESSION['inb fij or f']?>
                            </div>
                        </div>
                        <div id="conActFij">
                        	<div class="input-group input-group-sm" style="width:110px;">
                              <span class="input-group-addon">$</span>
                              <input id="inbFij" type="text" class="entorno form-control" placeholder="00.00">
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
                            <?= $_SESSION['inb fij bm f']?>
                        </div>
                    </td>

                    <? 
                      if($_SESSION['modulos']['inb']->escritura == true){
                    ?>

                        <td class="text-center">
                        	<button id="mosFij" type="button" class="btn btn-primary btn-xs" tabla="inp_fij_out_bou">Actualizar Monto</button>                    	
                        </td>
                        <td class="text-center">
                            <button 
                        	type="button" 
                            data-loading-text="Prorrateando..."
                        	id="prorratear"
                            class="btn btn-danger btn-xs" 
                            back="calInbFij.php" 
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
                            <?= $_SESSION['Inbound f']?>
                        </div>
                    </td>
                    <td>
                    	<div class="pull-left">
                            $    
                        </div>
                        <div class="pull-right">
                            <?= $_SESSION['Inbound f']?>
                        </div>
                    </td>

                    <? 
                      if($_SESSION['modulos']['inb']->escritura == true){
                    ?>

                        <td>
                        </td>
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
		
		
		$('#fijIb').popover({
			html: true,
			placement: 'top',
			trigger: 'hover',
			title: 'Gastos Incluidos en el Concepto',
			content: '<b>1 Beneficios KLMX</b><br>Circuito PT KLMX<br><br><b>2 Reclasificaciones Exportación</b><br>Gastos de distribución PT exportación<br>Reclasificación Gollek<br><br><b>3 Renta Circuito y Gastos Adicionales</b><br>Cuota Fija del Circuito<br>Estadías adicionales del periodo<br>Cierre de provisión<br>Impacto Overflow'
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
				url: 'actInbFij.php',
				async: false,
				type: 'POST',
				dataType: 'json',
				data:{
					'inboundFijos' : $('#inbFij').val()
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
					alert('asda' + respuesta.status + respuesta.responseText);
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