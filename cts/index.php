<?

error_reporting(0);
require('datGen.php');
require('../enc.php');
require('../scrSub.php');
//En este caso no hace falta indicar que llamamos desde el cost to serve

?>

    <div class="row">
        <div class="col-lg-12">
        	
          <div class="pull-left">
          	 <h1>
                    Base Maestra
              </h1>
            </div>

            <div class="pull-right">

              <? 
                if($_SESSION['modulos']['adm']->escritura == true){
              ?>

                <h1>
                <button
                          type="button" 
                          class="activarModal btn btn-primary"  
                          tabla="fle_del_tem"
                          columnasVacias="31"
                          archivo="Archivo de Facturacion del Periodo Actual"
                          url="cts/actFleDel.php"
                      >
                              <i class="glyphicon glyphicon-upload"></i> Actualizar
                      </button>
                </h1>

              <?
                }
              ?>
            </div>
            
            <div class="pull-right">
            	
            </div>
        </div>
    </div>
    
    <h4>
        Informaci&oacute;n General
    </h4>
    <div class="row">
        <div class="col-lg-5">
            <b>Costo Total de Distribuci&oacute;n / Kilogramos:</b>
            <div class="pull-right">
                $<?=$_SESSION['Total Costo Distribucion / Kilos']?>
            </div>
        </div>
        <div class="col-lg-5 col-md-offset-2">
            <b>Costo Total de Distribucion:</b>
            <div class="pull-right">
                $<?=$_SESSION['Total Costo Distribucion f']?>
            </div>
        </div>
    </div>
    
    <br>
    
    <!--Tabla-->
    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive">
                <table class="table table-condensed table-hover table-bordered">
                  <thead>
                    <tr class="bg-primary">
                      <td class="text-center">Metrica</td>
                      <td  class="text-center">Total</td>
                      <td  class="text-center">Modulo</td>
                      <td  class="text-center">Total</td>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      
                      <td>Kilos:</td>
                      <td>
                        <div class="pull-right">
                            <?=$_SESSION['Kilos f']?>
                        </div>
                      </td>
                      
                      <td>Outbound:</td>
                        
                      <td>
                        <div class="pull-left">
                            $
                        </div>
                        <div class="pull-right">
                            <?= $_SESSION['Outbound f']?>
                        </div>
                      </td>
                      
                    </tr>
                    
                    <tr>
                      <td>Metros Cubicos:</td>
                      <td>
                        <div class="pull-right">
                            <?=$_SESSION['Metros Cubicos f']?>
                        </div>
                      </td>
                      
                      <td>Overhead:</td>
                      <td>
                        <div class="pull-left">
                            $
                        </div>
                        <div class="pull-right">
                            <?=$_SESSION['Overhead f']?>
                        </div>
                      </td>
                    </tr>
                    
                    <tr>
                      <td>Cajas:</td>
                      <td>
                        <div class="pull-right">
                            <?=$_SESSION['Cajas f']?>
                        </div>
                      </td>
                      
                      <td>DxD:</td>
                      <td>
                          <div class="pull-left">
                                $
                            </div>
                            <div class="pull-right">
                                <?=$_SESSION['Dxd Logistico f']?>
                            </div>
                      </td>
                    </tr>
                    
                    <tr>
                      <td rowspan="3"></td>
                      <td rowspan="3"></td>
                      
                      <td>Inbound:</td>
                      <td>
                        <div class="pull-left">
                            $
                        </div>
                        <div class="pull-right">
                            <?=$_SESSION['Inbound f']?>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      
                      <td>3PL:</td>
                      <td>
                        <div class="pull-left">
                            $
                        </div>
                        <div class="pull-right">
                            <?=number_format($_SESSION['3PL'], 2)?>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      
                      <td>Renta</td>
                      <td>
                        <div class="pull-left">
                            $
                        </div>
                        <div class="pull-right">
                            <?=$_SESSION['Renta f']?>
                        </div>
                      </td>
                    </tr>
                    
                  </tbody>
                </table>
            </div>
            
        </div>
    </div>
    <!--Tabla-->
    
    <div class="row">
    	<div class="col-lg-12">
        
        	<h4>
                Desglose de Modulo / Metrica
            </h4>
        	<p>
            	Detalle de cada uno de los Modulos que componen 'Cost To Serve' entre cada una de las metricas Disponibles.
            </p>
            <br>

            <div class="table-responsive">
              <table class="table table-condensed table-hover table-bordered table-condensed">
                <thead>
                          <tr class="bg-primary">
                              <td class="text-center">
                                  /
                              </td>
                              <td class="text-center">
                                  Outbound
                              </td>
                              <td class="text-center">
                                  Overhead
                              </td>
                              <td class="text-center">
                                  Dxd
                              </td>
                              <td class="text-center">
                                  Inbound
                              </td>
                              <td class="text-center">
                                  3PL
                              </td>
                              <td class="text-center">
                                Renta
                              </td>
                              <td class="text-center">
                                <b>Total</b>
                              </td>
                          </tr>
            </thead>
                      <tbody>
                        <tr>
                              <td>
                                  Kilogramos:
                              </td>
                              <td>
                                <div class="pull-left">
                                  $
                                </div>
                                  <div class="pull-right">
                                    <?= $_SESSION['ob/kg f']?>
                                  </div>
                              </td>
                              <td>
                                
                                  <div class="pull-left">$</div>

                                  <div class="pull-right">
                                    <?= $_SESSION['ovh/kg f']?>
                                  </div>
                              </td>
                              <td>
                                   <div class="pull-left">$</div>
                                   <div class="pull-right">
                                    <?= $_SESSION['dxd/kg f']?>
                                  </div>
                              </td>
                              <td>
                                   <div class="pull-left">$</div>
                                   <div class="pull-right">
                                    <?= $_SESSION['inb/kg f']?>
                                  </div>
                              </td>
                              <td>
                                   <div class="pull-left">$</div>
                                   <div class="pull-right">
                                    <?= $_SESSION['tpl/kg f']?>
                                  </div>
                              </td>
                              <td>
                                   <div class="pull-left">$</div>
                                   <div class="pull-right">
                                    <?= $_SESSION['rta/kg f']?>
                                  </div>
                              </td>
                              <td>
                                  <b>
                                      <div class="pull-left">$</div>
                                      <div class="pull-right">
                                          <?=number_format(($_SESSION['ob/kg']+$_SESSION['ovh/kg']+$_SESSION['dxd/kg']+$_SESSION['inb/kg']+$_SESSION['tpl/kg']+$_SESSION['rta/kg']), 2);?>
                                      </div>
                                  </b>
                              </td>
                          </tr>
                          
                          <tr>
                              <td>
                                  Metros Cubicos:
                              </td>
                              <td>
                                  <div class="pull-left">$</div>
                                  <div class="pull-right">
                                    <?= $_SESSION['ob/m3 f']?>
                                  </div>
                              </td>
                              <td>
                                   <div class="pull-left">$</div>
                                   <div class="pull-right">
                                    <?= $_SESSION['ovh/m3 f']?>
                                  </div>
                              </td>
                              <td>
                                  <div class="pull-left">$</div>
                                   <div class="pull-right">
                                    <?= $_SESSION['dxd/m3 f']?>
                                  </div>
                              </td>
                              <td>
                                   <div class="pull-left">$</div>
                                   <div class="pull-right">
                                    <?= $_SESSION['inb/m3 f']?>
                                  </div>
                              </td>
                              <td>
                                   <div class="pull-left">$</div>
                                   <div class="pull-right">
                                    <?= $_SESSION['tpl/m3 f']?>
                                  </div>
                              </td>
                              <td>
                                  <div class="pull-left">$</div>
                                  <div class="pull-right">
                                    <?= $_SESSION['rta/m3 f']?>
                                  </div>
                              </td>
                              <td>
                              <b>
                                <div class="pull-left">$</div>
                                <div class="pull-right">
                                    <?= 
                      number_format(($_SESSION['ob/m3']+$_SESSION['ovh/m3']+$_SESSION['dxd/m3']+$_SESSION['inb/m3']+$_SESSION['tpl/m3']+$_SESSION['rta/m3']), 2);
                    ?>
                                  </div>                            
                              </b>
                              </td>
                          </tr>
                          
                          <tr>
                              <td>
                                  Cajas:
                              </td>
                              <td>
                                  <div class="pull-left">$</div>
                                  <div class="pull-right">
                                    <?= $_SESSION['ob/cs f']?>
                                  </div>
                              </td>
                              <td>
                                   <div class="pull-left">$</div>
                                   <div class="pull-right">
                                    <?= $_SESSION['ovh/cs f']?>
                                  </div>
                              </td>
                              <td>
                                   <div class="pull-left">$</div>
                                   <div class="pull-right">
                                    <?= $_SESSION['dxd/cs f']?>
                                  </div>
                              </td>
                              <td>
                                   <div class="pull-left">$</div>
                                   <div class="pull-right">
                                    <?= $_SESSION['inb/cs f']?>
                                  </div>
                              </td>
                              <td>
                                   <div class="pull-left">$</div>
                                   <div class="pull-right">
                                    <?= $_SESSION['tpl/cs f']?>
                                  </div>
                              </td>
                              <td>
                                 <div class="pull-left">$</div>
                                 <div class="pull-right">
                                  <?= $_SESSION['rta/cs f']?>
                                  </div>
                              </td>
                              <td>
                                  <b>
                                      <div class="pull-left">$</div>
                                      <div class="pull-right">
                                        <?= number_format(($_SESSION['ob/cs']+$_SESSION['ovh/cs']+$_SESSION['dxd/cs']+$_SESSION['inb/cs']+$_SESSION['tpl/cs']+$_SESSION['rta/cs']), 2);?>
                                      </div>
                                  </b>
                              </td>
                          </tr>
                      </tbody>
                          
                      </table>
            </div>
        	 
        </div>
    </div>

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
    
<div id="consola">
  
</div>

<? 
require('medQue.php');  
require('../jfuInf.php');

?>