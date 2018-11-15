<html>
<head>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css" type="text/css"/>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="../css/registrar.css">
    <script type="text/javascript" src="../js/jquery-3.31.min.js"></script>
    <script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
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
            /* Optional: Makes the sample page fill the window. */
            html, body {
                height: 100%;
                margin: 0;
                padding: 0;
            }
        </style>
    </head>
    <body style="background-color: #e4e5e6">
        <?php include '../Vistas/barra_menu.php'; ?>
        <br>
        <div id="map"></div>
        <script type="text/javascript" src="../js/miDireccion.js"></script>
        <?php
        $volquetas = (new volquetas())->getVolquetas();

        for ($i = 0; $i < count($volquetas); $i++) {
            ?>

            <script type="text/javascript">
                agregarVolqueta('<?php echo $volquetas[$i]->getNro() ?>','<?php echo $volquetas[$i]->getLat() ?>','<?php echo $volquetas[$i]->getLong() ?>','<?php echo $volquetas[$i]->getFechaIngreso() ?>','<?php echo $volquetas[$i]->getEstado() ?>');
            </script>
        <?php } ?>

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
                                        echo "<option>" . $row['recorrido'] . "</option>";
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
                    <div style="width:50%;float: left;"><button name="close" type="submit"  class="btn btn-block btn-danger">Cancelar</button></div>
                    <div id="submit" style="width:50%;float:right;"><button id="boton" name="submit" type="button" style="background-color: #287AE6; color : white"  class="btn btn-block">Agregar</button></div>
                </div>
            </div>
            <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD54tM7ElFXcXcXvvfZTuFrxMySD-nUcag&callback=initMap">
        </script>
        <script type="text/javascript">

            $("#boton").click(function(e){
                e.preventDefault();
                console.log(e);
                var circuito = document.getElementById("circuito").value;
                var numero = document.getElementById("numero").value;
                if (numero==="") {
                    $("#alerta").show();
                    $("#mensaje").text("Debe ingresar el numero de la volqueta a agregar.");
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
                        if(response.localeCompare("exito")){
                            $("#numero").text="";
                            location.reload();
                        }else if(response.localeCompare("yaesta")){
                            $("#alerta").show();
                            $("#mensaje").text("Esta volqueta ya a sido registrada anteriormente.");
                        }else if(response.localeCompare("error")){

                        }
                    },
                    error: function(response){
                        console.log(response);
                    }
                });

            });



        </script>

    </body>
    </html>