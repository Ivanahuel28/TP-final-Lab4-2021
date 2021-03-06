<?php
require_once('nav.php');
?>
<div class="container p-3">
    <div class="d-flex mt-2 justify-content-center">
        <a href="<?php echo FRONT_ROOT ?>Company/showAddView">
            <button type="submit" class="btn btn-primary">
                Agregar Empresa
            </button>
        </a>
    </div>
    <div class="container-fluid mt-3 w-75 ">
        <?php
        if (!empty($companiesList)) {
            foreach ($companiesList as $company) { ?>
                <div class="border border-2 rounded m-2 d-flex">
                    <div class=" p-2">
                        <img src="<?php echo IMG_PATH ?>icon-company-50.png" height="40" width="40" alt="">
                    </div>
                    <div class="my-auto p-2 mx-3">
                        <a class="link-dark text-decoration-none fw-bold " href=""><?php echo $company->getName() ?></a>
                    </div>
                    <div class="my-auto  mx-3">
                        <p class="fw-lighter m-0"><?php echo $company->getRole() ?></p>
                    </div>
                    <div class="my-auto ms-auto mx-3">

                        <a type="button"
                           href="<?php echo FRONT_ROOT ?>Company/showViewEditCompany/<?php echo $company->getCuit() ?>"
                           value="0" title="Editar" class="btn btn-secondary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"></path>
                                <path fill-rule="evenodd"
                                      d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            <?php }
        } else { ?>
            <div class="card m-3">
                <div class="card-body d-flex justify-content-start">
                    <a href="" class="mx-5">No se encontraron Empresas</a>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Launch demo modal
</button> -->

<!-- Modal -->
<!-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div> -->