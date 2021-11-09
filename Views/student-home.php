<?php
require_once('nav.php');
?>

<?php
if (!empty($jobsList)) { ?>
<div class="container px-4 py-5" id="hanging-icons">
    <h2 class="pb-2 border-bottom">Bienvenido! Mira las nuevas ofertas</h2>
    <?php foreach ($jobsList as $id_jobOffer => $jobOffer) { ?>
        <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
            <div class="col d-flex align-items-start">
                <div class="icon-square bg-light text-dark flex-shrink-0 me-3">
                    <svg class="bi" width="1em" height="1em">
                        <use xlink:href="#toggles2"/>
                    </svg>
                </div>
                <div>
                    <h2>Featured title</h2>
                    <p>Paragraph of text beneath the heading to explain the heading. We'll add onto it with another
                        sentence
                        and probably just keep going until we run out of words.</p>
                    <a href="#" class="btn btn-primary">
                        Primary button
                    </a>
                </div>
            </div>
        </div>
    <?php }
        } else { ?>
        <div class="container px-4 py-5" id="hanging-icons">
            <h2 class="pb-2 border-bottom">No encontramos ofertas, vuelve mas tarde! </h2>
        </div>
        <?php
    }
?>
