
<!DOCTYPE html>
<html lang="en">
    <head>
        <link type="text/css" href="../bootstrap/css/bootstrap.css" rel="stylesheet" id="bootstrap-css">
        <link type="text/css" href="../css/indexCSS.css" rel="stylesheet">
        <title>Agregar camion</title>
        <?php
        if (isset($_GET['yaesta'])) {
            echo '<script language="javascript">alert("Este camion ya se encuentra registrado.");</script>';
        } elseif (isset($_GET['exito'])) {
            echo '<script language="javascript">alert("El camion se registró con exito.");</script>';
        } else if (isset($_GET['fallo'])) {
            echo '<script language="javascript">alert("Fallo la consulta.");</script>';
        }
        ?>
    </head>
    <body style="background-color: #3295e7">
        <?php include '../Vistas/barra_menu.php'; ?>
        <div id="login-overlay" class="modal-dialog">
            <div class="modal-content" style="margin-top: 18%;">
                <div>

                </div>
                <div class="modal-header centrar">
                    <h2 class="modal-title" id="myModalLabel">Agregar camion</h2>
                </div>
                <div class="modal-body centrar">
                    <div  style="align-content: center;" class="centrar row">
                        <div class="col-xs-6">
                            <div class="well">
                                <form id="loginForm" action="../logica/altaCamion.php" method="POST">
                                    <div class="form-group">
                                        <label for="matricula" class="control-label">Matricula</label>
                                        <input type="text" name="matricula"  class="form-control"required/>
                                        <span class="help-block"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="marca" class="control-label">Marca</label>
                                        <input type="text" name="marca"  class="form-control" required/>
                                        <span class="help-block"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="modelo" class="control-label">Modelo</label>
                                        <input type="text" name="modelo" class="form-control" required />
                                        <span class="help-block"></span>
                                    </div>
                                    <div class="">
                                        <select class="dropdown-toggle" name="tipo">
                                            <option value="recolector">Recolector</option>
                                            <option value="lavadora">Lavadora</option>
                                        </select>
                                    </div>
                                    <br>
                                    <button name="submit" type="submit" style="background-color: #287AE6; color : white"  class="btn btn-block">Listo...</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
