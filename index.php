<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link type="text/css" href="bootstrap/css/bootstrap.css" rel="stylesheet" id="bootstrap-css">
        <link type="text/css" href="css/indexCSS.css" rel="stylesheet">
        <title>Iniciar Sesion</title>
    </head>
    <body>
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
    </body>
</html>