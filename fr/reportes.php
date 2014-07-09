<? 
	require('../enc.php');

?>
	
	<h1>
		Exportar
	</h1>

	<p>
		Eliga el tipo de Formato para Fill Rate que dese&eacute; exportar a Microsoft Office Excel
	</p>
	
	<br />

	<h4>
		Resumen Fill Rate
	</h4>
	
	<form action="exportarFillRateResumen.php" method="post" id="expTabCon">

		<div class="row">

			<div class="col-lg-2">

				<p>
					Nombre de Archivo:
				</p>

			</div>

			<div class="col-lg-3">

				<p>

		                <input type="text" name="nombreArchivo" class="form-control">	              
				</p>

			</div>

			<div class="col-lg-6">

				<p>

					<button type="submit" class="btn btn-danger" id="exportarConsolidado">
		                <i class="glyphicon glyphicon-cloud-download"></i>
		            </button>

				</p>
				
			</div>

		</div>

	</form>

	<br />

	<h4>
		Concentrado General de Fill Rate
	</h4>

	<form action="exportarFillRateConcentrado.php" method="post" id="expTabCon">

		<div class="row">

			<div class="col-lg-2">

				<p>
					Nombre de Archivo:
				</p>

			</div>

			<div class="col-lg-3">

				<p>

		                <input type="text" name="nombreArchivo" class="form-control">	              
				</p>

			</div>

			<div class="col-lg-6">

				<p>

					<button type="submit" class="btn btn-danger" id="exportarConsolidado">
		                <i class="glyphicon glyphicon-cloud-download"></i>
		            </button>

				</p>
				
			</div>

		</div>

	</form>
	

<? 
    $desarrollado = "Customer Service - IT, KMDC";
	require('../pie.php'); 
?>