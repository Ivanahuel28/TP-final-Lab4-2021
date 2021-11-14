<?php
require_once('nav.php');
?>
<div class="container">
	<h2 class="my-4 text-center">Modificar oferta laboral</h2>
</div>

<div class="container w-50 p-4 m-auto border border-2 rounded-3">
	<form action="<?php echo FRONT_ROOT ?>JobOffer/adminRequestJobOfferEdit" method="POST" class="justify-content-center">
		<div class="mb-3">
			<label for="formGroupExampleInput" class="form-label">Empresa</label>
			<input type="text" value="<?php echo $companyName ?>" class="form-control w-10" id="formGroupExampleInput" readonly>
		</div>
		<div class="mb-3">
			<label for="formGroupExampleInput" class="form-label">Carrera</label>
			<input type="text" value="<?php echo $careerTitle ?>" class="form-control w-10" id="formGroupExampleInput" readonly>
		</div>
		<div class="mb-3">
			<label for="formGroupExampleInput" class="form-label">Posicion</label>
            <input type="text" value="<?php echo $jobPositionTitle ?>" class="form-control w-10" id="formGroupExampleInput" readonly>
		</div>
		<div class="mb-3">
			<label for="formGroupExampleInput" class="form-label">Titulo</label>
			<input type="text" name="title" value="<?php echo $jobOffer->getTitle() ?>" class="form-control" id="formGroupExampleInput" required>
		</div>
		<div class="mb-3">
			<label for="formGroupExampleInput" class="form-label">Descripcion</label>
			<textarea type="text" name="description" class="form-control" id="formGroupExampleInput" rows="4" required><?php echo $jobOffer->getDescription() ?></textarea>
		</div>
		<div class="form-check form-switch m-3">
			<input class="form-check-input" name="isRemote" value="true" type="checkbox" id="flexSwitchCheckChecked" <?php echo ($jobOffer->getRemote())?"checked":"" ?>>
			<label class="form-check-label" for="flexSwitchCheckChecked">Remoto?</label>
		</div>
		<div class="form-check form-switch m-3">
			<input class="form-check-input" name="active" value="true" type="checkbox" id="flexSwitchCheckChecked" <?php echo ($jobOffer->getActive())?"checked":"" ?>>
			<label class="form-check-label" for="flexSwitchCheckChecked">Activa</label>
		</div>
		<div class="form-group d-flex justify-content-end">
			<div>
                <a type="submit" href="<?php echo FRONT_ROOT ?>JobOffer/renderJobOfferList" class="btn btn-secondary m-2 p-auto">Cancelar</a>
			</div>
			<div>
                <input type="hidden" name="id_jobOffer" value="<?php echo $jobOffer->getId_jobOffer() ?>">
				<button type="submit" class="btn btn-success m-2 p-auto">Aplicar Cambios</button>
			</div>
		</div>
	</form>
</div>