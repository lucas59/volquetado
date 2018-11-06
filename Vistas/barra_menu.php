<link type="text/css" href="../bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
<script type="text/javascript" src="../js/jquery-3.31.min.js"></script>
<script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>

<?php
session_start();

if (isset($_SESSION['user'])) {
    $usuario=$_SESSION['user'];
}
?>
<nav class="navbar navbar-expand navbar-dark bg-dark">
    <a href="../index.php" class="navbar-brand">Volquetado</a>
    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <?php if ($usuario=!null) {?>
            <li style="float: left;" class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#"><?php $usuario['nombre'] ?></a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Link 1</a>
                    <a class="dropdown-item" href="#">Link 2</a>
                    <a class="dropdown-item" href="#">Link 3</a>
                </div>
            </li>
        <?php  } ?>
    </div>
</nav>