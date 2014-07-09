<? require('../enc.php'); ?>
<script src="../j/jquery.js"></script>
<link href="../c/fuelux.css" rel="stylesheet">
<script src="../j/require.js"></script>
	
    <h1>
    	Queries Din&aacute;micos
    </h1>
    <div class="row">
    	
    	<div class="col-lg-12 text-center">
        	<h4>Metricas</h4>
        	<div id="metricas">
                <input type="checkbox" name="metricas" id="shiKil"><label id="etishiKil">Kg</label>
                <input type="checkbox" name="metricas" id="shiCubMet"><label id="etishiCubMet">M3</label>
                <input type="checkbox" name="metricas" id="delQua"><label id="etidelQua">Cs</label>
                <input type="checkbox" name="metricas" id="groSal"><label id="etigroSal">Gs</label>
                <input type="checkbox" name="metricas" id="netSal"><label id="etinetSal">Ns</label>
            </div>
        </div>
    </div>
    <hr>
	<h4>Campos</h4>

                <? 
                        require('../funciones.php');

                        $conexion = conexion();
                        $resultado = $conexion->query("SELECT nom, col, com FROM met_tab WHERE tab = 'fle_del' AND com like 'col' order by nom;");
                    	//echo var_dump($conexion);
                        if($resultado->num_rows>0){
							
                    ?>	    
                    <div class="table-responsive">
                           <!-- <div class="btn-group lista" id="ordenable">-->
                    <?		
                            while($fila = $resultado->fetch_array()){
                    ?>
                                <div class="btn btn-xs btn-danger drag" id="<?=$fila[1]; ?>" componente="<?=$fila[2];?>"> <?=$fila[0]; ?> </div>
                    <?		
                            }
                    ?>
                           <!-- </div>-->
                           </div>
                    <?
                        }
                    ?>
        
        <hr>
        
    
            <h4>
                Modulos
            </h4>
            
                
            <div class="row">
            	<div class="col-lg-2">
                    <div class="btn btn-danger btn-xs drag" total="3PL" id="sum(tplInb) + sum(tplFij) + sum(tplCosCar) + sum(tplFijRec) + sum(varTplInb)" componente="3PL" style="width:100%;"><b>Total 3PL</b></div>
                </div>
                <div class="col-lg-2">
                    <div class="btn btn-primary btn-xs drag " id="sum(cosDel) + sum(gasEve) + sum(fijOutBou) + sum(outMan)" total="OB" componente="OB" style="width:100%; max-width:300px;"><b>Total Outbound</b></div>
                </div>
                <div class="col-lg-2">
                    <div class="btn btn-info btn-xs drag" id="sum(inbOri) + sum(inbDes) + sum(inbRec)" total="IB" componente="IB" style="width:100%; max-width:300px;"><b>Total Inbound</b></div>
                </div>
                <div class="col-lg-2">
                    <div class="btn btn-success btn-xs drag" id="sum(dxdLogAux) + sum(mfmDxd)" total="DXD" componente="DXD" style="width:100%; max-width:300px;"><b>Total DXD</b></div>
                </div>
                <div class="col-lg-2">
                    <div class="btn btn-warning btn-xs drag" id="sum(ovhDel) + sum(ovhCtaEsp)" total="OVH" componente="OVH" style="width:100%; max-width:300px;"><b>Total Overhead</b></div>
                </div>
                <div class="col-lg-2">	
                    <div class="btn btn-default btn-xs drag" id="sum(ren) + sum(renCapOpe) + sum(renImpBen)" total="REN" componente="REN" style="width:100%; max-width:300px;"><b>Total Renta</b></div>
                </div>
                
            </div>
            
                    
                <div class="row">
                	<div class="col-lg-2">
                        <div class="btn btn-danger btn-xs drag com3PL" id="tplInb" total="" componente="3PL" style="width:100%; max-width:300px;">3PL Descargas</div>
                    </div>
                    <div class="col-lg-2">
                        <div class="btn btn-primary btn-xs drag comOB " id="cosDel" total="" componente="OB" style="width:100%; max-width:300px;">OB Tarifa</div>
                    </div>
                    <div class="col-lg-2">
                        <div class="btn btn-info btn-xs drag comIB" id="inbOri" total="" componente="IB" style="width:100%; max-width:300px;">IB Circuitos</div>
                    </div>
                    <div class="col-lg-2">
                        <div class="btn btn-success btn-xs drag comDXD" id="dxdLogAux" total="" componente="DXD" style="width:100%; max-width:300px;">DXD Log&iacute;stico</div>
                    </div>
                    <div class="col-lg-2">
                        <div class="btn btn-warning btn-xs drag comOVH" id="ovhDel" total="" componente="OVH" style="width:100%; max-width:300px;">OVH Normal</div>
                    </div>
                    <div class="col-lg-2">	
                        <div class="btn btn-default btn-xs drag comREN" id="ren" componente="REN" total="" style="width:100%; max-width:300px;">REN Almacenaje</div>
                    </div>
                    
                </div>
                <div class="row">
                	<div class="col-lg-2">
                        <div class="btn btn-danger btn-xs drag com3PL" total="" id="tplCosCar" componente="3PL" style="width:100%; max-width:300px;">3PL Cargas</div>
                    </div>
                    <div class="col-lg-2">
                        <div class="btn btn-primary btn-xs drag comOB" total="" id="gasEve" componente="OB" style="width:100%; max-width:300px;">OB Gastos E.</div>
                    </div>
                    <div class="col-lg-2">
                        <div class="btn btn-info btn-xs drag comIB" total="" id="inbDes" componente="IB" style="width:100%; max-width:300px;">IB Bodegas</div>
                    </div>
                    <div class="col-lg-2">
                        <div class="btn btn-success btn-xs drag comDXD" total="" id="mfmDxd" componente="DXD" style="width:100%; max-width:300px;">DXD Man. Fij. Mer.</div>
                    </div>
                    <div class="col-lg-2">
                        <div class="btn btn-warning btn-xs drag comOVH" total="" id="ovhCtaEsp" componente="OVH" style="width:100%; max-width:300px;">OVH Ctas. Esp.</div>
                    </div>
                    <div class="col-lg-2">
                    	<div class="btn btn-default btn-xs drag comREN" id="renImpBen" componente="REN" total="" style="width:100%; max-width:300px;">REN Imp Ben</div>
                    </div>
                </div>
                <div class="row">
                	<div class="col-lg-2">
                        <div class="btn btn-danger btn-xs drag com3PL" total="" id="tplFij" componente="3PL" style="width:100%; max-width:300px;">3PL Fijos</div>
                    </div>
                    <div class="col-lg-2">
                        <div class="btn btn-primary btn-xs drag comOB" total="" id="fijOutBou" componente="OB" style="width:100%; max-width:300px;">OB Fijos</div>
                    </div>
                    <div class="col-lg-2">
                        <div class="btn btn-info btn-xs drag comIB" total="" id="inbRec" componente="IB" style="width:100%; max-width:300px;">IB Fijos</div>
                    </div>
                    <div class="col-lg-2">
                        <div class="btn btn-success btn-xs drag comDXD" total="" id="dxdRecAux" componente="DXD" style="width:100%; max-width:300px;">DxD Rec Allow</div>
                    </div>
                    <div class="col-lg-2">
                    </div>
                    <div class="col-lg-2">
                    	<div class="btn btn-default btn-xs drag comREN" id="renCapOpe" componente="REN" total="" style="width:100%; max-width:300px;">REN Capacidad Op.</div>
                    </div>
                </div>
                <div class="row">
                	<div class="col-lg-2">
                        <div class="btn btn-danger btn-xs drag com3PL" total="" id="tplFijRec" componente="3PL" style="width:100%; max-width:300px;">3PL Reclasificac&oacute;n</div>
                    </div>
                    <div class="col-lg-2">
                    	<div class="btn btn-primary btn-xs drag comOB" total="" id="outMan" componente="OB" style="width:100%; max-width:300px;">OB Maniobras</div>
                    </div>
                    <div class="col-lg-2">
                    </div>
                    <div class="col-lg-2">
                    </div>
                    <div class="col-lg-2">
                    </div>
                    <div class="col-lg-2">
                    </div>
                </div>
                
                <div class="row">
                	<div class="col-lg-2">
                        <div class="btn btn-danger btn-xs drag com3PL" total="" id="varTplInb" componente="3PL" style="width:100%; max-width:300px;">3PL Var. Descargas</div>
                    </div>
                    <div class="col-lg-2">
                    </div>
                    <div class="col-lg-2">
                    </div>
                    <div class="col-lg-2">
                    </div>
                    <div class="col-lg-2">
                    </div>
                    <div class="col-lg-2">
                    </div>
                </div>
                
        		
                <div class="row">
                	<div class="col-lg-12">
                    	
                    </div>
                </div>
                
                
                <hr>
                
                <div class="row">
                	<div class="col-lg-6">
                    	<h4>Area de Campos</h4>
                    	<div class="drop" id="contenedor">
		                </div>
                    </div>
                    <div class="col-lg-6">
                    	<h4>Area de Modulos</h4>
                        
                        <div class="drop" id="contenedorSumatorias">
	                    </div>
                    </div>
                </div>
                
<hr>
           
<h3>
	Resultado
</h3>     
<div class="fuelux table-responsive">
    <!-- DATAGRID -->
	<table id="MyGrid" class="table table-bordered datagrid">

		<thead>
		<tr>
			<th>
				<span class="datagrid-header-title"><b>Vista Previa</b></span>

				<div class="datagrid-header-left">
					<div class="input-append search datagrid-search">
						<input type="text" class="fuelux input-medium" placeholder="Buscar">
						<button class="btn"><i class="fuelux icon-search"></i></button>
					</div>
                    <button class="btn" id="actualizar"><i class="icon-refresh"></i> <b>Generar Vista</b></button>
                    <button class="btn" id="exportar"><i class="icon-download"></i> <b>Exportar a Excel</b></button>
				</div>
				<!--<div class="datagrid-header-right">
					<div class="select filter" data-resize="auto">
						<button data-toggle="dropdown" class="btn dropdown-toggle">
							<span class="dropdown-label"></span>
							<span class="caret"></span>
						</button>
						<ul class="dropdown-menu">
							<li data-value="all" data-selected="true"><a href="#">All</a></li>
							<li data-value="lt5m"><a href="#">Population &lt; 5M</a></li>
							<li data-value="gte5m"><a href="#">Population &gt;= 5M</a></li>
						</ul>
					</div>
				</div>-->
			</th>
		</tr>
		</thead>

		<tfoot>
		<tr>
			<th>
				<div class="datagrid-footer-left" style="display:none;">
					<div class="grid-controls">
						<span>
							<span class="grid-start"></span> -
							<span class="grid-end"></span> de
							<span class="grid-count"></span>
						</span>
						<div class="select grid-pagesize" data-resize="auto">
							<button data-toggle="dropdown" class="btn dropdown-toggle">
								<span class="dropdown-label"></span>
								<span class="caret"></span>
							</button>
							<ul class="dropdown-menu">
								<li data-value="50"><a href="#">50</a></li>
								<li data-value="100"><a href="#">100</a></li>
                                <li data-value="200" data-selected="true"><a href="#">200</a></li>
							</ul>
						</div>
						<span>Por P&aacute;gina</span>
					</div>
				</div>
				<div class="fuelux datagrid-footer-right" style="display:none;">
					<div class="fuelux grid-pager">
						<button type="button" class="fuelux btn grid-prevpage"><i class="fuelux icon-chevron-left"></i></button>
						<span>P&aacute;gina</span>

						<div class="input-append dropdown combobox">
							<input class="span1" type="text">
							<button class="btn" data-toggle="dropdown"><i class="caret"></i></button>
							<ul class="dropdown-menu"></ul>
						</div>
						<span>de <span class="grid-pages"></span></span>
						<button type="button" class="fuelux btn grid-nextpage"><i class="icon-chevron-right"></i></button>
					</div>
				</div>
			</th>
		</tr>
		</tfoot>
	</table>
</div>

    
    <form id="forma" target="_blank" method="post" action="exportar.php">
		<input type="hidden" value="" id="queryExportar" name="query"/>
        <input type="hidden" value="" id="queryExportarSumas" name="querySumas"/>
	</form>

<script>
		
		//Ajustamos las librerias y recursos necesarios
		requirejs.config({
			paths: {
				// 'jquery': 'http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min',
				'jquery': '../j/jquery171',
				'jqueryui': '../j/jqueryui',
				'jqueryui-touchPunch' : '../j/jquery.ui.touch-punch',
				// 'underscore': 'http://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.3.3/underscore-min',
				'underscore': '../j/underscore133',

				'bootstrap': '../j/bootstrap/js',
				'fuelux': '../src'
			},
			shim: {
				'jquery': {
					exports: 'jQuery'
				},
				'jqueryui': {
					deps: ['jquery']
				},
				'jqueryui-touchPunch': {
					deps: ['jquery']
				}
			}
		});
		
		
		var contador = 0;

		/*Hacemos uso de las mismas dentro de la siguiente funcion, la cual tiene el equivalente
		* a $(document).ready();
		*/
		require(['jquery', 'jqueryui', 'jqueryui-touchPunch',   '../sample/datasourceTree', 'fuelux/all'], function ($, sampleData, StaticDataSource, DataSourceTree) {

			//Creamos las estructuras necesarias para el cuerpo del datagrid.
			
			//Cuerpo del DataSourceTree
			var DataSourceTree = function (options) {
					this._data 	= options.data;
					this._delay = options.delay;
				};
				
				DataSourceTree.prototype = {
				
						data: function (options, callback) {
							var self = this;
					
							setTimeout(function () {
								var data = $.extend(true, [], self._data);
					
								callback({ data: data });
					
							}, this._delay)
						}
					
					};
					var StaticDataSource = function (options) {
					this._formatter = options.formatter;
					this._columns = options.columns;
					this._delay = options.delay || 0;
					this._data = options.data;
					
				};

			//Funcionalidad del cuerpo del StaticDataSource
			StaticDataSource.prototype = {
		
				columns: function () {
					return this._columns;
				},
		
				data: function (options, callback) {
					
					/*$.each(options, function(clave, valor){
								alert(clave + valor);
							});*/
					//alert('Cuerpo DataSource');
					var self = this;
		
					setTimeout(function () {
						var data = $.extend(true, [], self._data);
		
						// SEARCHING
						if (options.search) {
							/*
							$.each(options, function(clave, valor){
								alert(clave + valor);
							});*/
							data = _.filter(data, function (item) {
								var match = false;
		
								_.each(item, function (prop) {
									if (_.isString(prop) || _.isFinite(prop)) {
										if (prop.toString().toLowerCase().indexOf(options.search.toLowerCase()) !== -1) match = true;
									}
								});
		
								return match;
							});
						}
		
						// FILTERING
						if (options.filter) {
							
							contador ++;
							data = _.filter(data, function (item) {
								switch(options.filter.value) {
									case 'lt5m':
										if(item.population < 5000000) return true;
										break;
									case 'gte5m':
										if(item.population >= 5000000) return true;
										break;
									default:
										return true;
										break;
								}
							});
							
							/*$.each(options, function(clave, valor){
								alert(clave + valor);
							});*/
							
						}
						
						if(options.update){
							
							/*function(){
								$.each(this, function(c, v){
									alert(c + ', '+ v);
								});
							}*/
							
							columns = [{
									property: 'toponymName',
									label: 'a',
									sortable: true
								},
								{
									property: 'countrycode',
									label: 'b',
									sortable: true
								},
								{
									property: 'population',
									label: 'c',
									sortable: true
								},
								{
									property: 'sharen',
									label: 'd',
									sortable: true
								}
							];
							
						}
		
						var count = data.length;
						// SORTING
						if (options.sortProperty) {
							data = _.sortBy(data, options.sortProperty);
							if (options.sortDirection === 'desc') data.reverse();
						}
		
						// PAGING
						var startIndex = options.pageIndex * options.pageSize;
						var endIndex = startIndex + options.pageSize;
						var end = (endIndex > count) ? count : endIndex;
						var pages = Math.ceil(count / options.pageSize);
						var page = options.pageIndex + 1;
						var start = startIndex + 1;
		
						data = data.slice(startIndex, endIndex);
		
						if (self._formatter) self._formatter(data);
		
						callback({ data: data, start: start, end: end, count: count, pages: pages, page: page });
		
					}, this._delay)
				}
			};


			//Funcion que crea el query a partir de los elementos que contiene los Div's Columnas y Sumatorias
			function crearQuery(){
				
				var selectQuery = 'SELECT ';
				var selectQuerySumas = 'SELECT ';
				var campos = '';
				var camposSumatorias = '';
				
				var orders = '';
				var inicio = 0;
				var tabla = ' FROM fle_del ';
				
				//Inicializamos la sumatoria a costo total de distribucion
				var sumGenCom = '';
				var forGenTotCom = ', format(sum(';
				
				//Variable para division Total Costo de Distribucion / Metrica
				var sumGenComAux = sumGenCom;
				var sumGenComMet = '';
				
				//Extraemos todos los campos informativos
				$.each($('#contenedor').children(), function(campo, valor){
					if(inicio == 0){
						campos = campos + ' ' + $(valor).attr('id') + ' AS \'' + $(valor).text() + '\'';
						orders = orders + ' ' + $(valor).attr('id');
						camposSumatorias = camposSumatorias + ' \'\'';
					}else{
						campos = campos + ', ' + $(valor).attr('id')+ ' AS \'' + $(valor).text() + '\'';
						orders = orders + ', ' + $(valor).attr('id');
						camposSumatorias = camposSumatorias + ',\'\'';
					}
					inicio++;
					
				});
				
				//Aqui insertamos los campos de las sumatorias
				var sumatoriasMetricas = '';
				
				$.each($('#metricas > input:checkbox:checked'), function(c, v){
					if(inicio == 0){
						sumatoriasMetricas = sumatoriasMetricas + 'format(sum(' + $(v).attr('id') + '),2) AS \'' + $('#eti' + $(v).attr('id')).text() + '\'';					
					}else{
						sumatoriasMetricas = sumatoriasMetricas + ', format(sum(' + $(v).attr('id') + '),2) AS \'' + $('#eti' + $(v).attr('id')).text() + '\'';				
					}
					
				});
				
				//Definimos los componentes dispinibles
				var componentes = new Array();
				
				//Extraemos todos los componentes disponibles en las sumatorias
				$.each($('#contenedorSumatorias').children(), function(campo, valor){
					
					//alert($(valor).attr('componente'));
					
					var encontrado = false;
					$.each(componentes, function(c, v){
						if($(valor).attr('componente') == v){
							encontrado = true;
						}
					});
					if(encontrado == false){
						componentes.push($(valor).attr('componente'));
					}
					
				});
				
				//Declaramos las sumatorias por orden de Componente
				var sumCom = '';
				var forTotCom = ', format((';
				var cGeneral = 0;
				
				//Recorremos los componentes disponibles
				$.each(componentes, function(c, v){
					var existeTotal = true;
					var totCom = '';
					var c = 0;
					//Capturamos las sumatorias normales
					$.each($('#contenedorSumatorias').children(), function(campo, valor){
						
						if($(valor).attr('componente') == v && $(valor).attr('total') == ''){
							
							if(inicio == 0){
								sumCom = sumCom + 'format(sum('+$(valor).attr('id')+'), 2) AS \'' + $(valor).text() + '\'';
							}else{
								sumCom = sumCom + ', format(sum('+$(valor).attr('id')+'), 2) AS \'' + $(valor).text() + '\'';
							}
							//Vamos capturando las sumatorias para el total del campo
							if($(valor).attr('total') == ''){
								existeTotal = false;
								if(c==0){
									totCom = totCom + 'sum(' +$(valor).attr('id') + ')';
								}else{
									totCom = totCom + ' + sum('+$(valor).attr('id') + ')';
								}
							}
							
							//Nos ayudamos del contador local para ir agregando el total general
							if(cGeneral==0){
								sumGenCom = sumGenCom + ' sum(' + $(valor).attr('id') + ')';
							}else{
								sumGenCom = sumGenCom + ' + sum('+$(valor).attr('id') + ')';
							}
							
						} else if($(valor).attr('componente') == v && $(valor).attr('total') != ''){

							if(inicio == 0){
								sumCom = sumCom + 'format(('+$(valor).attr('id')+'), 2) AS \'' + $(valor).text() + '\'';
							}else{
								sumCom = sumCom + ', format(('+$(valor).attr('id')+'), 2) AS \'' + $(valor).text() + '\'';
							}
							//Vamos capturando las sumatorias para el total del campo
							if($(valor).attr('total') == ''){
								existeTotal = false;
								if(c==0){
									totCom = totCom + '(' +$(valor).attr('id') + ')';
								}else{
									totCom = totCom + '+ ('+$(valor).attr('id') + ')';
								}
							}
							
							
							//Nos ayudamos del contador local para ir agregando el total general
							if(cGeneral==0){
								sumGenCom = sumGenCom + ' (' + $(valor).attr('id') + ')';
							}else{
								sumGenCom = sumGenCom + '+ ('+$(valor).attr('id') + ')';
							}

						}
						
						c++;
						inicio++;
						cGeneral++;
						
					});
					
					//Variable para division Total / Metrica
					var auxTotCom = totCom;
					
					//Complementamos el total
					totCom = totCom + '),2)';
					var nombreComponente = 'Total ' + v;
					var aliasComponente = ' AS \'' + nombreComponente + '\'';
					//Complementamos el Query
					//Agreamos el total a detalle solo cuando no existe el Total Agrupado
					if(existeTotal == false){
						sumCom = sumCom + forTotCom+ totCom + aliasComponente;
					}
					
					//Variable para los componentes entre las metricas
					var sumComMet = '';
					//alert('5');
					//Capturamos las sumatorias normales entre las metricas seleccionadas
					$.each($('#metricas > input:checkbox:checked'), function(cc, vv){
						
						$.each($('#contenedorSumatorias').children(), function(campo, valor){
							
							if($(valor).attr('componente') == v && $(valor).attr('total') == ''){
								
								
									if(inicio==0){
										sumComMet = sumComMet + ' format(sum(' + $(valor).attr('id') + ') / sum(' + $(vv).attr('id') + '),2) AS \'' + $(valor).text() + ' / ' + $('#eti' + $(vv).attr('id')).text() + '\'';
									}else{
										sumComMet = sumComMet + ', format(sum(' + $(valor).attr('id') + ') / sum(' + $(vv).attr('id') + '),2) AS \'' + $(valor).text() + ' / ' + $('#eti' + $(vv).attr('id')).text() + '\'';
									}

								
								
							}else if($(valor).attr('componente') == v && $(valor).attr('total') != ''){

								if(inicio==0){
									sumComMet = sumComMet + ' format((' + $(valor).attr('id') + ') / sum(' + $(vv).attr('id') + '),2) AS \'' + $(valor).text() + ' / ' + $('#eti' + $(vv).attr('id')).text() + '\'';
								}else{
									sumComMet = sumComMet + ', format((' + $(valor).attr('id') + ') / sum(' + $(vv).attr('id') + '),2) AS \'' + $(valor).text() + ' / ' + $('#eti' + $(vv).attr('id')).text() + '\'';
								}

							}

							c++;
							inicio++;
						
						});
						
						//Vamos por el Total del Componente / Cada Metrica Seleccionada solo cuando no se ha agregado
						//el Total Agrupado, por que para entonces se tuvo que haber creado uno manual derivado de cada detalle
						if(existeTotal == false){
							if(inicio==0){
								sumComMet = sumComMet + ' format((' + auxTotCom + ') / sum(' + $(vv).attr('id') + '),2) AS \'Total ' + v + ' / ' + $('#eti' + $(vv).attr('id')).text() + '\'';
							}else{
								sumComMet = sumComMet + ', format((' + auxTotCom + ') / sum(' + $(vv).attr('id') + '),2) AS \'Total ' + v + ' / ' + $('#eti' + $(vv).attr('id')).text() + '\'';
							}
						}
						
					});
					
					/*$.each($('#metricas > input:checkbox:checked'), function(c, v){
						//alert();
						if(inicio==0){
							sumComMet = sumComMet + ' format(sum(' + auxTotCom + ') / sum(' + $(v).attr('id') + '),2) AS \'' + nombreComponente + ' / ' + $('#eti' + $(v).attr('id')).text()+ '\'';
						}else{
							sumComMet = sumComMet + ', format(sum(' + auxTotCom + ') / sum(' + $(v).attr('id') + '),2) AS \'' + nombreComponente + ' / ' + $('#eti' + $(v).attr('id')).text()+ '\'';
						}
						//alert();
					});*/
					
					sumCom = sumCom + sumComMet;
					
				});
				
				//Agregamos la division del Costo Total de Distribucion entre cada metrica existente
				$.each($('#metricas > input:checkbox:checked'), function(cc, vv){
					sumGenComMet = sumGenComMet + ', format((' + sumGenCom + ') / sum(' + $(vv).attr('id') + '),2) AS \'Total Costo de Distribuci&oacute;n / ' + $('#eti' + $(vv).attr('id')).text() + '\'';
				});
				
				if(sumGenCom != ''){
					sumGenCom = ', format((' + sumGenCom + '), 2) AS \'Total Costo de Distribuci&oacute;n\'';
				}
				
				var periodo = $('#periodo').text();
				periodo = periodo.trim();
				
				var query = selectQuery + campos + sumatoriasMetricas +sumCom + sumGenCom + sumGenComMet + tabla + ' WHERE per = "' + periodo + '"  GROUP BY'+ orders;
				var querySumas = selectQuerySumas + camposSumatorias + sumatoriasMetricas +sumCom  + sumGenCom + sumGenComMet + tabla + ' WHERE per = "' + periodo + '"';
				
				$('#consola').html("<hr>Query desde Exportar Excel: " + querySumas + "<hr>" + query);
				$('#queryExportar').val(query);
				$('#queryExportarSumas').val(querySumas);
				$('#forma').submit();

			}
			
			$('#exportar').click(function(){
				crearQuery();
			});
			
			//Al momento de hacer click en el boton se activara el llenado del dataGrid
			$('#crearQuery').click(function(){
				
				//Recorremos todo el contenedor para tomar las columnas para le query
				var query = 'SELECT ';
				var inicio = 0;
				$.each($('#contenedor').children(), function(campo, valor){
					if(inicio == 0){
						query = query + ' ' + $(valor).attr('id');
					}else{
						query = query + ', ' + $(valor).attr('id');
					}
					inicio++;
				});
				
				query = query + ' FROM fle_del \nGROUP BY ' + query + ' with rollup';
				
				//Lanzamos la llamada Ajax al archivo que lo preocesara con sus respectios parametros
				$.ajax({
					url: 'extraerDatos.php',
					async: 'true',
					type: 'POST',
					dataType: 'json',
					data: {
						'query' : query
					},
					beforeSend: function(){
						
					},
					success: function(respuesta){
						
						var dat = [];
						
						var mensaje = 'Respuesta: \n';
						$.each(respuesta, function(campo, valor){
							mensaje = mensaje + campo + '\n';
							$.each(valor, function(c, v){
								mensaje = mensaje + c + ', ' + v + '\n';
								
							});
							
						});
						alert(mensaje);
					},
					error: function(respuesta){
						alert('Error: ' + respuesta.responseText)
					}
				});
				
			});
			
			$("#contenedor").sortable();
			$("#contenedorSumatorias").sortable();
			
			$('.drag').draggable({
				helper: 'clone',
				revert: 'invalid'
			});			
			
			$('#contenedor').droppable({
				
				drop: function(event, ui){
					
					if(ui.draggable.hasClass('drag')){
						//alert('tiene');
						var div = $(this);
						var d = ui.draggable;
						var c = d.clone();
						c.click(function(){
							$('#' + $(this).attr('id')).draggable('enable').removeClass('disabled');
							//alert('#' + $(this).attr('id'));
							this.remove();
						});
						$(c).appendTo(div)
						.draggable('disable')
						.removeClass('drag')
						;
						d.draggable('disable').addClass('disabled');
					}else{
						//alert('no tiene');
					}
					
				}
			});
			
			//Agregamos la funcionalidad tambien para el contenedor de las sumatorias
			$('#contenedorSumatorias').droppable({
				
				drop: function(event, ui){
					
					if(ui.draggable.hasClass('drag')){
						//alert('tiene');
						var div = $(this);
						var d = ui.draggable;
						var c = d.clone();
						c.click(function(){
							$('#' + $(this).attr('id')).draggable('enable').removeClass('disabled');
							this.remove();
							
							//Si eliminamos el total habilitaremos de nuevo los submodulos
							if($(c).attr('total') != ''){
								$.each($('.com' + $(c).attr('total')), function(campo, valor){
									$(valor).draggable('enable').removeClass('disabled');
								});
							}
							
							$(d).draggable('enable').removeClass('disabled');
							
						});
						$(c).appendTo(div)
							.draggable('disable')
							.removeClass('drag');
						//Si agregamos el total eliminamos todos aquellos que pertenezcan al modulo para que no se agreguen a detalle
						if($(c).attr('total') != ''){
							$.each($('#contenedorSumatorias').children(), function(campo, valor){
								if($(valor).attr('componente') == $(c).attr('componente') && $(valor).attr('total') == ''){
									$(valor).remove();
								}
							});
							
							//Si agregamos el total del modulo deshabilitamos todos los submodulos que pertenecen 
							$.each($('.com' + $(c).attr('total')), function(campo, valor){
								$(valor).draggable('disable').addClass('disabled');
							});
							
						}
						
						d.draggable('disable').addClass('disabled');
						
					}else{
						//alert('no tiene');
					}
					
				}
			}).click(function(){
				
			});
			
			
			
			var dat = new Array();
			
			var datos0 = [{
					"fcodeName": "capital of a political entity",
					"toponymName": "Uno",
					"countrycode": "MX",
					"fcl": "P",
					"fclName": "city, village,...",
					"name": "Mexico City",
					"wikipedia": "",
					"lng": -99.12766456604,
					"fcode": "PPLC",
					"geonameId": 3530597,
					"lat": 19.428472427036,
					"population": 12294193
				}, {
					"fcodeName": "capital of a political entity",
					"toponymName": "Dos",
					"countrycode": "PH",
					"fcl": "P",
					"fclName": "city, village,...",
					"name": "Manila",
					"wikipedia": "",
					"lng": 120.9822,
					"fcode": "PPLC",
					"geonameId": 1701668,
					"lat": 14.6042,
					"population": 10444527
				}];
				
			var datos1 = [{
				"fcodeName": "capital of a political entity",
				"toponymName": "asd",
				"countrycode": "MX",
				"fcl": "P",
				"fclName": "city, village,...",
				"name": "Mexico City",
				"wikipedia": "",
				"lng": -99.12766456604,
				"fcode": "PPLC",
				"geonameId": 3530597,
				"lat": 19.428472427036,
				"population": 12294193
			}, {
				"fcodeName": "capital of a political entity",
				"toponymName": "Cuatro",
				"countrycode": "PH",
				"fcl": "P",
				"fclName": "city, village,...",
				"name": "Manila",
				"wikipedia": "",
				"lng": 120.9822,
				"fcode": "PPLC",
				"geonameId": 1701668,
				"lat": 14.6042,
				"population": 10444527
			}];
			dat[0]=datos0;
			dat[1]=datos1;

			var contador = 0;
			$('#recargar').click(function(){
				alert('recargando');
				$('#myGrid').datagrid('pagesizeChanged');
				alert('terminado recargar');
			});


			// DATAGRID
			//$('#llenar').click(function(){
				//Componentes de la clase
				
				
				var datos = null;
				if(contador % 2 == 0){
					//alert('si');
					datos = dat[0];
				}else{
					//alert('no');
					datos = null;
					//datos = dat[1];
				}
				contador++;
				//alert('contador: ' + contador);
				
				var dataSource = new StaticDataSource({
					columns:[{
									property: 'toponymName',
									label: 'uno',
									sortable: true
								},
								{
									property: 'countrycode',
									label: 'dos',
									sortable: true
								},
								{
									property: 'population',
									label: 'tres',
									sortable: true
								},
								{
									property: 'sharen',
									label: 'cuatro',
									sortable: true
								}
			],
					data: datos,
					delay: 250
				});
				
				$('#MyGrid').datagrid({
					dataSource: dataSource,
					stretchHeight: false
				});
			//});
			
		});

</script>

<style type="text/css">

		.lista{
			
			max-height:350px;
			/*overflow-y:scroll;*/
			-webkit-user-select: none;
			-moz-user-select: none;
			-khtml-user-select: none;
		}
		
		#ordenable{
			overflow-x:scroll;
		}

		.drop{
			-webkit-user-select: none;
			-moz-user-select: none;
			-khtml-user-select: none;
			/*min-width:400px;*/
			overflow-y:scroll;
			margin:10px;
			height:110px;
			border:solid 1px #000;
			border-top-left-radius:10px;
			border-bottom-left-radius:10px;
			padding-bottom:5px;
			padding-top:5px;
			padding-right:50px;
			display:block;
		}
		.drop > .btn{
			margin:3px;
		}
		.centrado{
			position:fixed;
			text-align:center;
		}
				
</style>

<!--Fin Cuerpo-->
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

<div id="consola">
	
</div>
<style>
	body{
		background:url(../i/fonTri.jpg) no-repeat center center fixed;
		padding-left: 10px;
		padding-right: 10px;
		padding-bottom: 10px;
		
	}
	.contenedor{
		border-radius:5px;
		background-color:#FFF;
		width:100%;
		margin:0 auto 0 auto;
		margin-top:10px;
		padding-bottom:30px;
		margin-bottom:20px;
		
	}
	.cuerpo{
		padding-left:15px;
		padding-right:15px;
		padding-bottom:15px;
	}
</style>
