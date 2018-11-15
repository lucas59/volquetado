<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css"/>
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/listarTabla.js"></script>

    <title>Inspector</title>
    
</head>
<body style="background-color: #e4e5e6">
    <?php
    include '../Vistas/barra_menu.php';
    include '../conexion/abrir_conexion.php';
    ?>
    <div style="margin-left: auto;margin-right: auto;left: 0;right: 0;text-align: center">
        <input id="buscar" style=" display: block;margin-right: auto;margin-left: auto;width: 216px" type="text" name="Buscar" class="form-control" placeholder="Buscar" onkeyup="FiltrarTabla()" />
    </div>

    <div style="  overflow-x: auto;">
        <table id="tabla" class="table table-striped table-bordered table-hover" >
            <thead>
                <tr>
                	<th class="active" style = "color: black" >Circuito</th>   
                    <th class="active" style = "color: black" >Nro</th>
                    <th class="active" style = "color: black" >Estado fisico</th>
                    <th class="active" style = "color: black" >Ver mas</th>

                </tr>
            </thead>
            <div style="overflow: auto">
                <tbody style="background-color: #ffffff" class="thead-light">
                    <?php
                    include '../logica/volquetas.php';
                    $volquetas = volquetas::listarTodas();
                    if ($row = mysqli_fetch_array($volquetas)) {
                        do {
                            echo "<tr>";
                            echo "<td><p>" . $row["circuito"] . "</p></td>";
                            echo "<td><p>" . $row["nro"] . "</p></td>";
                            echo "<td><p>" . $row['estado'] . "</p></td>";
                            echo"<td><p>" . $row['fechaIngreso'] . "</p></td>";
                            echo "<td><button onClick=\"window.location.href='../Vistas/detallesVolquetas.php?numero=".$row["nro"]."'\" style=\"background:url('../Imagenes/ver.png');background-position:center center;background-repeat:no-repeat;width:70px; height:25px\" type=\"input\" name=\"Ver\" class=\"btn btn-primary\"></button></td>";

                            echo "</tr>";
                        } while ($row = mysqli_fetch_array($volquetas));
                        ?>
                    <?php }
                    ?>
                </tbody>
            </table>
        </div> 
    </body>
    </html>
