<?
require('../enc.php');
require('../scrSub.php');
?>

<div class="row">
        <div class="col-lg-12">
            <h1>
                Overhead

            </h1>
        </div>
    </div>

	<div class="row">
    	
        <div class="col-lg-12">
        
        <h4>
        	Informaci&oacute;n General
            <i id="comentarios" class="glyphicon glyphicon-comment" modulo="ovh">
            </i>
        </h4>

        <br />
        
        <div class="table-responsive">
            
            <table class="table table-bordered table-hover">
            	<thead class="bg-primary">
                	<td class="text-center">
                    	Nombre
                    </td>
                    <td class="text-center">
                    	Total Base Origen
                    </td>
                    <td class="text-center">
                    	Total Base Maestra
                    </td>

                    <? 
                      if($_SESSION['modulos']['ovh']->escritura == true){
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
                    	Overhead General: 
                    </td>
                    <td>
                    	<div class="pull-left">
                            $
                        </div>
                        <div class="pull-right">
                        	<?= $_SESSION['ovh gen or f']?>
                        </div>
                    	
                    </td>
                    <td>
                    	<div class="pull-left">
                            $
                        </div>
                        <div class="pull-right">
                        	<?= $_SESSION['ovh gen bm f']?>
                        </div>
                    </td>

                    <? 
                      if($_SESSION['modulos']['ovh']->escritura == true){
                    ?>

                        <td class="text-center">
                            <button
                                type="button" 
                                class="activarModal btn btn-danger btn-xs"  
                                tabla="inp_ovh" 
                                columnasVacias="1"
                                archivo="Input de Overhead"
                                url="cts/calOvhNor.php"
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
                    	Overhead Cuentas Especiales: 
                    </td>
                    <td>
                    	<div class="pull-left">
                            $
                        </div>
                        <div class="pull-right">
                        	<?= $_SESSION['ovh cta esp or f']?>
                        </div>
                    </td>
                    <td>
                    	<div class="pull-left">
                            $
                        </div>
                        <div class="pull-right">
                        	<?= $_SESSION['ovh cta esp bm f']?>
                        </div>
                    </td>

                    <? 
                      if($_SESSION['modulos']['ovh']->escritura == true){
                    ?>

                        <td class="text-center">
                            <button
                                type="button" 
                                class="activarModal btn btn-danger btn-xs"  
                                tabla="inp_ovh" 
                                columnasVacias="1"
                                archivo="Input de Overhead"
                                url="cts/calOvhCtaEsp.php"
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
                    	<b>Total General:</b>
                    </td>
                    <td>
                    	<div class="pull-left">
                            $
                        </div>
                        <div class="pull-right">
                        	<b><?= $_SESSION['ovh or f']?></b>
                        </div>
                    </td>
                    <td>
                    	<div class="pull-left">
                            $
                        </div>
                        <div class="pull-right">
                        	<b><?= $_SESSION['ovh bm f']?></b>
                        </div>
                    </td>

                    <? 
                      if($_SESSION['modulos']['ovh']->escritura == true){
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
</div>

<? require('pie.php');
    require('../j/funcionComentarios.php');
?>

<script>
	$(document).ready(function(){
	});
</script>