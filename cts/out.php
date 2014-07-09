<?

error_reporting(E_ALL);

require('../enc.php');
require('../scrSub.php');

// $_SESSION['modulos']['out']->lectura

?>
<? 
  if($_SESSION['modulos']['inb']->escritura == true){
?>


<?
  }
?>
<div class="row">
    <div class="col-lg-6">
        <h1>
            Outbound
        </h1>
    </div>
</div>

    <div class="row">
    	
        <div class="col-lg-12">
        
        <h4>
        	
            Informaci&oacute;n General

            <i id="comentarios" class="glyphicon glyphicon-comment" modulo="out">
            </i>

        </h4>

        <div class="table-responsive">
        
            <table class="table table-bordered table-hover table-condensed">
            	<thead class="bg-primary">
                	<td class="text-center">Nombre
                    </td>
                    <td class="text-center">Total Base Origen
                    </td>
                    <td class="text-center">Total Base Maestra
                    </td>

                    <? 
                      if($_SESSION['modulos']['out']->escritura == true){
                    ?>
                        <td class="text-center">Actualizar
                        </td>
                    <?
                      }
                    ?>



                </thead>
            	
                <tr>
                	<td>
                    	Tarifas Fletes
                    </td>
                    <td>
                    	<div class="pull-left">
                            $    
                        </div>
                        
                        <div class="pull-right">
                        	<?= $_SESSION['ob tar or f']?>
                        </div>
                    </td>
                    <td>
                    	<div class="pull-left">
                            $    
                        </div>
                        <div class="pull-right">
                        	<?= $_SESSION['ob tar bm f']?>
                        </div>
                    </td>
                    
                    <? 
                      if($_SESSION['modulos']['out']->escritura == true){
                    ?>

                        <td class="text-center">
                            <button
                                type="button" 
                                class="activarModal btn btn-danger btn-xs"  
                                tabla="tar_fle" 
                                columnasVacias="0"
                                archivo="Query Tarifas de Fletes"
                                url="cts/calOutTar.php"
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
                    	Gastos Adicionales
                    </td>
                    <td>
                    	<div class="pull-left">
                            $    
                        </div>
                        <div class="pull-right">
                        	<?= $_SESSION['ob gas adi or f']?>
                        </div>
                    </td>
                    <td>
                    	<div class="pull-left">
                            $    
                        </div>
                        <div class="pull-right">
                        	<?= $_SESSION['ob gas adi bm f']?>
                        </div>
                    </td>
                    
                    <? 
                      if($_SESSION['modulos']['out']->escritura == true){
                    ?>
                      
                        <td class="text-center">
                        	<button
                                type="button" 
                                class="activarModal btn btn-danger btn-xs"  
                                tabla="gas_eve" 
                                columnasVacias="0"
                                archivo="Bitacora de Gastos Adicionales"
                                url="cts/calOutGasEve.php"
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
                    	<a class="pop" id="fijOb">Gastos Fijos</a>
                    </td>
                    <td>
                    	<div class="pull-left">
                            $    
                        </div>
                        <div class="pull-right">
                        	<?= $_SESSION['ob fij or f']?>
                        </div>
                    </td>
                    <td>
                    	<div class="pull-left">
                            $    
                        </div>
                        <div class="pull-right">
                        	<?= $_SESSION['ob fij bm f']?>
                        </div>
                    </td>
                    
                    <? 
                      if($_SESSION['modulos']['out']->escritura == true){
                    ?>

                        <td class="text-center">
                        	<button
                                type="button" 
                                class="activarModal btn btn-danger btn-xs"  
                                tabla="inp_fij_out_bou" 
                                columnasVacias="2"
                                archivo="Input de Gastos Fijos"
                                url="cts/calOutGasFij.php"
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
                    	<a class="pop" id="manOb">Maniobras</a>
                    </td>
                    <td>
                    	<div class="pull-left">
                            $    
                        </div>
                        <div class="pull-right">
                        	<?= $_SESSION['ob man or f']?>
                        </div>
                    </td>
                    <td>
                    	<div class="pull-left">
                            $    
                        </div>
                        <div class="pull-right">
                        	<?= $_SESSION['ob man bm f']?>
                        </div>
                    </td>

                    <? 
                      if($_SESSION['modulos']['out']->escritura == true){
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
                    	<b>Total General</b>
                    </td>
                    <td>
                    	<div class="pull-left">
                            $    
                        </div>
                        <div class="pull-right">
                        	<b><?= $_SESSION['ob or f']?></b>
                        </div>
                    </td>
                    <td>
                    	<div class="pull-left">
                            $    
                        </div>
                        <div class="pull-right">
                        	<b><?= $_SESSION['ob bm f']?></b>
                        </div>
                    </td>
                    
                    <? 
                      if($_SESSION['modulos']['out']->escritura == true){
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

    
<? 
    require('../pie.php');
    require('../j/funcionComentarios.php');
    
?>

<script>

    $(document).ready(function(){

        $('#fijOb').popover({
            html: true,
            placement: 'top',
            trigger: 'hover',
            title: 'Gastos Incluidos en el Concepto',
            content: 'Torre de control <br>Recurso Confiable<br>Verificadores de transporte<br>Coordinadores cruce de andén'
        });
        
        $('#manOb').popover({
            html: true,
            placement: 'top',
            trigger: 'hover',
            title: 'Atenci&oacute;n',
            content: 'Este concepto se prorratea durante el Modulo <b>Fijos de DxD</b> dado que<br>los montos de gastos vienen del mismo archivo de Maniobras, Gastos, Merma y Fill Rate'
        });              

    });

</script>