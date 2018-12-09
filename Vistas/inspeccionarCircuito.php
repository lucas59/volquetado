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
  <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css"/>
  <script type="text/javascript" src="../js/inspector.js"></script>
  <title>Inspector</title>
  <style type="text/css">
  .select {
    border: 1px solid #ccc;
    width: 115px;
    overflow: hidden;
    background: #fff url("flecha-abajo.gif") no-repeat 90% center;
  }

  .select select {
    padding: 5px 8px;
    width: 115%;
    border: none;
    box-shadow: none;
    background-color: transparent;
    background-image: none;
    appearance: none;
  }
</style>
</head>
<body style="background-color: #e4e5e6">
  <?php
  if (isset($_GET["numero"])) {
    $numero=$_GET["numero"];
       // echo "<script>console.log(".$numero.")</script>";
    include '../Vistas/barra_menu.php';
    include '../conexion/abrir_conexion.php';
    ?>
    <?php
    echo "<button style=\"float:left\" onclick=nuevoReporte('".$numero."') class=\"btn btn-primary\">Nuevo Reporte</button>";?>
    <div style="margin-left: auto;margin-right: auto;left: 0;right: 0;text-align: center">
      <input id="buscar" style=" display: block;margin-right: auto;margin-left: auto;width: 216px" type="text" name="Buscar" class="form-control" placeholder="Buscar" onkeyup="FiltrarTabla()" />
    </div>

    <div style="  overflow-x: auto;">
      <table id="tabla" class="table table-striped table-bordered table-hover" >
        <thead>
          <tr>
           <th class="active" style = "color: black" >Circuito</th>   
           <th class="active" style = "color: black" >Nro</th>
           <th class="active" style = "color: black" >Estado físico</th>
           <th class="active" style = "color: black" >Estado contenido</th>
           <th class="active" style = "color: black" >Fecha</th>
           <th class="active" style = "color: black" >Inspecionada</th>
           <th class="active" style = "color: black" >Descripcion</th>
           <th class="active" style = "color: black" >Reportar</th>
           <th class="active" style = "color: black" >Aceptar</th>

         </tr>
       </thead>
       <div style="overflow: auto">
        <tbody style="background-color: #ffffff" class="thead-light">
          <?php
          include '../logica/reporte.php';
          include '../logica/volquetas.php';
          $reporte = reporte::listarVolquetaSinInspeccionar($numero);

          for($i=0;$i<count($reporte);$i++){
            //if ($reporte[$i]->getInspeccion()==false) {
            echo "<tr>";
            echo "<td><p id=\"circuito\">" . $reporte[$i]->getCircuito() . "</p></td>";
            echo "<td><p id=\"numero\">" . $reporte[$i]->getNro() . "</p></td>";
            echo "<td><p>" . $reporte[$i]->getEstadoFisico() . "</p></td>";
            echo "<td><p>" . $reporte[$i]->getEstadoContenido() . "</p></td>";
            echo "<td><p>" . $reporte[$i]->getFecha() . "</p></td>";

            if($reporte[$i]->getInspeccion()==true){
              echo "<td><p>SI</p></td>";
              
            }else{
              echo "<td><p>NO</p></td>";
              
            }
            echo "<td><p>" . $reporte[$i]->getNota() . "</p></td>";

            echo "<td><button onclick=reportar('".$reporte[$i]->getCircuito()."','".$reporte[$i]->getNro()."') id=\"reportar\" style=\"background:url('../Imagenes/reportar.png');background-position:center center;background-repeat:no-repeat;width:70px; height:25px\" type=\"input\" name=\"Ver\" class=\"btn btn-primary\"></button></td>";
            if($reporte[$i]->getInspeccion()==false){
              echo "<td><button onclick=aceptarDatos('".$reporte[$i]->getCircuito()."','".$reporte[$i]->getNro()."','".$reporte[$i]->getEstadoFisico()."','".$reporte[$i]->getEstadoContenido()."','".$reporte[$i]->getContenidoFuera()."') style=\"background:url('../Imagenes/ok.png');background-position:center center;background-repeat:no-repeat;width:70px; height:25px\" type=\"input\" name=\"Ver\" class=\"btn btn-primary\"></button></td>";
            }
            echo "</tr>";
            //}
          }
          ?>
        </tbody>
      </table>
    </div> 
  <?php }else{
    header('location:../index.php');
  } ?>

  <!-- #########################MODAL PARA DAR UN REPORTAR########################## -->
  <div id="modalReportar" class="modal fade container-fluid" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Reportar</h4>
          <button id="close" type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <input id="circuito" type="text" style="display: none;" name="circuito"/>
          <input id="numero" type="text" style="display: none;" name="numero"/>
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
          <div style="display: inline-block;">
            <h4 style="text-align: center;margin-left: auto;" for="circuito" class="control-label">Descripción</h4>
            <div id="nota">
              <textarea id="descripcion" style="width: 200px;height: 40px"></textarea>
            </div>
          </div>
          <label><input id="residuos" type="checkbox" name="checkbox">Residuos fuera</label>
          <?php echo "<button onclick=\"btnReportar()\" id=\"boton\" name=\"submit\" type=\"button\" style=\"background-color: #287AE6; color : white\"  class=\"btn btn-block\">Reportar</button></div>";
          ?>
        </div>
      </div>
    </div>

    <!-- ##################MODAL PARA ACEPTAR UN REGISTRO################################# -->
    <div id="modalAceptar" class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-footer">
            <input id="circuitoCorrecto" type="text" style="display: none;" name="circuito"/>
            <input id="numeroCorrecto" type="text" style="display: none;" name="numero"/>
            <input id="estadoFisico" type="text" style="display: none;" name="circuito"/>
            <input id="estadoContenido" type="text" style="display: none;" name="numero"/>
            <input id="contenidoFuera" type="text" style="display: none;" name="circuito"/>
            <button id="volver" type="button" class="btn btn-secondary" data-dismiss="modal">Volver</button>
            <button onclick="confirmarReporte()" type="button" class="btn btn-primary">Aceptar</button>
          </div>
        </div>
      </div>
    </div>
    <!-- ###################MODAL PARA AGREGAR ################################ -->
    <div id="modalAgregar" class="modal fade container-fluid" role="dialog">
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
                  $volquetas = volquetas::listarVolquetasDeCircuito($numero);

                  for ($i = 0; $i < count($volquetas); $i++) {
                    ?>
                    <option><?php echo $volquetas[$i]->getNro() ?></option>

                  <?php } ?>
                </select>
              </div>
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
                    <option></option>
                  </select>
                </div>
              </div>
              <div style="display: inline-block;">
                <h4 style="text-align: center;margin-left: auto;" for="circuito" class="control-label">Descripción</h4>
                <div id="nota">
                  <textarea id="notita" style="width: 200px;height: 40px"></textarea>
                </div>
              </div>
            </div>
            <label><input id="residuos" type="checkbox" name="checkbox">Residuos fuera</label>
            <?php echo "<button onclick=nuevoReport('".$numero."') id=\"nuevoReporte\" type=\"button\" style=\"background-color: #287AE6; color : white\"  class=\"btn btn-block\">Reportar</button>";
            ?>
            <div style="display: none;" id="mensajeExito" class="alert alert-success">
              <a id="mensaje" class="alert-link"></a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- ################################################### -->
  </body>
  </html>
