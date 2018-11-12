<link type="text/css" href="../bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
<script type="text/javascript" src="../js/jquery-3.31.min.js"></script>
<script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>

<?php
session_start();
require '../logica/usuario.php';
$nombreUser;
if (isset($_SESSION['user'])) {
    $user= $_SESSION['nombreUser'];    
}
?>
<nav class="navbar navbar-expand navbar-dark bg-dark">
    <div class="container-fluid">
        <a href="../index.php" class="navbar-brand">Volquetado</a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false">
            <span class="navbar-toggler-icon"></span>
        </button>
        <?php if ($user != null) { ?>
            <ul class=" nav navbar-nav collapse navbar-right navbar-collapse" id="navbarSupportedContent">
                <li  class="nav-item dropdown">
                    <a style="color: #ffffff" class="nav-link dropdown-toggle" data-toggle="dropdown"><?php echo $user ?></a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="../logica/cerrarSesion.php?cerrar=cerrar">Cerrar sesión</a>
                    </div>
                </li>
            </ul>
        <?php } ?>
    </div>
</nav>