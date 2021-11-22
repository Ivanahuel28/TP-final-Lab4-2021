<?php
require_once('nav.php');
?>
<div class="container p-3">
	<div class="d-flex mt-2 justify-content-center">
		<a href="<?php echo FRONT_ROOT ?>JobOffer/renderView_Create_FirstStep">
			<button type="submit" class="btn btn-primary">
				Crear Oferta Laboral
			</button>
		</a>
	</div>
	<div class="container-fluid mt-5 w-75 ">
		<?php
		if (!empty($list))
		{
			foreach ($list as $id_jobOffer => $element)
			{ ?>
				<div class="border border-2 rounded m-2 d-flex">
					<div class="m-2 mt-4 mx-4 p-2">
						<svg xmlns="http://www.w3.org/2000/svg" height="40" width="40" fill="currentColor" class="bi bi-briefcase" viewBox="0 0 16 16">
							<path d="M6.5 1A1.5 1.5 0 0 0 5 2.5V3H1.5A1.5 1.5 0 0 0 0 4.5v8A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-8A1.5 1.5 0 0 0 14.5 3H11v-.5A1.5 1.5 0 0 0 9.5 1h-3zm0 1h3a.5.5 0 0 1 .5.5V3H6v-.5a.5.5 0 0 1 .5-.5zm1.886 6.914L15 7.151V12.5a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5V7.15l6.614 1.764a1.5 1.5 0 0 0 .772 0zM1.5 4h13a.5.5 0 0 1 .5.5v1.616L8.129 7.948a.5.5 0 0 1-.258 0L1 6.116V4.5a.5.5 0 0 1 .5-.5z"></path>
						</svg>
					</div>
					<div class="p-2 mx-3">
						<p class="link-dark text-decoration-none fw-bold m-1"><?php echo $element['title'] ?></p>
						<p class="fw-lighter m-1"><?php echo $element['companyName'] ?></p>
						<p class="fw-lighter m-1"><?php echo $element['jobPositionTitle'] ?></p>
						<!-- <div class=" d-flex justify-content-evenly">
						</div> -->
					</div>
					<div class="my-auto ms-auto m-5">
						<div class="btn-group">
							<a href="<?php echo FRONT_ROOT ?>JobOffer/adminRequestJobOfferDetails/<?php echo $id_jobOffer ?>" class="btn btn-outline-secondary" title="Ver en detalle">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
									<path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"></path>
									<path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"></path>
								</svg>
								<span class="visually-hidden">Button</span>
							</a>
							<a href="<?php echo FRONT_ROOT ?>JobOffer/renderModifyJobOffer/<?php echo $id_jobOffer ?>" class="btn btn-outline-secondary" title="Editar">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
									<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"></path>
									<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"></path>
								</svg>
								<span class="visually-hidden">Button</span>
							</a>
						</div>
					</div>
				</div>

			<?php
			} ?>
	</div> <?php
		}
		else
		{ ?>
	<div class="container align-content-center w-75">
		<div class="flex-column py-2">
			<div class="alert alert-secondary" role="alert">
				No se encontraron ofertas
			</div>
		</div>
	</div>
<?php
		} ?>
</div>
</div>