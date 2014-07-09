<? require('../enc.php');require('../scrSub.php');?>
<script src="../j/jquery.bxslider.js"></script>
<link href="../c/jquery.bxslider.css" rel="stylesheet" />



<div class="paginacion" id="p">
</div>
<ul class="bxslider">
  <li><img src="i/ob/tar/1.jpg" title=""/></li>
  <li><img src="i/ob/tar/2.jpg" title="Una vez iniciada la sesión en el Sistema hacemos clic en el Menú en el Apartado de 'Módulos'"/></li>
  <li><img src="i/ob/tar/3.jpg" title="Posteriormente en el Submenú 'Outbound'" /></li>
  <li><img src="i/ob/tar/4.jpg" title="Accederemos a la pantalla de Resumen del Módulo de Outbound de Cost To Serve."/></li>
  <li><img src="i/ob/tar/5.jpg" title="Posteriormente es necesario hacer clic en el botón actualizar del apartado de 'Tarifas Fletes'"/></li>
  <li><img src="i/ob/tar/6.jpg" title="Se muestra en pantalla un cuadro de dialogo con una breve descripción del archivo Solicitado, en este caso el Query de Tarifas de Fletes del Periodo Actual."/></li>
  <li><img src="i/ob/tar/7.jpg" title="Para subir el Query de Tarifas de Fletes hacemos clic en 'Agregar'"/></li>
  <li><img src="i/ob/tar/8.jpg" title="Navegamos hasta el directorio donde se encuentra nuestro archivo"/></li>
  <li><img src="i/ob/tar/9.jpg" title="Hacemos doble clic en el archivo para adjuntarlo al sistema"/></li>
  <li><img src="i/ob/tar/10.jpg" title="En esta parte hacemos clic en el botón 'Cargar', el sistema procesara nuestro archivo y en caso de tener algún error nos indicara en pantalla el tipo y detalle del Error."/></li>
  <li><img src="i/ob/tar/11.jpg" title="Empieza a cargar la barra de estado"/></li>
  <li><img src="i/ob/tar/12.jpg" title="Al terminar de cargar, procesar y prorratear el archivo a la Base Maestra la barra de estado indicara la leyenda de '¡Hecho!' y en el cuerpo del cuadro de Dialogo nos mostrara el Detalle de la Operación."/></li>
  <li><img src="i/ob/tar/13.jpg" title="Ahora solo basta con hacer clic en el Botón 'Aceptar' para recargar los datos."/></li>
</ul>

</div>

	<div class="bx-wrapper">
	<div class="bx-c" 
    	style="position: absolute; padding: 10px; bottom: 10px; left: 0px; z-index: 100;">
    	<span id="descripcion"></span>
    </div>    




<!--Fin Cuerpo-->
    </div>
    <!--Fin Cuerpo-->
	
    <!--Pie-->
    <br />
    <hr>
        <div class="row">	
        	
        	<div class="col-lg-4 text-center">
            </div>
            <div class="col-lg-4 text-center">
            	<div class="col-lg-12 small">
                        	Desarrollado por <a class="pop">Finanzas - IT, KMDC</a>
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
<script>
	$(document).ready(function(){
	  $('.bxslider').bxSlider({
		  'mode':'fade',
		  'pagerSelector':'#p',
		  'captions':true
		});
	});
</script>

<? require('medQue.php'); ?>