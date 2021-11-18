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
        <?php }
        else
        {
        ?>

            <div class="form-group d-flex justify-content-start">
                <div class="mb-5">
                    <a name="action" onclick="history.back()" type="submit" class="btn btn-secondary btn-lg mx-3 px-4">Volver</a>
                </div>
                <!-- <div class="mb-5">
                    <a href="<?php echo FRONT_ROOT ?>Application/executeDownloadApplicants" class="btn btn-success btn-lg px-4">Descargar Postulantes</a>
                </div> -->
            </div>

            <div class="container">
                <h3 class="">Listado de postulantes: </h3>
            </div>

            <div class="container-fluid mt-3 w-75 ">
                <?php
                if (!empty($applicationList))
                {
                    foreach ($applicationList as $application)
                    { ?>
                        <div class="border border-2 rounded m-2 d-flex">
                            <div class="m-1 p-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-check-fill" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M15.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L12.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                                    <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                                </svg>
                            </div>
                            <div class="my-auto p-2 mx-3">
                                <a class="link-dark text-decoration-none fw-bold " href=""><?php echo $company->getName() ?></a>
                            </div>
                            <div class="my-auto  mx-3">
                                <p class="fw-lighter m-0"><?php echo $company->getRole() ?></p>
                            </div>
                            <div class="my-auto ms-auto mx-3">

                                <!-- <a type="button" href="<?php echo FRONT_ROOT ?>JobOffer/executeDeleteApplication/<?php echo $company->getCuit() ?>" class="btn btn-outline-danger">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square-fill" viewBox="0 0 16 16">
                                        <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.354 4.646L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z"></path>
                                    </svg>
                                    Eliminar
                                </a> -->
                            </div>
                        </div>
                    <?php }
                }
                else
                { ?>
                    <div class="card m-3">
                        <div class="card-body d-flex justify-content-start">
                            <a href="" class="mx-5">Esta oferta no tiene postulantes</a>
                        </div>
                    </div>
                <?php
                } ?>
            </div>

        <?php
        } ?>
    </form>

</div>


<!--  4 -->