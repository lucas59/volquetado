
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
    <style type="text/css">
    .select {
      border: 1px solid #ccc;
      width: 115px;
      overflow: hidden;
      background: #fff url("flecha-abajo.gif") no-repeat 90% center;
  }

  .select select {
    padding: 5px 8px;
    width: 115%;
    border: none;
    box-shadow: none;
    background-color: transparent;
    background-image: none;
    appearance: none;
}
</style>
</head>
<body style="background-color: #e4e5e6">
    <?php include '../Vistas/barra_menu.php'; ?>
    <a href="../Vistas/administradorCamiones.php"><img src="../Imagenes/atras.png" style="width: 50px;height: 50px" /></a>
    <div id="login-overlay" class="modal-dialog">
        <div class="modal-content" style=" margin-top: 18%;">
            <div class="modal-header centrar">
                <h2 class="modal-title" id="myModalLabel">Agregar camión</h2>
            </div>
            <div class="modal-body centrar">
                <div  style="align-content: center;" class="centrar row">
                    <div class="col-xs-6">
                        <div class="well">
                            <form id="loginForm" action="../logica/altaCamion.php" method="POST">
                                <div class="form-group">
                                    <label for="padron" class="control-label">Padrón</label>
                                    <input type="text" name="padron"  class="form-control" required/>
                                    <span class="help-block"></span>
                                </div>
                                <div class="form-group">
                                    <label for="matricula" class="control-label">Matrícula</label>
                                    <input type="text" name="matricula" pattern="[A-Za-z]{3}[0-9]{4}" class="form-control" required/>
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
                                <div class="select">
                                    <select class="dropdown-toggle" name="tipo">
                                        <option value="recolector">Recolector</option>
                                        <option value="lavadora">Lavadora</option>
                                    </select>
                                </div>
                                <br>
                                <button name="submit" type="submit" style="background-color: #287AE6; color : white"  class="btn btn-block">Listo</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
