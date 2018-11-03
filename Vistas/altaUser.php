
<!DOCTYPE html>
<html lang="en">
    <head>
        <link type="text/css" href="../bootstrap/css/bootstrap.css" rel="stylesheet" id="bootstrap-css">
        <link type="text/css" href="../css/indexCSS.css" rel="stylesheet">
        <?php
        if (isset($_GET['mensaje'])) {
            echo "<script type='text/javascript'>alert($mensaje);</script>";
        }
        ?>
    </head>
    <body style="background-color: #68b0ab">
        <div id="login-overlay" class="modal-dialog">
            <div class="modal-content" style="margin-top: 18%;">
                <div class="modal-header centrar">
                    <h2 class="modal-title" id="myModalLabel">Registrar usuario</h2>
                </div>
                <div class="modal-body centrar">
                    <div class="centrar row">
                        <div class="col-xs-6">
                            <div class="well">
                                <form id="loginForm" action="../logica/altaUsuario.php" method="POST">
                                    <div class="form-group">
                                        <label for="cedula" class="control-label">Cedula</label>
                                        <input type="text" name="cedula"  class="form-control"required/>
                                        <span class="help-block"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="nombre" class="control-label">Nombre</label>
                                        <input type="text" name="nombre"  class="form-control" required/>
                                        <span class="help-block"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="apellido" class="control-label">Apellido</label>
                                        <input type="text" name="apellido" class="form-control" required />
                                        <span class="help-block"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="password" class="control-label">Contraseña:</label>
                                        <input type="password" name="pass" id="inputPassword" class="form-control" required/>
                                        <span class="help-block"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="username" class="control-label">Confirmar contraseña</label>
                                        <input type="password" name="passc" class="form-control" required >
                                        <span class="help-block"></span>
                                    </div>
                                    <div class="">
                                        <select name="tipo">
                                            <option value="oficina">Oficina</option>
                                            <option value="inspector">Inspector</option>
                                            <option value="chofer">Chofer</option>
                                            <option value="gestor"></option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="fecha" class="control-label">Fecha</label>
                                        <input type="date" name="fecha"  class="form-control" required/>
                                        <span class="help-block"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="direccion" class="control-label">Direccion</label>
                                        <input type="text" name="direccion"  class="form-control" required/>
                                        <span class="help-block"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="celular" class="control-label">Celular</label>
                                        <input type="text" name="celular"  class="form-control" required/>
                                        <span class="help-block"></span>
                                    </div>
                                    <button name="submit" type="submit" style="background-color: #287AE6; color : white"  class="btn btn-block">Iniciar Sesión</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
