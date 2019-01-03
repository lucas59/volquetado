<link type="text/css" href="../bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
<script type="text/javascript" src="../js/jquery-3.31.min.js"></script>
<script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
<style type="text/css">
#container {
    width:100%;
    text-align:center;
}

#left {
    float:left;
    width:100px;
}

#center {
    display: inline-block;
    margin:0 auto;
    width:100px;
}

#right {
    float:right;
    width:100px;
}
</style>
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
        <div><a href="../index.php"><img  style="width: 20%;height: 25%"  src="../Imagenes/camion.png"></a><a href="../index.php"><img style="height: 30px;height: 30px" src="../Imagenes/inicio.png"></a></div>
        <?php if ($user != null) { ?>
            <ul  style="width: auto;" class="nav navbar-nav navbar-right" id="navbarSupportedContent">
                <li style="right: 50px;"  class="nav-item dropdown">
                    <a style="color: #ffffff" class="dropdown-toggle" data-toggle="dropdown"><?php echo $user ?></a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="../logica/cerrarSesion.php?cerrar=cerrar">Cerrar sesión</a>
                    </div>
                </li>
            </ul>
        <?php } ?>
    </div>
</nav>