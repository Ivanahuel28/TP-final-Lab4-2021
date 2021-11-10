<?php
require_once('nav.php');
?>
<div class="container">
	<h2 class="my-4 text-center">Informacion de la Empresa:  <strong><?php echo $company->getName() ?></strong> </h2>
</div>
<div class="container w-50 p-4 m-auto border border-2 rounded-3">
	<form action="<?php echo FRONT_ROOT ?>Company/executeEditCompany" method="post" class="justify-content-center">
		<div class="mb-3">
			<label for="formGroupExampleInput" class="form-label">Cuit</label>
			<input type="number" name="cuit" value="<?php echo $company->getCuit() ?>" class="form-control w-10" id="formGroupExampleInput" readonly>
		</div>
		<div class="mb-3">
			<label for="formGroupExampleInput" class="form-label">Nombre</label>
			<input type="text" name="name" value="<?php echo $company->getName() ?>" class="form-control" id="formGroupExampleInput" readonly>
		</div>
		<div class="mb-3">
			<label for="formGroupExampleInput2" class="form-label">Rol</label>
			<input type="text" name="role" value="<?php echo $company->getRole() ?>" class="form-control" id="formGroupExampleInput2" readonly>
		</div>
		<div class="mb-3">
			<label for="formGroupExampleInput2" class="form-label">Acerca de la empresa</label>
			<input type="hidden" name="role" value="<?php echo $company->getDescription() ?>" class="form-control" id="formGroupExampleInput2" readonly>
			<p><?php echo $company->getDescription() ?></p>
		</div>
		<div class="mb-3">
			<label for="formGroupExampleInput2" class="form-label">Web</label>
			<input type="text" name="role" value="<?php echo $company->getLink() ?>" class="form-control" id="formGroupExampleInput2" readonly>
		</div>
		<div class="form-group d-flex justify-content-end">
			<div >
				<a type="submit" href="<?php echo FRONT_ROOT ?>Company/showCompaniesViewForStudent" class="btn btn-secondary m-2 p-auto">Volver</a>
			</div>
		</div>
	</form>
</div>