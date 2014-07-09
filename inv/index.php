<? 
error_reporting(0);
require('../enc.php');
?>

<h1>
	Existencias
</h1>

<h4>
	Informaci&oacute;n General
</h4>

<table class="table table-condensed table-bordered table-hover">

	<thead class="bg-primary">
		<td class="text-center">
			Base
		</td>
		<td class="text-center">
			Registros
		</td>
		<td class="text-center">
			Actualizar
		</td>
	</thead>
	
	<tbody>
		<tr>
			<td>
				Existencias en Citi Park
			</td>
			<td class="text-right">
				00.00
			</td>
			<td class="text-center">
				<button
                    type="button" 
                    class="activarModal btn btn-danger btn-xs"  
                    tabla="inv_exi_cit" 
                    columnasVacias="1"
                    archivo="Archivo de existencias en Citi Park"
                    url=""
                >
                        <i class="glyphicon glyphicon-refresh"></i> Actualizar
                </button>
			</td>
		</tr>
	</tbody>
	
</table>

<?
$desarrollado = "IT";
require('../pie.php'); 
?>