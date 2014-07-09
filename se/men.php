<!--
Este es el menu propio del Cost To Serve.
Desde este mismo menu se cargan archivos y se ejecutan las rutinas necesarias para
hacerlo independiente de referencias a otros archivos.
-->

<? 
// error_reporting(E_ALL);
require('../funciones.php');
//Funcionalidad para extraer los periodos automaticamente
validarLogin();

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

/*
* Tomamos todo los periodos existentes en la base de datos
*/

$conexion = conexion();

$query = "select per from periodos
    group by per
    order by per desc";

$periodos = obtenerQueryToArray($conexion, $query);

?>

<link href="../c/bootstrap.css" rel="stylesheet"/>

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
      <img src="../i/kelLog.png" height="23" width="23"/><b>FR</b>
  </a>
  </div>
    
  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <!-- <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <b class="glyphicon glyphicon-list-alt"></b> Modulos </a>
            <ul class="dropdown-menu">
               <li><a href="out.php" modulo=>Outbound</a></li>
            </ul>
          </li> -->
            
            <li class="dropdown">
               <a href="repositorios.php"> <b class="glyphicon glyphicon-list-alt"></b> Repositorios <!-- Din&aacute;micos --> </a>
            </li>

            <li class="dropdown">
               <a href="reportes.php"> <b class="glyphicon glyphicon-file"></b> Reportes <!-- Din&aacute;micos --> </a>
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
                          <li><a class="seleccionPeriodo"><?= $value['per'] ?></a></li>
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
            url: 'datGen.php',
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