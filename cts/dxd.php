<?
require('../enc.php');
require('../scrSub.php');
?>
<div class="row">
        <div class="col-lg-12">
            <h1>
                DxD
            </h1>
        </div>
    </div>

	<div class="row">
    	
        <div class="col-lg-12">
        
        <h4>
        	Informaci&oacute;n General
            <i id="comentarios" class="glyphicon glyphicon-comment" modulo="dxd">
            </i>
        </h4>
        <br>
        <table class="table table-bordered table-hover table-condensed">
            	<thead class="bg-primary">
                	<td class="text-center">
                    	Concepto
                    </td>
                    <td class="text-center">
                    	Total Base Origen
                    </td>
                    <td class="text-center">
                    	Total Base Maestra
                    </td>
                    <? 
                      if($_SESSION['modulos']['dxd']->escritura == true){
                    ?>

                        <td class="text-center">
                        	Actualizar
                        </td>

                    <?
                      }
                    ?>
                </thead>
                <tr>
                	<td>
                    	Dxd:
                    </td>
                    <td>
                    	<div class="pull-left">
                            $    
                        </div>
                        <div class="pull-right">
                        	<?= $_SESSION['dxd tot or f']?>
                        </div>
                    	
                    </td>
                    <td>
                    	<div class="pull-left">
                            $    
                        </div>
                        <div class="pull-right">
                        	<?= $_SESSION['dxd tot bm f']?>
                        </div>
                    </td>

                    <? 
                      if($_SESSION['modulos']['dxd']->escritura == true){
                    ?>

                        <td class="text-center">
                            <button
                                type="button" 
                                class="activarModal btn btn-danger btn-xs"  
                                tabla="dxd_liz" 
                                columnasVacias="4"
                                archivo="Input de DxD Total"
                                url="cts/calDxdTotAux.php"
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
                    	Reclasificacion Allowances:
                    </td>
                    <td>
                    	<div class="pull-left">
                            $    
                        </div>
                        <div class="pull-right">
                        	<?= $_SESSION['dxd rec or f']?>
                        </div>
                    	
                    </td>
                    <td>
                    	<div class="pull-left">
                            $    
                        </div>
                        <div class="pull-right">
                        	<?= $_SESSION['dxd rec bm f']?>
                        </div>
                    </td>

                    <? 
                      if($_SESSION['modulos']['dxd']->escritura == true){
                    ?>

                        <td class="text-center">
                        	<button
                                type="button" 
                                class="activarModal btn btn-danger btn-xs"  
                                tabla="dxd_rec_liz" 
                                columnasVacias="3"
                                archivo="Input de Reclasificaci&oacute;n Allowances"
                                url="cts/calDxDRecLiz.php"
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
                    	Dxd Logistico:
                    </td>
                    <td>
                        <div class="pull-left">
                            $    
                        </div>
                        <div class="pull-right">
                            <?= $_SESSION['dxd log or f'] ?>
                        </div>
                    	
                    </td>
                    <td>
                        <div class="pull-left">
                            $    
                        </div>
                        <div class="pull-right">
                        	<?= $_SESSION['dxd log bm f']?>
                        </div>
                    </td>

                    <? 
                      if($_SESSION['modulos']['dxd']->escritura == true){
                    ?>

                        <td class="text-center">
                        	<button 
                        	type="button" 
                            data-loading-text="Prorrateando..."
                        	id="prorratear"
                            class="btn btn-danger btn-xs" 
                            back="calDxdLog.php" 
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
                    	Fill Rate, Merma:
                    </td>
                    <td>
                    	<div class="pull-left">
                            $    
                        </div>
                        <div class="pull-right">
                        	<?= $_SESSION['dxd mfm or f']?>
                        </div>
                    	
                    </td>
                    <td>
                    	<div class="pull-left">
                            $    
                        </div>
                        <div class="pull-right">
                        	<?= $_SESSION['dxd mfm bm f']?>
                        </div>
                    </td>

                    <? 
                      if($_SESSION['modulos']['dxd']->escritura == true){
                    ?>

                        <td class="text-center">
                            <button
                                type="button" 
                                class="activarModal btn btn-danger btn-xs"  
                                tabla="inp_dxd_mfm" 
                                columnasVacias="2"
                                archivo="Input de Maniobras, Merma, Fijos y Fill Rate"
                                url="cts/calDxdMfm.php"
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
                    	<b>Total:</b>
                    </td>
                    <td>
                    	
                        <div class="pull-right">
                        </div>
                    	
                    </td>
                    <td>
                    	<div class="pull-left">
                            $    
                        </div>
                        <div class="pull-right">
                        	<?= $_SESSION['dxd bm f']?>
                        </div>
                    </td>

                    <? 
                      if($_SESSION['modulos']['dxd']->escritura == true){
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

<? require('pie.php');
    require('../j/funcionComentarios.php');
?>

<script>
	$(document).ready(function(){
		
		$('#prorratear').button();
		
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
					location.reload();
					$(self).button('reset');
				}
			});
		});
		
		
	});
</script>