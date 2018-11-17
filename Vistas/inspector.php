<!DOCTYPE html>
<html>
<head>
    <title>Inspector</title>
</head>
<body style="background-color:#e4e5e6">
    <?php
    include "../logica/circuito.php";
    include '../Vistas/barra_menu.php';
    ?>
    <div id="login-overlay" class="modal-dialog">
        <div class="modal-content" style="margin-top: 18%;">

            <div class="modal-header centrar">
                <h2 style="padding-left: 25%px" class="modal-title" id="myModalLabel">Circuitos</h2>
            </div>
            <?php 
            $circuitos=circuito::listarCircuitos();
            ?>
            <div class="modal-body centrar">
                <?php 
                if ($row = mysqli_fetch_array($circuitos)) {
                    do{
                        ?>
                        <div class="btn btn-primary btn-block"><a style="color: #ffff" href="../Vistas/inspeccionarCircuito.php"><?php $row['recorrido'] ?></a>
                        </div>
                        <?php
                    }while ($row = mysqli_fetch_array($circuitos));
                }
                ?>
                <div class="btn btn-primary btn-block"><a style="color: #ffff" href="../Vistas/consultaListaVolqueta.php"></a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>