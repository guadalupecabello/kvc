/*
 * Fuel UX Datagrid
 * https://github.com/ExactTarget/fuelux
 *
 * Copyright (c) 2012 ExactTarget
 * Licensed under the MIT license.
 */

define(function (require) {

	var $ = require('jquery');

	// Relates to thead .sorted styles in datagrid.less
	var SORTED_HEADER_OFFSET = 22;


	// DATAGRID CONSTRUCTOR AND PROTOTYPE

	var Datagrid = function (element, options) {
		
		this.$element = $(element);
		this.$thead = this.$element.find('thead');
		this.$tfoot = this.$element.find('tfoot');
		this.$footer = this.$element.find('tfoot th');
		this.$footerchildren = this.$footer.children().show().css('visibility', 'hidden');
		this.$topheader = this.$element.find('thead th');
		this.$searchcontrol = this.$element.find('.datagrid-search');
		this.$filtercontrol = this.$element.find('.filter');
		this.$pagesize = this.$element.find('.grid-pagesize');
		this.$pageinput = this.$element.find('.grid-pager input');
		this.$pagedropdown = this.$element.find('.grid-pager .dropdown-menu');
		this.$prevpagebtn = this.$element.find('.grid-prevpage');
		this.$nextpagebtn = this.$element.find('.grid-nextpage');
		this.$pageslabel = this.$element.find('.grid-pages');
		this.$countlabel = this.$element.find('.grid-count');
		this.$startlabel = this.$element.find('.grid-start');
		this.$endlabel = this.$element.find('.grid-end');
		this.$actualizar = this.$element.find('#actualizar');

		this.$tbody = $('<tbody>').insertAfter(this.$thead);
		this.$colheader = $('<tr>').appendTo(this.$thead);

		this.options = $.extend(true, {}, $.fn.datagrid.defaults, options);

		// Shim until v3 -- account for FuelUX select or native select for page size:
		if (this.$pagesize.hasClass('select')) {
			this.$pagesize.select('selectByValue', this.options.dataOptions.pageSize);
			this.options.dataOptions.pageSize = parseInt(this.$pagesize.select('selectedItem').value, 10);
		} else {
			var pageSize = this.options.dataOptions.pageSize;
			this.$pagesize.find('option').filter(function() {
				return $(this).text() === pageSize.toString();
			}).attr('selected', true);
			this.options.dataOptions.pageSize = parseInt(this.$pagesize.val(), 10);
		}

		// Shim until v3 -- account for older search class:
		//if (this.$searchcontrol.length <= 0) {
			this.$searchcontrol = this.$element.find('.search');
		//}

		this.columns = this.options.dataSource.columns();
		

		this.$nextpagebtn.on('click', $.proxy(this.next, this));
		this.$prevpagebtn.on('click', $.proxy(this.previous, this));
		this.$searchcontrol.on('searched cleared', $.proxy(this.searchChanged, this));
		this.$filtercontrol.on('changed', $.proxy(this.filterChanged, this));
		this.$colheader.on('click', 'th', $.proxy(this.headerClicked, this));
		this.$actualizar.on('click', $.proxy(this.update, this));

		if (this.$pagesize.hasClass('select')) {
			this.$pagesize.on('changed', $.proxy(this.pagesizeChanged, this));
		} else {
			this.$pagesize.on('change', $.proxy(this.pagesizeChanged, this));
		}

		this.$pageinput.on('change', $.proxy(this.pageChanged, this));

		//this.renderColumns();

		if (this.options.stretchHeight) this.initStretchHeight();
		
		this.renderData();
	};

	//Funcion que crea el query a partir de los elementos que contiene los Div's Columnas y Sumatorias
	function crearQuery(){
		
		var selectQuery = 'SELECT per AS \'Periodo\', ';
		var selectQuerySumas = 'SELECT \'Total\' AS \'Periodo\', ';
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

			var titulo = $(valor).text();
			titulo = titulo.trim();

			if(inicio == 0){
				campos = campos + ' ' + $(valor).attr('id') + ' AS \''+ titulo +'\'';
				orders = orders + ' ' + $(valor).attr('id');
				camposSumatorias = camposSumatorias + ' \'\'' + ' AS \''+ titulo +'\'';
			}else{
				campos = campos + ', '+ $(valor).attr('id')+ ' AS \''+ titulo +'\'';
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

		var periodoInicio = $('#selectInicio').val();
		var periodoFinal = $('#selectFinal').val();

		var where = ' WHERE';

		if(periodoInicio > periodoFinal){
			where += ' per >= \'' + periodoFinal + '\' and per <= \'' + periodoInicio + '\'';
		} else if(periodoInicio == periodoFinal){
			where += ' per = \'' + periodo + '\'';
		} else if(periodoInicio < periodoFinal){
			where += ' per >= \'' + periodoInicio + '\' and per <= \'' + periodoFinal + '\'';
		}
		
		var query = selectQuery + campos + sumatoriasMetricas +sumCom + sumGenCom + sumGenComMet + tabla + where + ' GROUP BY per, '+ orders;
		var querySumas = selectQuerySumas + camposSumatorias + sumatoriasMetricas +sumCom  + sumGenCom + sumGenComMet + tabla + where;
		
		var queries = new Object();
		
		queries.query = query;
		queries.querySumas = querySumas;

		return queries;

	}

	Datagrid.prototype = {

		constructor: Datagrid,
			
		renderColumns: function () {

			//Cambiamos la referencia de this a self para evitar problemas con los each
			var self = this;
			
			//Definimos las columas sin contenido
			self.columns = [];
			
			//Recorremos los componentes del query desde el contenedor para agregarlo a los encabezados del Grid
			
			//Inicializamos la sumatoria a costo total de distribucion
			var sumGenCom = '';
			var forGenTotCom = ', format(sum(';
			
			//Variable para division Total Costo de Distribucion / Metrica
			var sumGenComAux = sumGenCom;
			var sumGenComMet = '';
			
			var agregarPeriodo = true;
			
			//Recorremos el contenedor de campos
			$.each($('#contenedor').children(), function(campo, valor){

				if(agregarPeriodo == true){

					//Columna para el periodo
					self.columns.push(
							{
								property: 'Periodo',
								label: 'Periodo',
								sortable: true
							}
					);

					agregarPeriodo = false;

				}


				var titulo = $(valor).text();

				self.columns.push(
						{
							property: titulo.trim(),
							label: titulo.trim(),
							sortable: true
						}
				);

			});
			
			//Insertamos los campos de las metricas
			$.each($('#metricas > input:checkbox:checked'), function(c, v){

				self.columns.push(
						{
							property: $('#eti' + $(v).attr('id')).text(),
							label: $('#eti' + $(v).attr('id')).text(),
							sortable: true
						}
				);		
				
			});
			
			var componentes = new Array();
			
			//Extraemos todos los componentes disponibles en las sumatorias
			$.each($('#contenedorSumatorias').children(), function(campo, valor){
			
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
			

			var forTotCom = 'format((';	

			var cGeneral = 0;
			$.each(componentes, function(c, v){
					
					var existeTotal = true;
					var totCom = '';
					var c = 0;
					
					//Capturamos las sumatorias normales
					$.each($('#contenedorSumatorias').children(), function(campo, valor){
						
						if($(valor).attr('componente') == v && $(valor).attr('total') == ''){
							
							self.columns.push(
									{
										property: $(valor).text(),
										label: $(valor).text(),
										sortable: true
									}
							);
							
							
							//Nos ayudamos del contador local para ir agregando el total general
							if(cGeneral==0){
								sumGenCom = sumGenCom + 'sum(' +$(valor).attr('id') + ')';
							}else{
								sumGenCom = sumGenCom + ' + sum('+$(valor).attr('id') + ')';
							}
							
							if($(valor).attr('total') == ''){
								existeTotal = false;
								if(c==0){
									totCom = totCom + 'sum('+$(valor).attr('id') + ')';
								}else{
									totCom = totCom + ' + sum(' + $(valor).attr('id') + ')';
								}
							}

						} else if($(valor).attr('componente') == v && $(valor).attr('total') != ''){

							self.columns.push(
									{
										property: $(valor).text(),
										label: $(valor).text(),
										sortable: true
									}
							);
							
							
							//Nos ayudamos del contador local para ir agregando el total general
							if(cGeneral==0){
								sumGenCom = sumGenCom + '' +$(valor).attr('id') + '';
							}else{
								sumGenCom = sumGenCom + ' + '+$(valor).attr('id') + '';
							}
							
							if($(valor).attr('total') == ''){
								existeTotal = false;
								if(c==0){
									totCom = totCom + '('+$(valor).attr('id') + ')';
								}else{
									totCom = totCom + ' (' + $(valor).attr('id') + ')';
								}
							}

						}


						c++;
						cGeneral++;
						
					});

					//Variable para division Total / Metrica
					var auxTotCom = totCom;

					//Agregamos la columna de total solo cuando no existe el total agrupado
					if(existeTotal == false){
						self.columns.push(
							{
								property: 'Total ' + v,
								label: 'Total ' + v,
								sortable: true
							}
						)
					}
					
					
					//Complementamos el total
					totCom = forTotCom + totCom + '),2)';
					var nombreComponente = 'Total ' + v;
					var aliasComponente = ' AS \'' + nombreComponente + '\'';
					
					
					//Variable para los componentes entre las metricas
					var sumComMet = '';
					
					//Capturamos las sumatorias normales entre las metricas seleccionadas
					$.each($('#metricas > input:checkbox:checked'), function(cc, vv){
						
						$.each($('#contenedorSumatorias').children(), function(campo, valor){
							
							if($(valor).attr('componente') == v && $(valor).attr('total') == ''){
								
								self.columns.push(
									{
										property: $(valor).text() + ' / ' + $('#eti' + $(vv).attr('id')).text(),
										label: $(valor).text() + ' / ' + $('#eti' + $(vv).attr('id')).text(),
										sortable: true
									}
								)

								c++;
								
							}else if($(valor).attr('componente') == v && $(valor).attr('total') != ''){

								self.columns.push(
									{
										property: $(valor).text() + ' / ' + $('#eti' + $(vv).attr('id')).text(),
										label: $(valor).text() + ' / ' + $('#eti' + $(vv).attr('id')).text(),
										sortable: true
									}
								)

							}
						
						});
						
						//Vamos por el Total del Componente / Cada Metrica Seleccionada solo cuando no se ha agregado
						//el Total Agrupado, por que para entonces se tuvo que haber creado uno manual derivado de cada detalle
						if(existeTotal == false){
								self.columns.push(
									{
										property: nombreComponente + ' / ' + $('#eti' + $(vv).attr('id')).text(),
										label:  nombreComponente + ' / ' + $('#eti' + $(vv).attr('id')).text(),
										sortable: true
									}
								);
						}
						
						
					});
					
				});
			
			
			
			if(sumGenCom != ''){

				self.columns.push(
					{
						property: 'Total Costo de Distribuci&oacute;n',
						label:  'Total Costo de Distribuci&oacute;n',
						sortable: true
					}
				);
			}
			
			$.each($('#metricas > input:checkbox:checked'), function(cc, vv){
				sumGenComMet = 'format((' + sumGenCom + ') / sum(' + $(vv).attr('id') + '),2)';
				self.columns.push(
					{
						property: 'Total Costo de Distribuci&oacute;n / ' +  $('#eti' + $(vv).attr('id')).text(),
						label:  'Total Costo de Distribuci&oacute;n / ' +  $('#eti' + $(vv).attr('id')).text(),
						sortable: true
					}
				);
			});
						
			this.$footer.attr('colspan', this.columns.length);
			this.$topheader.attr('colspan', this.columns.length);

			var colHTML = '';

			$.each(this.columns, function (index, column) {
				colHTML += '<th data-property="' + column.property + '"';
				if (column.sortable) colHTML += ' class="sortable"';
				colHTML += '>' + column.label + '</th>';
			});

			self.$colheader.html(colHTML);
		},

		updateColumns: function ($target, direction) {
			
			this._updateColumns(this.$colheader, $target, direction);
			
			if (this.$sizingHeader) {
								
				this._updateColumns(this.$sizingHeader, this.$sizingHeader.find('th').eq($target.index()), direction);
			}
		},

		_updateColumns: function ($header, $target, direction) {
			var className = (direction === 'asc') ? 'icon-chevron-up' : 'icon-chevron-down';
			$header.find('i.datagrid-sort').remove();
			$header.find('th').removeClass('sorted');
			$('<i>').addClass(className + ' datagrid-sort').appendTo($target);
			$target.addClass('sorted');
		},

		updatePageDropdown: function (data) {
			
			var pageHTML = '';

			for (var i = 1; i <= data.pages; i++) {
				pageHTML += '<li><a>' + i + '</a></li>';
			}

			this.$pagedropdown.html(pageHTML);
		},

		updatePageButtons: function (data) {
			if (data.page === 1) {
				this.$prevpagebtn.attr('disabled', 'disabled');
			} else {
				this.$prevpagebtn.removeAttr('disabled');
			}

			if (data.page === data.pages) {
				this.$nextpagebtn.attr('disabled', 'disabled');
			} else {
				this.$nextpagebtn.removeAttr('disabled');
			}
		},

		renderData: function () {
			
			var self = this;
			
			self.renderColumns();

			self.$tbody.html(this.placeholderRowHTML(this.options.loadingHTML));
			
			self.options.dataSource.data(self.options.dataOptions, function (data) {
				var itemdesc = (data.count === 1) ? self.options.itemText : self.options.itemsText;
				var rowHTML = '';

				self.$footerchildren.css('visibility', function () {
					return (data.count > 0) ? 'visible' : 'hidden';
				});

				self.$pageinput.val(data.page);
				self.$pageslabel.text(data.pages);
				self.$countlabel.text(data.count + ' ' + itemdesc);
				self.$startlabel.text(data.start);
				self.$endlabel.text(data.end);

				self.updatePageDropdown(data);
				self.updatePageButtons(data);

				var pri = 0;

				$.each(data.data, function (index, row) {


					rowHTML += '<tr>';

					$.each(self.columns, function (index, column) {

						rowHTML += '<td';
						if (column.cssClass) {
							rowHTML += ' class="' + column.cssClass + '"';
						}

						if(row[column.property]!=null){
							rowHTML += '>' + row[column.property] + '</td>';
						}else{
							// if(pri == 1){
							// 	$.each(row, function(cccc, vvvv){

							// 		alert('\nPro:' + column.property + '\nLon Pro: ' + column.property.length + '\nRow Pro: ' + cccc +'\nRow Pro Lon:' + cccc.length + '\nRow Val: ' + vvvv);

							// 	});
							// }
							rowHTML += '> - </td>';

						}
						
					});

					rowHTML += '</tr>';

					pri++;

				});
				
				if (!rowHTML) rowHTML = self.placeholderRowHTML(self.options.noDataFoundHTML);
				
				self.$tbody.html(rowHTML);
				
				self.stretchHeight();
				self.setColumnWidths();
				self.$element.trigger('Cargado');

			});
			
			

		},

		placeholderRowHTML: function (content) {
			return '<tr><td style="text-align:center;padding:20px;border-bottom:none;" colspan="' +
				this.columns.length + '">' + content + '</td></tr>';
		},

		headerClicked: function (e) {
			var $target = $(e.target);
			if (!$target.hasClass('sortable')) return;
			var direction = this.options.dataOptions.sortDirection;
			var sort = this.options.dataOptions.sortProperty;
			var property = $target.data('property');

			if (sort === property) {
				this.options.dataOptions.sortDirection = (direction === 'asc') ? 'desc' : 'asc';
			} else {
				this.options.dataOptions.sortDirection = 'asc';
				this.options.dataOptions.sortProperty = property;
			}

			this.options.dataOptions.pageIndex = 0;
			this.updateColumns($target, this.options.dataOptions.sortDirection);
			this.renderData();
		},

		pagesizeChanged: function (e, pageSize) {
			if (pageSize) {
				this.options.dataOptions.pageSize = parseInt(pageSize.value, 10);
			} else {
				this.options.dataOptions.pageSize = parseInt($(e.target).val(), 10);
			}

			this.options.dataOptions.pageIndex = 0;
			this.renderData();
		},

		pageChanged: function (e) {
			var pageRequested = parseInt($(e.target).val(), 10);
			pageRequested = (isNaN(pageRequested)) ? 1 : pageRequested;
			var maxPages = this.$pageslabel.text();

			this.options.dataOptions.pageIndex =
				(pageRequested > maxPages) ? maxPages - 1 : pageRequested - 1;

			this.renderData();
		},

		searchChanged: function (e, search) {
			//alert(search.value);
			this.options.dataOptions.search = search;
			this.options.dataOptions.pageIndex = 0;
			this.renderData();
		},

		filterChanged: function (e, filter) {
			alert(filter.value);
			this.options.dataOptions.filter = filter;
			this.options.dataOptions.pageIndex = 0;
			this.renderData();
		},

		previous: function () {
			this.$nextpagebtn.attr('disabled', 'disabled');
			this.$prevpagebtn.attr('disabled', 'disabled');
			this.options.dataOptions.pageIndex--;
			this.renderData();
		},

		next: function () {
			this.$nextpagebtn.attr('disabled', 'disabled');
			this.$prevpagebtn.attr('disabled', 'disabled');
			this.options.dataOptions.pageIndex++;
			this.renderData();
		},

		update: function () {
			
			var self = this;

			var queries = crearQuery();

			//$('#consola').append('<br>Iniciamos el renderData()');
			$.ajax({
				
				url: 'extraerDatos.php',
				async: true,
				type: 'POST',
				dataType: 'json',
				data: {
					'query' : queries.query,
					'querySumas' : queries.querySumas
				},
				beforeSend: function(){
					self.$tbody.html(self.placeholderRowHTML(self.options.loadingHTML));
					// $('#consola').html('<hr>Enviando Query: ' + queries.query + '<hr>' + queries.querySumas);						
				},
				success: function(respuesta){
					//alert(respuesta.length);
					//$('#consola').append('<br>Success en renderData()');
					
					self.options.dataSource._data = [];
					
					var dat = [];
					var m = "<b>Renderizando Datos Desde .renderData()</b><br><b>Componentes:</b>\n";
					
					$.each(respuesta, function(campo, valor){
						
						m = m + '' + campo + '=>'+valor + '<br>';
						
						var registro = new Object();
						
						$.each(valor, function(c, v){
							m = m + c + ', '+ v + '<br>';
							//alert(c + ', '+ v);
							registro[c] = v;
						});
						
						self.options.dataSource._data.push(
							registro
						);
						
					});
					
					//$('#consola').append(m);
					
				},
				error: function(respuesta){
					alert('Error: ' + respuesta.responseText)
				},
				complete: function(){

					self.renderData();
					self.options.dataOptions.update = true;
				}
				
			});
			
			
			
			
		},

		initStretchHeight: function () {
			
			this.$gridContainer = this.$element.parent();

			this.$element.wrap('<div class="datagrid-stretch-wrapper">');
			this.$stretchWrapper = this.$element.parent();

			this.$headerTable = $('<table>').attr('class', this.$element.attr('class'));
			this.$footerTable = this.$headerTable.clone();

			this.$headerTable.prependTo(this.$gridContainer).addClass('datagrid-stretch-header');
			this.$thead.detach().appendTo(this.$headerTable);

			//Se toma el header original hacie el sizing para posteriormente manipularlo
			this.$sizingHeader = this.$thead.clone();
			this.$sizingHeader.find('tr:first').remove();

			this.$footerTable.appendTo(this.$gridContainer).addClass('datagrid-stretch-footer');
			this.$tfoot.detach().appendTo(this.$footerTable);
		},

		stretchHeight: function () {
			//alert('Strech Height');
			if (!this.$gridContainer){
				return;
			} 
			
			var targetHeight = this.$gridContainer.height();
			var headerHeight = this.$headerTable.outerHeight();
			var footerHeight = this.$footerTable.outerHeight();
			var overhead = headerHeight + footerHeight;

			this.$stretchWrapper.height(targetHeight - overhead);
			
		},

		setColumnWidths: function () {
			
			//Se toma el header original hacie el sizing para posteriormente manipularlo
			
			this.$sizingHeader = this.$colheader.clone();
			this.$sizingHeader.find('tr:first').detach();
			/*$('#consola').append('<br><b>Column Widths</b>');
			$.each(this.$sizingHeader, function(c, v){
				$('#consola').append('<br>' + c + ' => ' + v);
				$.each(v, function(cc, vv){
					$('#consola').append('<br>--->' + cc + ' => ' + vv);
				});
			});*/
			
			if (!this.$sizingHeader) return;
			
			//alert('setColumnWidths');
			
			this.$element.prepend(this.$sizingHeader);

			var $sizingCells = this.$sizingHeader.find('th');
			var columnCount = $sizingCells.length;
			
			//alert('Columnas: ' + columnCount);
			
			function matchSizingCellWidth(i, el) {
				if (i === columnCount - 1) return;

				var $el = $(el);
				var $sourceCell = $sizingCells.eq(i);
				var width = $sourceCell.width();
				//alert('Width: ' + width);
				// TD needs extra width to match sorted column header
				if ($sourceCell.hasClass('sorted') && $el.prop('tagName') === 'TD') width = width + SORTED_HEADER_OFFSET;

				$el.width(width);
			}
			
			this.$colheader.find('th').each(matchSizingCellWidth);
			this.$tbody.find('tr > td').each(matchSizingCellWidth);
			this.$tbody.find('tr:first').detach();
			
			
			//alert('removido');
			
		}
	};


	// DATAGRID PLUGIN DEFINITION
	$.fn.datagrid = function (option) {

		return this.each(function () {

			var $this = $(this);
			var data = $this.data('datagrid');
			var options = typeof option === 'object' && option;

			if (!data) $this.data('datagrid', (data = new Datagrid(this, options)));
			if (typeof option === 'string') data[option]();
			
		});

	};

	$.fn.datagrid.defaults = {
		dataOptions: { pageIndex: 0, pageSize: 50},
		loadingHTML: '<div class="progress progress-striped active" style="width:50%;margin:auto;"><div class="bar" style="width:100%;"></div></div>',
		itemsText: 'Elementos',
		itemText: 'Elemento',
        noDataFoundHTML: '0 Elementos'
	};

	$.fn.datagrid.Constructor = Datagrid;

});
