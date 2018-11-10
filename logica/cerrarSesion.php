<?php
session_start();
if (isset($_GET['cerrar'])) {
    if (isset($_SESSION['user']) == null) {
        echo "No hay ninguna sesion iniciada";
    } else {
        session_destroy();
        header('location: ../index.php');
    }
}
?>