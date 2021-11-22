<link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH ?>students-search.css">

<div class="container">
    <div class="row">
        <div class="col-lg-12 card-margin">
            <div class="card search-form">
                <div class="card-body p-0">
                    <form id="search-form">
                        <div class="row">
                            <div class="col-12">
                                <div class="row no-gutters">
                                    <div class="col-lg-8 col-md-6 col-sm-12 p-0">
                                        <input type="text" placeholder="Search..." class="form-control" id="search" name="search">
                                    </div>
                                    <div class="col-lg-1 col-md-3 col-sm-12 p-0">
                                        <button type="submit" class="btn btn-base">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card card-margin">
                <div class="card-body">
                    <div class="row search-body">
                        <div class="col-lg-12">
                            <div class="search-result">
                                <div class="result-body">
                                    <div class="table-responsive">
                                        <table class="table widget-26">
                                            <tbody>
                                            <?php
                                            foreach ($studentList as $student) { ?>
                                            <tr>
                                                <td>
                                                    <div class="widget-26-job-emp-img">
                                                        <img src="https://bootdey.com/img/Content/avatar/avatar5.png" alt="Company" />
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="widget-26-job-title">
                                                        <p><?php echo  $student->getFirstname() . $student->getLastname()?></p>
                                                        <p class="m-0"><a href="#" class="employer-name"><?php echo  $student->getEmail()?></a> <span class="text-muted time"><?php echo  $student->getGender()?></span></p>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="widget-26-job-info">
                                                        <a class="type m-0"><?php echo  $student->getPhoneNumber()?></a>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="widget-26-job-salary"><?php echo  $student->getDni()?></div>
                                                </td>
                                                <td>
                                                    <div >
                                                        <?php  if($student->getActive()) {?>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" color="red" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                                                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                                                        </svg>
                                                            <?php } else { ?>
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" color="green" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                                            </svg>
                                                        <?php } ?>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php }?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <nav class="d-flex justify-content-center">
                        <ul class="pagination pagination-base pagination-boxed pagination-square mb-0">
                            <li class="page-item">
                                <a class="page-link no-border" href="#">
                                    <span aria-hidden="true">«</span>
                                    <span class="sr-only">Previous</span>
                                </a>
                            </li>
                            <li class="page-item active"><a class="page-link no-border" href="#">1</a></li>
                            <li class="page-item"><a class="page-link no-border" href="#">2</a></li>
                            <li class="page-item"><a class="page-link no-border" href="#">3</a></li>
                            <li class="page-item"><a class="page-link no-border" href="#">4</a></li>
                            <li class="page-item">
                                <a class="page-link no-border" href="#">
                                    <span aria-hidden="true">»</span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="form-group d-flex justify-content-end">
                    <div >
                        <a type="submit" href="<?php echo FRONT_ROOT ?>Company/showCompaniesViewForStudent" class="btn btn-secondary m-2 p-auto">Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>