<?php require_once ('validate-session.php')?>

<header class="p-2 bg-dark text-white">
	<div class="container">
		<div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
			<ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
				<li><a href="<?php echo FRONT_ROOT ?>Home/Index" class="nav-link px-2 fw-bold text-reset">UTN-Jobs</a></li>
			</ul>
			<?php if ($_SESSION['user']->getUserType() === "admin") { ?>
				<div class="text-end">
					<ul class="nav nav-pills nav-fill">
						<li class="nav-item">
							<a class="nav-link" aria-current="page" href="<?php echo FRONT_ROOT ?>"><strong>Alumnos</strong></a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="<?php echo FRONT_ROOT ?>Company/showCompaniesView"><strong>Empresas</strong> </a>
						</li>
                        <li class="nav-item">
							<a class="nav-link" href="<?php echo FRONT_ROOT ?>JobOffer/createJobOffer"><strong>Crear Oferta</strong> </a>
						</li>

					<?php
				} else { ?>
						<div class="text-end">
							<ul class="nav nav-pills nav-fill">
								<li class="nav-item">
									<a class="nav-link" aria-current="page" href="<?php echo FRONT_ROOT ?>Student/renderPersonalData"><strong>Info personal</strong></a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="<?php echo FRONT_ROOT ?>Company/showCompaniesViewForStudent"><strong>Empresas</strong> </a>
								</li>
								
					<?php
				} ?>
					<li class="nav-item">
						<a class="nav-link alert-danger" href="<?php echo FRONT_ROOT ?>Session/logout"><strong>Cerrar Sesión</strong></a>
					</li>
					</ul>
				</div>
		</div>
	</div>
</header>