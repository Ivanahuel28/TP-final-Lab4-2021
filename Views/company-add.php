<?php
require_once('nav.php');
?>
<div class="container">
    <h2 class="my-4 text-center">Agregar Empresa</h2>
</div>

<div class="container w-50 p-4 m-auto border border-2 rounded-3">
    <form action="<?php echo FRONT_ROOT ?>Company/add" method="POST" class="justify-content-center">
        <div class="mb-3">
            <label for="formGroupExampleInput" class="form-label">Cuit *</label>
            <input type="text" name="cuit" class="form-control w-10" minlength="11" maxlength="11" id="formGroupExampleInput" required>
        </div>
        <div class="mb-3">
            <label for="formGroupExampleInput" class="form-label">Nombre</label>
            <input type="text" name="name" class="form-control" id="formGroupExampleInput" required>
        </div>
        <div class="mb-3">
            <label for="formGroupExampleInput2" class="form-label">Rol</label>
            <input type="text" name="role" class="form-control" id="formGroupExampleInput2">
        </div>
        <div class="form-check form-switch m-3">
            <input class="form-check-input" name="active" value="true" type="checkbox" id="flexSwitchCheckChecked"
                   checked>
            <label class="form-check-label" for="flexSwitchCheckChecked">Agregar como activa</label>
        </div>
        <div class="form-group d-flex justify-content-end">
            <div>
                <button type="submit" class="btn btn-primary m-2 p-auto">Agregar</button>
            </div>
            <div>
                <a type="submit" href="<?php echo FRONT_ROOT ?>Company/showCompaniesView"
                   class="btn btn-secondary m-2 p-auto">Cancelar</a>
            </div>
        </div>
    </form>
</div>