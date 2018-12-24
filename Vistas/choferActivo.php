<html>
<head>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="../css/iniciarRecorrido.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> 
    <script src="../bootstrap/js/bootstrap.min.js"></script>

    <title>Administrador de volquetas</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">

    <?php

    require ('../conexion/abrir_conexion.php');
    require ('../logica/volquetas.php');
    include '../logica/circuito.php';
    ?>

    <style>
            /* Always set the map height explicitly to define the size of the div
            * element that contains the map. */
            #map {
                height: 90%;
                width: 100%;
            }
            #container {
                width:100%;
                text-align:center;
            }

            #left {
                float:left;
                width:100px;
            }

            #nuevoR {
                display: inline-block;
                margin:0 auto;
                width:100px;
                border-radius: 40px 40px 40px 40px;
                -moz-border-radius: 40px 40px 40px 40px;
                -webkit-border-radius: 40px 40px 40px 40px;
                border: 0px solid #000000;
            }
            #finalizar{
                border-radius: 40px 40px 40px 40px;
                -moz-border-radius: 40px 40px 40px 40px;
                -webkit-border-radius: 40px 40px 40px 40px;
                border: 0px solid #000000;
            }

            #right {
                float:right;
                width:100px;
            }
            /* Optional: Makes the sample page fill the window. */
            html, body {
                height: 100%;
                margin: 0;
                padding: 0;
            }
        </style>
        <?php 
        if (isset($_SESSION["user"])!=null){
            header('location: ../index.php');
        }  
        ?>
    </head>
    <body style="background-color: #e4e5e6">

        <div id="map"></div>
        <div id="container">
            <button style="float: right;" id="finalizar" type="button" class="btn btn-danger">Finalizar el recorrido</button>
            <img onclick="myLocation()" id="myLocation" src="../Imagenes/mylocation.png" style="max-width:100%;width:5%;height:8%;float: left;"/>
            <button id="nuevoR" onclick="abrirModal(<?php $circuito ?>)" style="width: auto;" type="button" class="btn btn-success">Nuevo reporte</button>
        </div>
        <script type="text/javascript" src="../js/geolocalizacion.js"></script>
        <?php
        $volquetas = volquetas::getVolquetas();

        for ($i = 0; $i < count($volquetas); $i++) {
            ?>
            <script type="text/javascript">
                agregarVolqueta('<?php echo $volquetas[$i]->getNro() ?>','<?php echo $volquetas[$i]->getLat() ?>','<?php echo $volquetas[$i]->getLong() ?>','<?php echo $volquetas[$i]->getFechaIngreso() ?>','<?php echo $volquetas[$i]->getEstadoFisico() ?>','<?php echo $volquetas[$i]->getEstadoContenido() ?>','<?php echo $volquetas[$i]->getCircuito() ?>');
            </script>
        <?php } ?>

        <script type="text/javascript">
            $("#finalizar").click(function(){
                $.ajax({
                    url: '../logica/iniciarCircuito.php',
                    type: 'POST',
                    data: {
                        accion:"finalizar"
                    },
                    success: function(response){
                        console.log(response);
                        if(response.localeCompare("finalizo")){
                            location.href ="../vistas/chofer.php";
                        }else{
                            console.log("errorrr");
                        }

                    },
                    error: function(response){
                        console.log(response);
                    }
                });
            });
        </script>
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCeo3i7Hw8nQFN7TIXeItF4G8McyyGImn8&callback=initMap">
        </script>
        <!---///////////////////////////////////////////////////////////////////-->
        <!-- Modal -->
        <div class="modal fade" id="modalReporte" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Nuevo reporte</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <input style="display: none" type="text" id="circuito">
                        <input style="display: none" type="text" id="numero">
                        <div style="display: inline-block;">
                            <h4 style="text-align: center;margin-left: auto;" for="circuito" class="control-label title">Estado físico</h4>
                            <div class="select">
                              <select id="estadoF">
                                <option>Normal</option>
                                <option>Chocada</option>
                                <option>Quemada</option>
                                <option>Prensada</option>
                                <option>Tapa rota</option>
                                <option>Ruedas dañadas</option>
                            </select>
                        </div>
                    </div>
                    <div style="display: inline-block;">
                        <h4 style="text-align: center;margin-left: auto;" for="circuito" class="control-label">Estado del contenido</h4>
                        <div class="select">
                          <select id="estadoC">
                            <option>Vacío</option>
                            <option>Medio</option>
                            <option>Lleno</option>
                            <option>Desbordado</option>
                        </select>
                    </div>
                </div>
                <label><input id="residuos" type="checkbox" name="checkbox">Residuos fuera</label>
                <?php echo "<button onclick=\"nuevoReporte()\" id=\"reportarbtn\" type=\"button\" style=\"background-color: #287AE6; color : white\"  class=\"btn btn-block\">Reportar</button>";?>
            </div>
        </div>
    </div>
</div>
<!--Modal para hcer un nuevo reporte de alguna volqueta del mapa-->

<div id="modalNuevoReporte" class="modal fade container-fluid" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Nuevo reporte</h4>
        <button id="close" type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <div class="modal-body">
        <div style="display: none" id="mensajeNuevoReporte" class="alert alert-success">
          <label id="notaNuevoReporte" class="alert-link">...</label>
      </div>
      <!-- mustro las volquetas de este circuito -->
      <!--//////////////////////////////////////////////////////////////////////////-->
      <div style="display: inline-block;">
          <label style="text-align: center;margin-left: auto;" for="circuito" class="control-label">Volqueta</label>
          <div class="select">
            <select id="volqueta">
              <?php
              $circuito=$_GET['circuito'];
              $volquetas = volquetas::listarVolquetasDeCircuito($circuito);

              for ($i = 0; $i < count($volquetas); $i++) {
                ?>
                <option><?php echo $volquetas[$i]->getNro() ?></option>

            <?php } ?>
        </select>
    </div>
    <div style="display: inline-block;">
        <h4 style="text-align: center;margin-left: auto;" for="circuito" class="control-label title">Estado físico</h4>
        <div class="select">
          <select id="estadoFisico">
            <option>Normal</option>
            <option>Chocada</option>
            <option>Quemada</option>
            <option>Prensada</option>
            <option>Tapa rota</option>
            <option>Ruedas dañadas</option>
        </select>
    </div>
</div>
<div style="display: inline-block;">
    <h4 style="text-align: center;margin-left: auto;" for="circuito" class="control-label">Estado del contenido</h4>
    <div class="select">
      <select id="estadoContenido">
        <option>Vacío</option>
        <option>Medio</option>
        <option>Lleno</option>
        <option>Desbordado</option>
        <option></option>
    </select>
</div>
</div>
</div>
<label><input id="residuos" type="checkbox" name="checkbox">Residuos fuera</label>
<?php echo "<button onclick=nuevoReport('".$circuito."') id=\"nuevoReporte\" type=\"button\" style=\"background-color: #287AE6; color : white\"  class=\"btn btn-block\">Reportar</button>";
?>
<div style="display: none;" id="mensajeExito" class="alert alert-success">
  <a id="mensaje" class="alert-link"></a>
</div>
</div>
</div>
</div>
</div>
</body>
</html>