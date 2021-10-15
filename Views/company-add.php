<?php
require_once('nav.php');
?>

<div class="container w-50 p-5 mt-5 ">
	<form action="<?php echo FRONT_ROOT ?>Company/add" method="POST" class="justify-content-center">
		<div class="mb-3">
			<label for="formGroupExampleInput" class="form-label">Nombre</label>
			<input type="text" name="name" class="form-control" id="formGroupExampleInput" required>
		</div>
		<div class="mb-3">
			<label for="formGroupExampleInput2" class="form-label">Rol</label>
			<input type="text" name="role" class="form-control" id="formGroupExampleInput2" >
		</div>
		<div class="form-group">
			<div class="col-sm-10">
				<button type="submit" class="btn btn-primary">Agregar</button>
			</div>
		</div>
	</form>
</div>