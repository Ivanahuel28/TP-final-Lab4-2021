<body class="text-center w-25 mx-auto mt-5">

	<main class="form-signin">
		<form action="<?php echo FRONT_ROOT ?>Session/loginRequest" method="POST">
			
			<h1 class="h3 my-5 fw-normal">UTN Jobs</h1>

			<div class="m-1 mt-5">
				<label for="floatingInput"><strong>Usuario</strong></label>
				<input type="text" name="username" class="form-control" id="floatingInput" required>
			</div>
			<div class="m-1 mt-1">
				<label for="floatingInput"><strong>Contraseña</strong></label>
				<input type="text" name="password" class="form-control" id="floatingInput" required>
			</div>

			<button class="m-5 btn btn-lg btn-primary" type="submit">Ingresar</button>
		</form>
	</main>
</body>