<?php
if (!isset($_SESSION["user"])) {
    echo '<script> if(confirm("Esa boleta no este paga, no se puede borrar"))';
    echo "window.location = 'invoice-list.php'; </script>";
    header("location:../index.php");
}
?>