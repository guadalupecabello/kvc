<!--
Este es el menu propio del Generador de Inventarios
Desde este mismo menu se cargan archivos y se ejecutan las rutinas necesarias para
hacerlo independiente de referencias a otros archivos.
-->

<? 
//Funcionalidad para extraer los periodos automaticamente
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

/*
* Extraemos el periodo actual como una cadena de texto representada de la siguiente forma
* AAAA-MM 
*/

//Tomamos el periodo actual en texto
$periodoActual = date_create('now');
$periodoActualTexto = date_format($periodoActual, 'Y-m');

//Extraemos un 1 y tomamos el periodo anterior
date_sub($periodoActual, date_interval_create_from_date_string('1 months'));
$periodoAnteriorTexto = date_format($periodoActual, 'Y-m');

// echo "<br>" . $periodoAnteriorTexto;
/*
* Tomamos todo los periodos existentes en la base de datos
*/

//Si la funcion no existe importamos el archivo
require('../funciones.php');

$conexion = conexion();

if($_SESSION['periodo'] == '' && $periodo == ''){

  $queryPeriodo = "select max(per) as 'periodo' from periodos";
  $resultado = $conexion->query($queryPeriodo);
  $resultado->fetch_array();
  foreach($resultado as $valor){
    $periodo = $valor['periodo'];
  }

  $_SESSION['periodo'] = $periodo;
  
}else if($periodo != ''){
  $_SESSION['periodo'] = $periodo;
}

$query = "select per from periodos
    group by per
    order by per desc";

$resultado = $conexion->query($query);

$periodos = array();
while($registro = $resultado->fetch_array()){
  array_push($periodos, $registro[0]);
}

?>

    <nav class="navbar navbar-default barraNavegacion" role="navigation">
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
      <span class="sr-only">Inicio</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand " href="index.php">
      <!-- <img src="../i/kelLog.png" height="23" width="23"/> -->
      <b>Inventarios</b>
  </a>
  </div>
    
  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <b class="glyphicon glyphicon-list-alt"></b> Modulos </a>
            <ul class="dropdown-menu">
              <li><a href="out.php">Outbound</a></li>
              <li><a href="ovh.php">Overhead</a></li>
              <li><a href="dxd.php">Dxd</a></li>
              <li><a href="inb.php">Inbound</a></li>
              <li><a href="tpl.php">3PL</a></li>
              <li><a href="ren.php">Renta</a></li>
              <li><a href="basAux.php">Bases Auxiliares</a></li>
            </ul>
          </li>
                
           <li class="dropdown">
            <a href="queDin.php"> <b class="glyphicon glyphicon-file"></b> Queries <!-- Din&aacute;micos --> </a>
          </li>

          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <b class="glyphicon glyphicon-cog"></b> Administraci&oacute;n </a>
            <ul class="dropdown-menu">
              <li><a href="actPer.php">Activar Periodo</a></li>
            </ul>
          </li>

          
        </ul>
        
        <ul class="nav navbar-nav navbar-right">

            <li class="dropdown">
              <a>
                <b class="glyphicon glyphicon-calendar"></b> Periodo:
              </a>
            </li>
    
            <li>
                  <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-default navbar-btn dropdown-toggle" data-toggle="dropdown">
                        <div class="periodo" id="periodo">
                            <?= $_SESSION['periodo'] ?>
                        </div>
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">  
                      <?              

                        //Escupimos los periodos en forma de texto, cuando el indice es 0 se toma como el periodo actual
                        foreach ($periodos as $key => $value) {
                      ?>
                          <li><a class="seleccionPeriodo"><?= $value ?></a></li>
                      <?
                        }
                      ?>
                    </ul>

                  </div>

            </li>

          <li>
            <a href="cerrarSesion.php"><i class="glyphicon glyphicon-off"></i> Cerrar Sesi&oacute;n</a>
          </li>

        </ul>
        
  </div><!-- /.navbar-collapse -->
    
</nav>

<!-- 
Forma para llevar el control del periodo hacia  la consulta de los datos generales
-->

<div class="modal fade" id="modalInformacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close cerrarModal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel">Un segundo por favor</h4>  
      </div>
      <div class="modal-body">
          <div id="progreso" class="progress progress-striped active">
              <div class="progress-bar">
              </div>
          </div>                    
      </div>            
  </div>
</div>
</div>

<script src="../j/jquery.js"></script>
<script>
  $(document).ready(function(){
    //Funcionalidad para el cambio de periodo
    $('body').delegate('.seleccionPeriodo', 'click', function(){
        
        $('#periodo').text($(this).text());
        
        var periodo = $('#periodo').text();
        periodo = periodo.trim();

        $.ajax({
            url: '',
            methond: 'POST',
            dataType: 'text',
            async: true,
            data: {
              'periodo' : periodo
            },
            beforeSend: function(){
              // alert(periodo);
              $('#modalInformacion').modal('show');
              $('#progreso .progress-bar').css(
                'width','100%'
              );
              
              $('#progreso .progress-bar').text(
                'Actualizando datos'
              );

            },
            success: function(respuesta){
              location.reload();
            },
            error: function(respuesta){
              var mensaje = "Error:";
              mensaje = mensaje + '\n' + respuesta.status + '->' + respuesta.responseText;
              alert(mensaje);
            }
        });


    });
    
    $('#modalInformacion').modal({
      show: false,
      keyboard: false,
      backdrop: 'static'
    });

  });
</script>

<style>
  .periodo{
    display:inline;
  }
</style>