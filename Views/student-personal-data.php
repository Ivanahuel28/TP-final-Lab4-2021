<?php
require_once('student-nav.php');
?>

<?php if ($student) { ?>
	<div class="container">
		<h2 class="my-4 text-center">Informacion Personal</h2>
	</div>
	<div class="container w-50 p-4 m-auto border border-2 rounded-3">
		<form action="<?php echo FRONT_ROOT ?>Company/executeEditCompany" method="post" class="justify-content-center">
			<div class="mb-3">
				<label for="formGroupExampleInput" class="form-label">Nombre</label>
				<input type="text" name="name" value="<?php echo $student->getFirstName() ?>" class="form-control" id="formGroupExampleInput" readonly>
			</div>
			<div class="mb-3">
				<label for="formGroupExampleInput2" class="form-label">Apellido</label>
				<input type="text" name="role" value="<?php echo $student->getLastname() ?>" class="form-control" id="formGroupExampleInput2" readonly>
			</div>
			<div class="mb-3">
				<label for="formGroupExampleInput2" class="form-label">Dni</label>
				<input type="text" name="role" value="<?php echo $student->getDni() ?>" class="form-control" id="formGroupExampleInput2" readonly>
			</div>
			<div class="mb-3">
				<label for="formGroupExampleInput2" class="form-label">Correo</label>
				<input type="text" name="role" value="<?php echo $student->getEmail() ?>" class="form-control" id="formGroupExampleInput2" readonly>
			</div>
			<div class="form-group d-flex justify-content-end">
				<div>
					<a type="submit" href="<?php echo FRONT_ROOT ?>Home/GoToStudentHome" class="btn btn-secondary m-2 p-auto">Volver</a>
				</div>
			</div>
		</form>
	</div>
<?php
} else {
?>
	<div class="container">
		<h2 class="my-4 text-center">Error al obtener los datos</h2>
	</div>
<?php
} ?>