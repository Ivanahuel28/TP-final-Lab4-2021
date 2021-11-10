<link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH ?>signin.css">

<body class="text-center w-25 mx-auto mt-5">
<main class="form-signin">
    <form action="<?php echo FRONT_ROOT ?>Session/loginRequest" method="POST">
        <img class="mb-4" src="<?php echo IMG_PATH ?>signin.svg" alt="compnay icon" width="72" height="57">
        <h1 class="h3 mb-3 fw-normal">UTN Jobs</h1>

        <div class="form-floating">
            <input type="text" class="form-control" id="floatingInput" placeholder="nombre@ejemplo.com" name="username">
            <label for="floatingInput">Email</label>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
            <label for="floatingPassword">Contraseña</label>
        </div>

        <div class="checkbox mb-3">
            <p>Nuevo Usuario? <a href="<?php echo FRONT_ROOT ?>Home/renderRegisterUser">Registrate!</a> </p>
        </div>
        <div class="checkbox mb-3">
            <p>Has olvidado tu contraseña? <a href="<?php echo FRONT_ROOT ?>Home/renderRecoverPassword">Recuperala!</a> </p>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Ingresar</button>
    </form>
</main>
</body>