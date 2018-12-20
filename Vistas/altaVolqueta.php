<html>
<head>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css" type="text/css"/>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="../css/registrar.css">
    <script type="text/javascript" src="../js/jquery-3.31.min.js"></script>
    <title>Administrador de volquetas</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <script type="text/javascript" src="../js/miDireccion.js"></script>
    <?php

    require ('../conexion/abrir_conexion.php');
    include '../logica/volquetas.php';
    include '../logica/circuito.php';
    ?>

    <style>
            /* Always set the map height explicitly to define the size of the div
            * element that contains the map. */
            #map {
                height: 90%;
                width: 100%;
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
        <?php include '../Vistas/barra_menu.php'; ?>
        <div style="position: absolute;" id="map"></div>
        <div style="position: absolute;" class="select">
            <?php
            $circuito = circuito::listarCircuitos();
            if ($row = mysqli_fetch_array($circuito)) {
                ?>
                <select id="listarVolquetaPorCircuito">
                    <option onclick="mostrarVolquetas('Todos')">Todos</option>
                    <?php
                    do {
                        $circuitoId=$row['circuito'];
                        echo "<option onclick=mostrarVolquetas('".$circuitoId."') >" . $row['circuito'] . "</option>";
                    } while ($row = mysqli_fetch_array($circuito));
                    ?>
                </select>
            <?php } ?>
        </div>
        <img onclick="myLocation()" id="myLocation" src="../Imagenes/mylocation.png" style="max-width:100%;width:7%;height:10%;position: relative;float: right;"/>
        <?php
        $volquetas = volquetas::getVolquetas();

        for ($i = 0; $i < count($volquetas); $i++) {
            ?>
            <script type="text/javascript">
                agregarVolqueta('<?php echo $volquetas[$i]->getNro() ?>','<?php echo $volquetas[$i]->getLat() ?>','<?php echo $volquetas[$i]->getLong() ?>','<?php echo $volquetas[$i]->getFechaIngreso() ?>','<?php echo $volquetas[$i]->getEstadoFisico() ?>','<?php echo $volquetas[$i]->getEstadoContenido() ?>','<?php echo $volquetas[$i]->getCircuito() ?>');
            </script>
        <?php } ?>

        <!--*******************************************************************************-->
        <div class="modal fade" id="modalRetornoExito" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Volqueta ingresada.</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                </div>
            </div>
        </div>
        <!--*******************************************************************************-->
        <!--*******************************************************************************-->
        <div class="modal fade" id="modalRetornoFallo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Ya existe esta volqueta.</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                </div>
            </div>
        </div>
        <!--*******************************************************************************-->
        
        <!-- Modal -->
        <div id="myModal" class="modal fade container-fluid" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Nueva volqueta</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                      <div style="display: inline-block;">
                        <?php
//··································································
                        ?>
                        <label style="text-align: center;margin-left: auto;" for="circuito" class="control-label">Circuito</label>
                        <div class="select">
                            <?php
                            $circuito = circuito::listarCircuitos();
                            if ($row = mysqli_fetch_array($circuito)) {
                                ?>
                                <select id="circuito">
                                    <?php
                                    do {
                                        echo "<option>" . $row['circuito'] . "</option>";
                                    } while ($row = mysqli_fetch_array($circuito));
                                    ?>
                                </select>
                            <?php } ?>
                        </div>
                    </div>
                    <div style="width: 60%; float: right" class="form-group">
                        <label style="text-align: center;margin-left: 25%;" for="numero" class="control-label">Número</label>
                        <input id="numero" type="number" name="numero"  class="form-control" max="999" maxlength="3" required/>
                        <span class="help-block"></span>
                    </div>
                    <div style="display: none;" id="alerta" class="alert alert-danger" role="alert">
                        <p id="mensaje"></p>
                    </div>
                    <div id="submit" style="width:100%;float:right;"><button id="boton" name="submit" type="button" style="background-color: #287AE6; color : white"  class="btn btn-block">Agregar</button></div>
                </div>
            </div>
        </div>
        <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>

        <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD54tM7ElFXcXcXvvfZTuFrxMySD-nUcag&callback=initMap">
    </script>
    <script type="text/javascript">

        $("#boton").click(function(e){
            e.preventDefault();
                //console.log(e);
                var circuito = document.getElementById("circuito").value;
                var numero = document.getElementById("numero").value;
                if (numero==="") {
                    $("#alerta").show();
                    $("#mensaje").text("Debe ingresar el número de la volqueta a agregar.");
                    return;
                }

                $.ajax({
                    url: '/volquetado/logica/manejadorAltaVolqueta.php',
                    type: 'POST',
                    data: {
                        accion:"altaVolqueta",
                        numero:numero,
                        circuito:circuito,
                        lat:marcador.getPosition().lat(),
                        long:marcador.getPosition().lng()
                    },
                    success: function(response){
                        console.log(response);
                        if(response.localeCompare("exito")){
                            $("#numero").text="";
                            $("#myModal").modal('hide');
                            $("#modalRetornoExito").modal();
                            location.reload();
                        }else if(response.localeCompare("yaesta")){
                            $("#modalRetornoFallo").modal();
                        }else if(response.localeCompare("error")){

                        }
                    },
                    error: function(response){
                        //console.log(response);
                    }
                });

            });
        </script>
    </body>
    </html>