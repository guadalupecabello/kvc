<div id="consola">
</div>
<!--Fin Cuerpo-->
    </div>
<!--Fin Cuerpo-->

<!--Barra de estado-->
<center>
<div class="barraEstado" id="barraEstado">
	<div class="progress progress-striped active">
        <div class="progress-bar" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
            Cargando...
        </div>
	</div>
</div>
</center>
    <!--Pie-->
    <hr>
        <div class="row">	
        	
        	<div class="col-lg-4 text-center">
            </div>
            <div class="col-lg-4 text-center">

                <? 
                    if(!$desarrollado){
                        $desarrollado = "Finanzas - IT, KMDC";
                    }
                ?>
            	<div class="col-lg-12 small">
                        	Desarrollado por <a class="pop"><?= $desarrollado ?></a>
                </div>
                <div class="col-lg-12 small">
                        	El Marquez, Qro 2014
                </div>
            </div>
            <div class="col-lg-4 text-center">
            </div>
        </div>
	<!--Fin Pie-->

</div>

<?
	require('medQue.php');	
	if($exportador == 1){
		require('jfuInf.php');
	}else{
		require('jfu.php');
	}
	
?>

<script>
	$(document).ready(function(){
		$('.barraEstado').hide('slow');
		$('.cuerpo').show('slow');		
	});
</script>