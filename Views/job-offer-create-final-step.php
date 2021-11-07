<?php
require_once('nav.php');
?>
<div class="container">
	<h2 class="my-4 text-center">Crear Oferta de Empleo 2/2</h2>
</div>

<div class="container w-50 p-4 m-auto border border-2 rounded-3">
	<form action="<?php echo FRONT_ROOT ?>JobOffer/requestAddNew" method="POST" class="justify-content-center">
		<div class="mb-3">
			<label for="formGroupExampleInput" class="form-label">Empresa</label>
			<input id="prodId" name="id_company" type="hidden" value="<?php echo $company->getId() ?>">
			<input type="text" value="<?php echo $company->getName() ?>" class="form-control w-10" id="formGroupExampleInput" readonly>
		</div>
		<div class="mb-3">
			<label for="formGroupExampleInput" class="form-label">Carrera</label>
			<input id="prodId" name="id_career" type="hidden" value="<?php echo $career->getId_career() ?>">
			<input type="text" value="<?php echo $career->getDescription() ?>" class="form-control w-10" id="formGroupExampleInput" readonly>
		</div>
		<div class="mb-3">
			<label for="formGroupExampleInput" class="form-label">Posicion</label>
			<select name="id_jobPosition" class="form-select" aria-label="Default select example">
				<?php foreach ($jobPositionList as $jobPosition) {
					echo '<option value="' . $jobPosition->getId_jobPosition() . '">' . $jobPosition->getDescription() . '</option>';
				}
				?>
			</select>
		</div>
		<div class="mb-3">
			<label for="formGroupExampleInput" class="form-label">Titulo</label>
			<input type="text" name="title" class="form-control" id="formGroupExampleInput" required>
		</div>
		<div class="mb-3">
			<label for="formGroupExampleInput" class="form-label">Descripcion</label>
			<textarea type="text" name="description" class="form-control" id="formGroupExampleInput" rows="4" required></textarea>
		</div>
		<div class="form-check form-switch m-3">
			<input class="form-check-input" name="isRemote" value="true" type="checkbox" id="flexSwitchCheckChecked" checked>
			<label class="form-check-label" for="flexSwitchCheckChecked">Remoto?</label>
		</div>
		<div class="form-check form-switch m-3">
			<input class="form-check-input" name="active" value="true" type="checkbox" id="flexSwitchCheckChecked" checked>
			<label class="form-check-label" for="flexSwitchCheckChecked">Activa</label>
		</div>
		<div class="form-group d-flex justify-content-end">
			<div>
				<a type="submit" href="<?php echo FRONT_ROOT ?>JobOffer/renderJobOfferList" class="btn btn-secondary m-2 p-auto">Cancelar</a>
			</div>
			<div>
				<a type="submit" href="<?php echo FRONT_ROOT ?>JobOffer/renderView_Create_FirstStep" class="btn btn-primary m-2 p-auto">Volver</a>
			</div>
			<div>
				<button type="submit" class="btn btn-success m-2 p-auto">Agregar</button>
			</div>
		</div>
	</form>
</div>