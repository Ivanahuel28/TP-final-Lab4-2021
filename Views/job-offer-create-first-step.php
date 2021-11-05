<?php
require_once('nav.php');
?>
<div class="container">
	<h2 class="my-4 text-center">Crear Oferta de Empleo 1/2</h2>
</div>

<div class="container w-50 p-4 m-auto border border-2 rounded-3">
	<form action="<?php echo FRONT_ROOT ?>JobOffer/renderView_Create_FinalStep" method="POST" class="justify-content-center">
		<div class="mb-3">
			<label for="formGroupExampleInput" class="form-label">Empresa</label>
			<select name="id_company" class="form-select" aria-label="Default select example">
				<?php foreach ($companiesList as $company) {
					echo '<option name="id_company" value="' . $company->getId() . '">' . $company->getName() . '</option>';
				}
				?>
			</select>
		</div>
		<div class="mb-3">
			<label for="formGroupExampleInput" class="form-label">Carrera</label>
			<select name="id_company" class="form-select" aria-label="Default select example">
				<?php foreach ($careersList as $career) {
					echo '<option name="id_career" value="' . $career->getId_Career(). '">' . $career->getDescription() . '</option>';
				}
				?>
			</select>
		</div>
		<div class="form-group d-flex justify-content-end">
			<div>
				<a type="submit" href="<?php echo FRONT_ROOT ?>JobOffer/requestJobOfferList" class="btn btn-secondary m-2 p-auto">Cancelar</a>
			</div>
			<div>
				<button type="submit" class="btn btn-success m-2 p-auto">Continuar</button>
			</div>
		</div>
	</form>
</div>