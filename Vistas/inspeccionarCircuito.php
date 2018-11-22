<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
<head>
  <meta charset="UTF-8">
  <script type="text/javascript" src="../js/jquery.js"></script>
  <script type="text/javascript" src="../js/listarTabla.js"></script>
  <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css"/>
  <title>Inspector</title>
</head>
<body style="background-color: #e4e5e6">
  <?php
  if (isset($_GET["numero"])) {
    $numero=$_GET["numero"];
       // echo "<script>console.log(".$numero.")</script>";
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
           <th class="active" style = "color: black" >Estado contenido</th>
           <th class="active" style = "color: black" >Fecha</th>
           <th class="active" style = "color: black" >Reportar</th>
           <th class="active" style = "color: black" >Aceptar</th>

         </tr>
       </thead>
       <div style="overflow: auto">
        <tbody style="background-color: #ffffff" class="thead-light">
          <?php
          include '../logica/reporte.php';
          $reporte = reporte::listarVolquetaSinInspeccionar($numero);

          for($i=0;$i<count($reporte);$i++){
            if ($reporte[$i]->getInspeccion()==false) {
              echo "<tr>";
              echo "<td><p id=\"circuito\">" . $reporte[$i]->getCircuito() . "</p></td>";
              echo "<td><p id=\"numero\">" . $reporte[$i]->getNro() . "</p></td>";
              echo "<td><p>" . $reporte[$i]->getEstadoFisico() . "</p></td>";
              echo "<td><p>" . $reporte[$i]->getEstadoContenido() . "</p></td>";
              echo "<td><p>" . $reporte[$i]->getFecha() . "</p></td>";
              echo "<td><button onclick=\"reportar()\" id=\"reportar\" style=\"background:url('../Imagenes/reportar.png');background-position:center center;background-repeat:no-repeat;width:70px; height:25px\" type=\"input\" name=\"Ver\" class=\"btn btn-primary\"></button></td>";
              echo "<td><button style=\"background:url('../Imagenes/ok.png');background-position:center center;background-repeat:no-repeat;width:70px; height:25px\" type=\"input\" name=\"Ver\" class=\"btn btn-primary\"></button></td>";

              echo "</tr>";
            }
          }
          ?>
        </tbody>
      </table>
    </div> 
  <?php }else{
    header('location:../index.php');
  } ?>
  <script type="text/javascript" src="../js/inspector.js"></script>
</body>
</html>
