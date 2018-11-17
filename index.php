<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <script type="text/javascript" src = "js/jquery-3.31.min.js"> </script>
    <script type="text/javascript" src = "bootstrap/js/bootstrap.min.js" > </script> 
    <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"/>
    <link type="text/css" href="css/indexCSS.css" rel="stylesheet"/>

    <title>Iniciar Sesion</title>
    <?php
    if (isset($_GET['malPass'])) {
        ?>
        <script>
            $('#modal').modal();
        </script>
        <?php
    } elseif (isset($_GET['noExiste'])) {
        ?>
    }
    <script>
        $('#modal').modal();
    </script>
    <?php
}
?>
</head>
<body style="background-color: #e4e5e6">
    <?php
    require 'logica/usuario.php';
    session_start();
    if (isset($_SESSION['user'])) {
        $usuario = $_SESSION['user'];
        if ($usuario->getCargo() == 'Oficina') {
            header('location: ../volquetado/Vistas/oficina.php');
        } else if ($usuario->getCargo() == 'Inspector') {
            header('location: ../volquetado/Vistas/inspector.php');
        } else if ($usuario->getCargo() == 'Gestor') {
            header('location: ../volquetado/Vistas/gestor.php');
        } else if ($usuario->getCargo() == 'Chofer') {
            header('location: ..volquetado//Vistas/chofer.php');
        }
    } else {
        ?>
        <div id="login-overlay" class="modal-dialog">
            <div class="modal-content" style="margin-top: 18%;">
                <div class="modal-header centrar">
                    <h2 class="modal-title" id="myModalLabel">Ingrese sus datos</h2>
                </div>
                <div class="modal-body centrar">
                    <div class="centrar row">
                        <div class="col-xs-6">
                            <div class="well">
                                <form id="loginForm" action="logica/manejadorLogin.php" method="POST">
                                    <div class="form-group">
                                        <label for="username" class="control-label">Cedula</label>
                                        <input type="text" name="user" id="inputEmail" class="form-control" placeholder="Cedula..." required autofocus>
                                        <span class="help-block"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="password" class="control-label">Contraseña:</label>
                                        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Contraseña..." required>
                                        <span class="help-block"></span>
                                    </div>
                                    <div class="checkbox">
                                    </div>
                                    <button name="submit" type="submit" style="background-color: #287AE6; color : white"  class="btn btn-block">Iniciar Sesión</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal content-->
        <div  class="modal fade" id="modal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Advertencia</h4>
                    </div>
                    <div class="modal-body">
                        <p id="mensaje">Some text in the modal.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>

</body>
</html>