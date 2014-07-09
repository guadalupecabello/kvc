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
                text: 'Monthly Average Rainfall'
            },
            subtitle: {
                text: 'Source: WorldClimate.com'
            },
            xAxis: {
                categories: [
                    'Jan',
                    'Feb',
                    'Mar',
                    'Apr',
                    'May',
                    'Jun',
                    'Jul',
                    'Aug',
                    'Sep',
                    'Oct',
                    'Nov',
                    'Dec'
                ]
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Rainfall (mm)'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'Tokyo',
                data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]
    
            }]
        });
    

	});
</script>