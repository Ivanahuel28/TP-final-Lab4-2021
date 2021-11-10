<?php
require_once('nav.php');
?>

<?php
if (!empty($list))
{
?>
    <div class="container px-4 py-2" id="hanging-icons">
        <h2 class="pb-2 pt-5 border-bottom">Bienvenido! Mira las nuevas ofertas</h2>

        <?php foreach ($list as $id_jobOffer => $element)
        {
        ?>
            <div class="row g-4 py-4 row-cols-1 row-cols-lg-3">
                <div class="col d-flex align-items-start">
                    <div class="icon-square bg-light text-dark flex-shrink-0 me-3">
                        <svg class="bi" width="1em" height="1em">
                            <use xlink:href="#toggles2" />
                        </svg>
                    </div>
                    <div>
                        <h4><?php echo $element['title'] ?></h4>
                        <p><?php echo $element['companyName'] ?></p>
                        <a href="#" class="btn btn-primary">
                            Ver en detalle
                        </a>
                    </div>
                </div>
            </div>
        <?php
        }
    }
    else
    {
        ?>
        <div class="container px-4 py-5" id="hanging-icons">
            <h2 class="pb-2 border-bottom">No encontramos ofertas, vuelve mas tarde! </h2>
        </div>
    <?php
    }
    ?>