<? 
	/*
	* El encabezado contiene:	
	* Hojas de estilo
	* Menu
	* Declaracion del <div> que compone el cuerpo del Documento HTML
	*/
	require('../enc.php');
?>

<!-- Inicio Cuerpo HTML -->



<h1>
	Graficas
</h1>

<div class="table-responsive">
	
	<h4>
		Parametros
	</h4>
	
	<center>

		<div class="" id="container" style="width:800px;"></div>
		
	</center>
	

</div>




<!-- Fin Cuerpo HTML -->
<? 	
	/*
	El pie contiene:
	Cierre del <div> que compone el cuerpo del Documento HTML
	Librerias y archivos *.js
	Plug-in JFU para importacion de archivos de Excel o CSV
	*/
	require('../pie.php');
?>

<!-- 
	Aqui puedes poner tus rutinas en Javascript/jQuery para el manejo del documento
-->
<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>

<script>

	$(document).ready(function(){


       $('#container').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Fill Rate'
            },
            xAxis: {
                categories: ['P01', 'P02', 'P03', 'P04', 'P05']
            },
            yAxis: {
                min: 0,
                max: 100,
                title: {
                    text: 'Porcentaje'
                },
                stackLabels: {
                    enabled: true,
                    style: {
                        fontWeight: 'bold',
                        color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                    }
                }
            },
            legend: {
                align: 'right',
                x: -70,
                verticalAlign: 'top',
                y: 20,
                floating: true,
                backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
                borderColor: '#CCC',
                borderWidth: 1,
                shadow: false
            },
            tooltip: {
                formatter: function() {
                    return '<b>'+ this.x +'</b><br/>'+
                        this.series.name +': '+ this.y +'<br/>'+
                        'Total: '+ this.point.stackTotal;
                }
            },
            plotOptions: {
                column: {
                    stacking: 'normal',
                    dataLabels: {
                        enabled: true,
                        color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
                        style: {
                            textShadow: '0 0 3px black, 0 0 3px black'
                        }
                    }
                }
            },
            series: [{
                name: 'PGI',
                data: [10, 10, 10, 10, 10]
            }, {
                name: 'ATP',
                data: [2, 2, 3, 2, 1]
            }, {
                name: 'SD',
                data: [3, 4, 4, 2, 5]
            }, {
                name: 'REJ',
                data: [20, 20, 20, 20, 20]
            }]
        });
    

	});
</script>