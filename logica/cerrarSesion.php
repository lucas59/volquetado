<?php
session_start();
if (isset($_GET['cerrar'])) {
    if (isset($_SESSION['user']) == null) {
        echo "No hay ninguna sesion iniciada";
    } else {
        session_destroy();
       // window.location.href="../index.php";
        //header('location: ../index.php');
         echo '<script type="text/javascript">javascript:window.location="../index.php"</script>';
  
    }
}
?>