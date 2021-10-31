<?php
require_once('nav.php');
?>
<div class="container p-3">
	<div class="container">
		<h2 class="my-4 text-center">Listado de Empresas</h2>
	</div>
	<div class="container-fluid mt-3 w-75 ">
		<?php
		if (count($companiesList) != 0) {
			foreach ($companiesList as $company) { ?>


				<div class="border border-2 rounded m-2 d-flex">
					<div class=" p-2">
						<img src="<?php echo IMG_PATH ?>icon-company-50.png" height="40" width="40" alt="">
					</div>
					<div class="my-auto p-2 mx-3">
						<a class="link-dark text-decoration-none fw-bold " href=""><?php echo $company->getName() ?></a>
					</div>
					<div class="my-auto  mx-3">
						<p class="fw-lighter m-0"><?php echo $company->getRole() ?></p>
					</div>
					<div class="my-auto ms-auto mx-3">
						<a type="button" href="<?php echo FRONT_ROOT ?>Company/showViewCompanyInfo/<?php echo $company->getCuit() ?>" title="Info" class="btn btn-secondary">
							<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle mb-1" viewBox="0 0 16 16">
								<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
								<path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
							</svg>
						</a>
					</div>

				</div>



			<?php }
		} else { ?>
			<div class="card m-3">
				<div class="card-body d-flex justify-content-start">
					<a href="" class="mx-5">No se encontraron Empresas</a>
				</div>
			</div>
		<?php } ?>
	</div>
</div>