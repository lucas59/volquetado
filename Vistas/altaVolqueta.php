<html>
    <head>
        <link rel="stylesheet" href="../bootstrap/css/bootstrap.css" type="text/css"/>
        <title>Administrador de volquetas</title>
        <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
        <meta charset="utf-8">
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
    <body style="background-color: #076f89">
        <br>
        <div id="map"></div>
        <?php
        include "../conexion/abrir_conexion.php";

        $query = "select * from volquetas";
        $resultado = mysqli_query($conexion, $query);

        $i = 1;
        while ($data = mysqli_fetch_assoc($resultado)) {
            ?>
            <script type="text/javascript">
                var marker<?php echo $i; ?> = new google.maps.Marker({
                    position: new google.maps.LatLng(<?php echo $data['lat']; ?>, <?php echo $data['lng']; ?>),
                    map: map,
                    title: <?php echo "'" . $data['nombre'] . "'"; ?>,
                    icon: 'img/icono.png',
                });

                var contentString = "<h1><span class='glyphicon glyphicon-asterisk' aria-hidden='true'>\n\
                </span>&#160;<?php echo "" . $data['nombre'] . ""; ?></h1><p><span class='glyphicon glyphicon-screenshot' aria-hidden='true'></span>&#160;<b>Dirección</b><br> <?php echo "" . $data['direccion'] . ""; ?></p><p><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>&#160;<b>Descripción</b><br><?php echo "" . $data['descripcion'] . ""; ?></p>"

                var infowindow<?php echo $i; ?> = new google.maps.InfoWindow({
                    content: contentString
                });

                google.maps.event.addListener(marker<?php echo $i; ?>, 'click', function () {
                    infowindow<?php echo $i; ?>.open(map, marker<?php echo $i; ?>);
                });
            </script>
            <?php
            $i++;
        }
        mysqli_close($conexion);
        ?>
        <script async defer
                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD54tM7ElFXcXcXvvfZTuFrxMySD-nUcag&callback=initMap">
        </script>
        <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
        <script type="text/javascript" src="../js/miDireccion.js"></script>
    </body>
</html>
