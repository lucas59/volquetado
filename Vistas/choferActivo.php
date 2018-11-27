<html>
<head>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css" type="text/css"/>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="../css/iniciarRecorrido.css">
    <script type="text/javascript" src="../js/jquery.js"></script>
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
        <?php 
        if (isset($_SESSION["user"])!=null){
        header('location: ../index.php');
    }  
    ?>
</head>
<body style="background-color: #e4e5e6">
    <div id="map"></div>
    <div style="position: absolute;width: 100%;height: 50px">
        <a id="finalizar" style="float: right;" class="button" href="#">Finalizar el recorrido</a>
    </div>
    <script type="text/javascript" src="../js/geolocalizacion.js"></script>
    <?php
    $volquetas = (new volquetas())->getVolquetas();

    for ($i = 0; $i < count($volquetas); $i++) {
    ?>

    <script type="text/javascript">
        agregarVolqueta('<?php echo $volquetas[$i]->getNro() ?>','<?php echo $volquetas[$i]->getLat() ?>','<?php echo $volquetas[$i]->getLong() ?>','<?php echo $volquetas[$i]->getFechaIngreso() ?>','<?php echo $volquetas[$i]->getEstadoFisico() ?>','<?php echo $volquetas[$i]->getEstadoContenido() ?>','<?php echo $volquetas[$i]->getCircuito() ?>');
    </script>
    <?php } ?>
</div>
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD54tM7ElFXcXcXvvfZTuFrxMySD-nUcag&callback=initMap">
</script>
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
</body>
</html>