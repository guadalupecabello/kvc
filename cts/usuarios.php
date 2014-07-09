<? 
require('../enc.php');
require('../scrSub.php');
?>

<h1>
	Control de Usuarios
</h1>

<div class="row">
	<div class="col-lg-6">
		
		<h4>
			Datos Del Usuario
		</h4>

		<div class="form-group">
			<label>
				Nombre
			</label>
			<input type="text" class="form-control requerido" id="nombreUsuario">
		</div>

		<div class="form-group">
			<label>
				Contrase&ntilde;a
			</label>
			<input type="password" class="form-control requerido" id="contrasenaUsuario">
		</div>

		<div class="form-group">
			<label>
				Confirmar Contrase&ntilde;a
			</label>
			<input type="password" class="form-control requerido" id="confirmarContrasenaUsuario">
		</div>
		<br>
		<div class="form-group text-right">

			<a href="usuarios.php" class="btn btn-primary">
				<i class="glyphicon glyphicon-remove"></i>
				Cancelar
			</a>

			<button type="button" class="btn btn-primary btnGuardarUsuario">
				<i class="glyphicon glyphicon-floppy-saved"></i> 
				Guardar
			</button>

		</div>

	</div>

	<div class="col-lg-6">
		
		<h4>
			Nivel de Acceso
		</h4>
		<br>
		<table class="table table-bordered table-condensed table-striped table-hover">

			<tr>
				<td>

				</td>
				<td class="text-center">
					<b>Lectura</b>
				</td>
				<td class="text-center">
					<b>Escritura</b>
				</td>
			</tr>

			<tr>
				<td>
					<b>Outbound</b>
				</td>
				<td class="text-center">
					<input type="checkbox" class="checkUsuario" modulo="out" propiedad="r">
				</td>
				<td class="text-center">
					<input type="checkbox" class="checkUsuario" modulo="out" propiedad="w">
				</td>
			</tr>

			<tr>
				<td>
					<b>Overhead</b>
				</td>
				<td class="text-center">
					<input type="checkbox" class="checkUsuario" modulo="ovh" propiedad="r">
				</td>
				<td class="text-center">
					<input type="checkbox" class="checkUsuario" modulo="ovh" propiedad="w">
				</td>
			</tr>

			<tr>
				<td>
					<b>DxD</b>
				</td>
				<td class="text-center">
					<input type="checkbox" class="checkUsuario" modulo="dxd" propiedad="r">
				</td>
				<td class="text-center">
					<input type="checkbox" class="checkUsuario"modulo="dxd" propiedad="w">
				</td>
			</tr>

			<tr>
				<td>
					<b>Inbound</b>
				</td>
				<td class="text-center">
					<input type="checkbox" class="checkUsuario" modulo="inb" propiedad="r">
				</td>
				<td class="text-center">
					<input type="checkbox" class="checkUsuario" modulo="inb" propiedad="w">
				</td>
			</tr>

			<tr>
				<td>
					<b>3PL</b>
				</td>
				<td class="text-center">
					<input type="checkbox" class="checkUsuario" modulo="tpl" propiedad="r">
				</td>
				<td class="text-center">
					<input type="checkbox" class="checkUsuario" modulo="tpl" propiedad="w">
				</td>
			</tr>

			<tr>
				<td>
					<b>Renta</b>
				</td>
				<td class="text-center">
					<input type="checkbox" class="checkUsuario" modulo="ren" propiedad="r">
				</td>
				<td class="text-center">
					<input type="checkbox" class="checkUsuario" modulo="ren" propiedad="w">
				</td>
			</tr>

			<tr>
				<td>
					<b>Queries</b>
				</td>
				<td class="text-center">
					<input type="checkbox" class="checkUsuario" modulo="que" propiedad="r">
				</td>
				<td class="text-center">
					<input type="checkbox" class="checkUsuario" modulo="que" propiedad="w">
				</td>
			</tr>

			<tr>
				<td>
					<b>Administraci&oacute;n</b>
				</td>
				<td class="text-center">
					<input type="checkbox" class="checkUsuario" modulo="adm" propiedad="r">
				</td>
				<td class="text-center">
					<input type="checkbox" class="checkUsuario" modulo="adm" propiedad="w">
				</td>
			</tr>

		</table>
	</div>
</div>

<div class="row">
	<div class="col-lg-6">
		
		<h4>
			Usuarios Existentes
		</h4>
		
		<div id="usuariosExistentes">
			
		</div>

	</div>
</div>

<? require('../pie.php'); ?>
<script src="../j/funciones.js"></script>

<script>
	$(document).ready(function(){
		cargarUsuariosExistentes();
	});
	
</script>