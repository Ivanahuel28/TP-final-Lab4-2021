<?php
require_once('nav.php');
if ($_SESSION['user']->getUserType() === "admin")
{

}
else
{
?>
    <div class="col-lg-8 mx-auto p-3 py-md-5">


        <form action="<?php echo FRONT_ROOT ?>JobOffer/studentRequestApply" method="POST" enctype="multipart/form-data">
            <h1><?php echo $jobOffer->getTitle() ?></h1>
            <hr class="col-3 col-md-2 mb-5">
            <p class="fs-5 col-md-8">Empresa: <?php echo $companyName ?></p>
            <p class="fs-5 col-md-8">Posicion: <?php echo $jobPositionTitle ?></p>
            <p class="fs-5 col-md-8">Remoto: <?php echo ($jobOffer->getRemote()) ? "Sí" : "No" ?></p>
            <strong class="fs-5 col-md-8">Acerca del Puesto</strong>
            <p><?php echo $jobOffer->getDescription() ?></p>
            <input type="hidden" name="id_jobOffer" value="<?php echo $jobOffer->getId_jobOffer() ?>">

            <hr class="col-3 col-md-2 mb-5">

            <div class="mb-3">
                <label for="formFile" class="form-label">Es necesario subir un archivo para su postulacion</label>
                <input type="file" name="file"  class="form-control required"  id="formFile" required>
            </div>

            <div class="form-group d-flex justify-content-start">
                <div class="mb-5">
                    <a name="action" onclick="history.back()" type="submit" class="btn btn-secondary btn-lg mx-3 px-4">Volver</a>
                </div>
                <div class="mb-5">
                    <button type="submit" class="btn btn-success btn-lg px-4">Aplicar</button>
                </div>
            </div>
        </form>

    </div>

<?php
}
?>