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

                while ($row = mysqli_fetch_array($circuitos)) {
                    echo "<script>console.log('".$row["recorrido"]."')</script>";

                    $recorrido=$row['recorrido'];
                    echo "<script>console.log('".$recorrido."')</script>";

                    echo "<div class=\"btn btn-primary btn-block\">";
                    echo "<a style=\"color: #ffff; padding-left: 50%;padding-right: 50%;\" href=\"../Vistas/inspeccionarCircuito.php?numero=".$recorrido."\">";
                    echo $row['recorrido'];
                    echo "</a>";
                    echo "</div>";       
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>