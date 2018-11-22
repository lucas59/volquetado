<!DOCTYPE html>
<html>
<head>
    <title>Gestor</title>
    

</head>
<body style="background-color:#e4e5e6">
    <?php include '../Vistas/barra_menu.php'; ?>

    <div id="login-overlay" class="modal-dialog">
        <div class="modal-content" style="margin-top: 18%;">

            <div class="modal-header centrar">
                <h2 style="padding-left: 25%px" class="modal-title" id="myModalLabel">Bienvenido</h2>
            </div>
            <div class="modal-body centrar">
                <div class="btn btn-primary btn-block" ><a style="color: #ffff" href="../Vistas/consultaListaVolqueta.php">Ver estado de una volqueta</a></div>
                <div class="btn btn-primary btn-block"><a style="color: #ffff" href="../logica/exportarDatosAbiertos.php">Exportar datos</a></div>
            </div>
        </div>
    </div>
</body>
</html>