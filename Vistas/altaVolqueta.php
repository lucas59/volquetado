<html>
<head>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css" type="text/css"/>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css" type="text/css"/>
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
    
    <title>Administrador de volquetas</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <?php
    require ('../conexion/abrir_conexion.php');
    require ('../logica/volquetas.php');
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
        <br>
        <div id="map"></div>
        <script type="text/javascript" src="../js/miDireccion.js"></script>

        <?php 
        $volquetas = (new volquetas())->getVolquetas();

        for ($i=0;$i<count($volquetas);$i++) {

           ?>

           <script type="text/javascript">
            agregarVolqueta(<?php echo $volquetas[$i]->getNro() ?>,<?php echo $volquetas[$i]->getLat() ?>,<?php echo $volquetas[$i]->getLong() ?>,<?php echo $volquetas[$i]->getFechaIngreso() ?>,'<?php echo $volquetas[$i]->getEstado() ?>');
        </script>
    <?php }?>

    <!-- Modal -->
    <div id="myModal" class="modal fade container-fluid" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Nueva volqueta</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <div>
                <div style="width: 30%;float: left;" class="form-group">
                    <label style="text-align: center;margin-left: auto;" for="circuito" class="control-label">Circuito</label>
                    <input id="circuito" style="text-transform:uppercase" type="text" name="circuito"  class="form-control" required maxlength="2" />
                    <span class="help-block"></span>
                </div>
                <div style="width: 65%; float: right" class="form-group">
                    <label style="text-align: center;margin-left: 25%;" for="numero" class="control-label">Número</label>
                    <input id="numero" type="number" name="numero"  class="form-control" max="999" maxlength="3" required/>
                    <span class="help-block"></span>
                </div>
            </div>
            <div style="width:50%;float: left;"><button name="close" type="submit"  class="btn btn-block btn-danger">Cancelar</button></div>
            <div id="submit" style="width:50%;float:right;"><button onclick="ingresarVolqueta()" name="submit" type="submit" style="background-color: #287AE6; color : white"  class="btn btn-block">Agregar</button></div>
        </div>
    </div>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD54tM7ElFXcXcXvvfZTuFrxMySD-nUcag&callback=initMap">
</script>
</body>
</html>
