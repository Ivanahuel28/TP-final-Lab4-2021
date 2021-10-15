<?php
require_once('nav.php');
?>
<div class="container p-3">
	<div class="container m-3">
		<?php
		if (count($companiesList) != 0) {
			foreach ($companiesList as $company) { ?>

				<a href="">
					<div class="card m-3">
						<div class="card-body d-flex justify-content-start">
							<img src="<?php echo IMG_PATH ?>icon-company-50.png" width="30" alt="">
							<a class="mx-5"><?php echo $company->getName() ?></a>
							<a class="mx-5"><?php echo $company->getRole() ?></a>
						</div>
					</div>
				</a>

			<?php }
		} else { ?>
			<div class="card m-3">
				<div class="card-body d-flex justify-content-start">
					<a class="mx-5">No se encontraron Empresas</a>
				</div>
			</div>
		<?php } ?>

	</div>
	<div class="d-flex justify-content-center">
		<a href="<?php echo FRONT_ROOT ?>Company/showAddView">
			<button type="submit" class="btn btn-primary">
				Agregar Empresa
			</button>
		</a>

	</div>
</div>