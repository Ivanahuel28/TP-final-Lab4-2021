<?php
require_once('nav.php');
if ($_SESSION['user']->getUserType() === "admin")
{
?>



<?php
}
else
{
?>
    <div class="col-lg-8 mx-auto p-3 py-md-5">


        <main>
            <h1>Titulo de la oferta</h1>
            <hr class="col-3 col-md-2 mb-5">
            <p class="fs-5 col-md-8">Empresa: Avalith</p>
            <p class="fs-5 col-md-8">Posicion: PHP Jr</p>
            <strong class="fs-5 col-md-8">Acerca del Puesto</strong>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit, fuga ab! Sapiente possimus eos, iste necessitatibus similique sint quisquam temporibus reprehenderit suscipit amet itaque non magni, tenetur dignissimos cum doloremque?</p>

            <hr class="col-3 col-md-2 mb-5">

            <div class="form-group d-flex justify-content-start">
                <div class="mb-5">
                    <a name="action" onclick="history.back()" type="submit" class="btn btn-secondary btn-lg mx-3 px-4">Volver</a>
                </div>
                <div class="mb-5">
                    <a href="" class="btn btn-success btn-lg px-4">Aplicar</a>
                </div>
            </div>

    </div>

<?php
} ?>