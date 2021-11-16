<?php
require_once('nav.php');
?>
<div class="container">
    <h2 class="my-4 text-center">Bienvenido</h2>
</div>

<div class="container w-50 p-4 m-auto border border-2 rounded-3">
    <form action="<?php echo FRONT_ROOT ?>Company/companyExecuteEditProfile" method="POST" enctype="multipart/form-data" class="justify-content-center">
        <div class="mb-3">
            <label for="formGroupExampleInput" class="form-label">Cuit: </label>
            <strong class="ps-5"><?php echo $company->getCuit() ?></strong>
            <input type="hidden" name="cuit" value="<?php echo $company->getCuit() ?>">
        </div>
        <div class="mb-3">
            <label for="formGroupExampleInput" class="form-label">Nombre</label>
            <input type="text" name="name" value="<?php echo $company->getName() ?>" class="form-control" id="formGroupExampleInput" required>
        </div>
        <div class="mb-3">
            <label for="formGroupExampleInput2" class="form-label">Rol</label>
            <input type="text" name="role" value="<?php echo $company->getRole() ?>" class="form-control" id="formGroupExampleInput2">
        </div>
        <div class="mb-3">
            <label for="formGroupExampleInput" class="form-label">Descripcion</label>
            <textarea type="text" name="description" class="form-control" id="formGroupExampleInput" rows="4" required><?php echo $company->getDescription() ?></textarea>
        </div>
        <div class="mb-3">
            <label for="formGroupExampleInput2" class="form-label">Link</label>
            <input type="text" name="link" value="<?php echo $company->getLink() ?>" class="form-control" id="formGroupExampleInput2">
        </div>
        <!-- <div class="mb-3">
            <label for="formGroupExampleInput" class="form-label">Imagen: </label>
            <br>
            <input type="file" name="file" accept="image/*" id="imgInp" required>
        </div> -->

        <input type="hidden" name="active" value="<?php echo $company->getActive() ?>">
        <div class="mb-3">
            <strong for="formFile" class="form-label">Seleccione una imagen : </strong>
        </div>

        <?php

        $imgSrc = IMG_PATH . 'no-company-image.png';

        if ($company->getImg_path())
            $imgSrc = FRONT_ROOT . $company->getImg_path();
        ?>

        <div class="px-5 my-5">
            <img width="200" id="blah" src="<?php echo $imgSrc ?>" alt="your image" />
        </div>
        <!--         <input type="hidden" name="id_company" value="<?php echo $company->getId() ?>"> -->
        <div class="mb-3">
            <input type="file" name="file" class="form-control required" accept="image/*" id="imgInp" required>
        </div>

        <div class="form-group d-flex justify-content-end">
            <div>
                <button type="submit" class="btn btn-primary m-2 p-auto">Agregar</button>
            </div>
            <div>
                <a type="submit" href="<?php echo FRONT_ROOT ?>Home/Index" class="btn btn-secondary m-2 p-auto">Cancelar</a>
            </div>
        </div>
    </form>
</div>
<form runat="server">
</form>
<script>
    imgInp.onchange = evt => {
        const [file] = imgInp.files
        if (file) {
            blah.src = URL.createObjectURL(file)
        }
    }
</script>