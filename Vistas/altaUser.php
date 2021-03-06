
<!DOCTYPE html>
<html lang="en">
<head>
    <link type="text/css" href="../bootstrap/css/bootstrap.css" rel="stylesheet" id="bootstrap-css">
    <link type="text/css" href="../css/indexCSS.css" rel="stylesheet">
    <script type="text/javascript" src="../js/jquery-3.31.min.js"></script>
    
    <?php

   /* if (isset($_GET['exito'])) {
        echo '<script language="javascript">alert("El usuario se registro con exito.");</script>';
    } elseif (isset($_GET['noexito'])) {
        echo '<script language="javascript">alert("Este usuario ya esta registrado.");</script>';
    } else if (isset($_GET['malPass'])) {
        echo '<script language="javascript">alert("Verifique su contraseña.");</script>';
    } else if (isset($_GET['fallo'])) {
        echo '<script language="javascript">alert("Fallo la consulta.");</script>';
    }*/
    ?>
</head>
<body style="background-color: #e4e5e6">
    <?php include '../Vistas/barra_menu.php'; ?>
    <a href="../Vistas/administradorUsuarios.php"><img src="../Imagenes/atras.png" style="width: 50px;height: 50px" /></a>
    <div id="login-overlay" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header centrar">
                <h2 style="margin-left: 25%" class="modal-title" id="myModalLabel">Registrar usuario</h2>
            </div>
            <div class="modal-body centrar">
                <div class="centrar row">
                    <div class="col-xs-6">
                        <div class="well">
                            <div class="form-group">
                                <label for="cedula" class="control-label">Cédula</label>
                                <input type="text" id="cedula"  class="form-control"required/>
                                <span class="help-block"></span>
                            </div>
                            <div class="form-group">
                                <label for="nombre" class="control-label">Nombre</label>
                                <input type="text" id="nombre"  class="form-control" required/>
                                <span class="help-block"></span>
                            </div>
                            <div class="form-group">
                                <label for="apellido" class="control-label">Apellido</label>
                                <input type="text" id="apellido" class="form-control" required />
                                <span class="help-block"></span>
                            </div>
                            <div class="select">
                                <select class="dropdown-toggle" id="tipo" name="tipo">
                                    <option value="Oficina">Oficina</option>
                                    <option value="Inspector">Inspector</option>
                                    <option value="Chofer">Chofer</option>
                                    <option value="Gestor">Gestor</option>
                                    <option value="Recolector">Recolector</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="password" class="control-label">Contraseña:</label>
                                <input type="password" id="pass" class="form-control" required/>
                                <span class="help-block"></span>
                            </div>
                            <div class="form-group">
                                <label for="username" class="control-label">Confirmar contraseña</label>
                                <input type="password" id="passc" class="form-control" required >
                                <span class="help-block"></span>
                            </div>
                            <div class="form-group">
                                <label for="fecha" class="control-label">Fecha de nacimiento</label>
                                <input type="date" id="fecha"  class="form-control" required/>
                                <span class="help-block"></span>
                            </div>

                            <div class="form-group">
                                <label for="libreta" class="control-label">Vencimiento de permiso de conducción</label>
                                <input type="date" id="libreta"  class="form-control" required/>
                                <span class="help-block"></span>
                            </div>

                            <div class="form-group">
                                <label for="direccion" class="control-label">Dirección</label>
                                <input type="text" id="direccion"  class="form-control" required/>
                                <span class="help-block"></span>
                            </div>
                            <div class="form-group">
                                <label for="celular" class="control-label">Celular</label>
                                <input type="text" id="celular"  class="form-control" required/>
                                <span class="help-block"></span>
                            </div>
                            <button id="registrar" id="submit" type="submit" style="background-color: #287AE6; color : white"  class="btn btn-block">Agregar usuario</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--//////////////////////////////////////////////////////////////-->

    <div id="modal" class="modal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-body">
            <div id="mensaje" style="display: none" class="alert alert-success">
                <p id="mensajeExito"></p>
            </div>

            <div id="mensajeExiste" style="display: none" class="alert alert-danger">
                <p id="mensajeYaExiste"></p>
            </div>
        </div>

        <div class="modal-footer">
            <button  id="aceptar" type="button" class="btn btn-primary">Aceptar</button>
        </div>
    </div>
</div>
</div>
<script type="text/javascript" src="../js/altaUser.js"></script>
</body>
</html>
