<?php
require_once('nav.php');
?>
<div class="container">
	<h2 class="my-4 text-center">Crear Oferta de Empleo</h2>
</div>

<div class="container w-50 p-4 m-auto border border-2 rounded-3">
	<form action="<?php echo FRONT_ROOT ?>JobOffer/add" method="POST" class="justify-content-center">
		<div class="mb-3">
			<label for="formGroupExampleInput" class="form-label">Titulo</label>
			<input type="text" name="title" class="form-control" id="formGroupExampleInput" required>
		</div>
		<div class="mb-3">
			<label for="formGroupExampleInput" class="form-label">Descripcion</label>
			<textarea type="text" name="description" class="form-control" id="formGroupExampleInput" rows="4" required></textarea>
		</div>
		<div class="mb-3">
			<label for="exampleDataList" class="form-label">Carreras</label>
			<input class="form-control" list="datalistOptions" id="exampleDataList" placeholder="Type to search...">
			<datalist id="datalistOptions">
				<?php //TODO: iterate over options when API call works 
				?>
				<option value="San Francisco">
				<option value="New York">
				<option value="Seattle">
				<option value="Los Angeles">
				<option value="Chicago">
			</datalist>
		</div>
		<div class="form-check form-switch m-3">
			<input class="form-check-input" name="isRemote" value="true" type="checkbox" id="flexSwitchCheckChecked" checked>
			<label class="form-check-label" for="flexSwitchCheckChecked">Remoto?</label>
		</div>
		<div class="form-group d-flex justify-content-end">
			<div>
				<button type="submit" class="btn btn-primary m-2 p-auto">Agregar</button>
			</div>
			<div>
				<a type="submit" href="<?php echo FRONT_ROOT ?>Company/showCompaniesView" class="btn btn-secondary m-2 p-auto">Cancelar</a>
			</div>
		</div>
	</form>
</div>