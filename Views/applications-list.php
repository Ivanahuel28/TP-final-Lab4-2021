<link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH ?>students-search.css">

<div class="container">
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
                                            foreach ($applications as $application) { ?>
                                                <tr id="result">
                                                    <td>
                                                        <?php  if($application->getActive()) {?>
                                                            <a href="<?php echo FRONT_ROOT ?>Student/showStudentPostulations">
                                                                <button type="button" class="btn btn-primary" disabled>Postulaciones</button>
                                                            </>
                                                        <?php } else { ?>
                                                            <button type="button" class="btn btn-primary">Postulaciones</button>
                                                        <?php } ?>
                                                    </td>
                                                    <td>
                                                        <div class="widget-26-job-title">
                                                            <p><?php echo  $student->getFirstname() . $student->getLastname()?></p>
                                                            <p class="m-0"><a href="https://mail.google.com/mail/?view=cm&fs=1&to=<?php echo  $student->getEmail()?>" class="employer-name"><?php echo  $student->getEmail()?></a> <span class="text-muted time"><?php echo  $student->getGender()?></span></p>
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
            </div>
        </div>
    </div>
</div>
