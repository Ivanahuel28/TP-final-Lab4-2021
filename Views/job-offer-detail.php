<?php
require_once('nav.php');
?>
<div class="col-lg-8 mx-auto py-md-5">


    <form action="<?php echo FRONT_ROOT ?>JobOffer/studentRequestApply" method="POST" enctype="multipart/form-data">
        <?php

        $imgSrc = IMG_PATH . 'no-company-image.png';

        if ($company->getImg_path())
            $imgSrc = FRONT_ROOT . $company->getImg_path();
        ?>

        <div class="px-5 my-3">
            <img width="200" id="blah" src="<?php echo $imgSrc ?>" alt="your image" />
            <h3><?php echo $jobOffer->getTitle() ?></h3>
        </div>
        <hr class="">
        <p class="fs-5 col-md-8">Empresa: <?php echo $company->getName() ?></p>
        <p class="fs-5 col-md-8">Posicion: <?php echo $jobPositionTitle ?></p>
        <p class="fs-5 col-md-8">Remoto: <?php echo ($jobOffer->getRemote()) ? "Sí" : "No" ?></p>
        <strong class="fs-5 col-md-8">Acerca del Puesto</strong>
        <p><?php echo $jobOffer->getDescription() ?></p>
        <input type="hidden" name="id_jobOffer" value="<?php echo $jobOffer->getId_jobOffer() ?>">

        <hr class="col-3 col-md-2 mb-5">
        <?php if ($_SESSION['user']->getUserType() === "student")
        { ?>
            <div class="mb-3">
                <label for="formFile" class="form-label">Es necesario subir un archivo para su postulacion</label>
                <input type="file" name="file" class="form-control required" id="formFile" required>
            </div>

            <div class="form-group d-flex justify-content-start">
                <div class="mb-5">
                    <a name="action" onclick="history.back()" type="submit" class="btn btn-secondary btn-lg mx-3 px-4">Volver</a>
                </div>
                <div class="mb-5">
                    <button type="submit" class="btn btn-success btn-lg px-4">Aplicar</button>
                </div>
            </div>
        <?php } ?>
    </form>

</div>


<!--  4 -->