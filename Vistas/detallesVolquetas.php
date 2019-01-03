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
	<title></title>
	<style type="text/css">
	@media all and (max-width: 1200px){
		.div{
			display: block !important;  /* Cuando el ancho sea inferior a 600px el elemento será un bloque */
			width: 100% !important;
			max-width: 100% !important;
			margin: auto !important;
			position: static !important;
			float: none !important;
			margin-right: auto;
			margin-left: auto;
		}
		.row{
			display: block !important;  /* Cuando el ancho sea inferior a 600px el elemento será un bloque */
			width: 100% !important;
			max-width: 100% !important;
			margin: auto !important;
			position: static !important;
			float: none !important;
			margin-right: auto;
			margin-left: auto;
			text-align: center;
		}
		.divBuscar{
			float: auto;
			position: block;
		}
	}
}
</style>
<script type="text/javascript">
	function mostrarUbicacion($lat,$long){
		var ubicacion = { lat: $lat, lng:$long };

		var lat=$lat;
		var long=long;
		var mapProp= {
			center:new google.maps.LatLng($lat,$long),
			zoom:18,
			styles:[
			{
				"featureType": "administrative",
				"elementType": "geometry",
				"stylers": [
				{
					"visibility": "off"
				}
				]
			},
			{
				"featureType": "landscape",
				"stylers": [
				{
					"visibility": "off"
				}
				]
			},
			{
				"featureType": "poi",
				"stylers": [
				{
					"visibility": "off"
				}
				]
			},
			{
				"featureType": "poi.medical",
				"stylers": [
				{
					"visibility": "on"
				},
				{
					"weight": 5
				}
				]
			},
			{
				"featureType": "transit",
				"stylers": [
				{
					"visibility": "off"
				}
				]
			}
			]
		};

		var map=new google.maps.Map(document.getElementById("mapa"),mapProp);
		addMarker(ubicacion,map);
	}
	function addMarker(location, map) {
		var marker = new google.maps.Marker({
			position: location,
			map: map,
			icon: {
				url: "../Imagenes/volqueta.png",
				scaledSize: new google.maps.Size(29, 35)
			}
		});
	}
	function mostrarFoto(imagen){
		console.log(imagen);
		$("#modalFoto").modal();
		src="data:image/jpg;base64,"+imagen;
		$("#fotoReporte").attr("src",src);
	}
</script>
<?php 
function base64ToImage($base64_string, $output_file) {
	$file = fopen($output_file, "wb");

	$data = explode(',', $base64_string);

	fwrite($file, base64_decode($data[0]));
	fclose($file);
	return $output_file;
}
?>
</head>
<body style="background-color: #e4e5e6">
	<?php  include '../Vistas/barra_menu.php';?>	
	
	<?php
	include '../conexion/abrir_conexion.php';
	include '../logica/volquetas.php';


	if ((isset($_GET['numero']))) {
		$numero = $_GET['numero'];
		$consulta = "SELECT * FROM volquetas WHERE nro=$numero";
		$conexion = DB::conexion();

		$resultado = mysqli_query($conexion, $consulta);
		$arreglo = null;
		if ($resultado) {
			$arreglo = mysqli_fetch_array($resultado);
		}
		if ($arreglo) {
			$volqueta = new volquetas($arreglo['nro'], $arreglo['lat'], $arreglo['lng'], $arreglo['fechaIngreso'], $arreglo['estadoFisico'],$arreglo['estadoContenido'],$arreglo['circuito'],$arreglo['activa']);
			//$nro, $lat, $long, $fechaIngreso, $estadoFisico, $estadoContenido, $circuito, $activa
		}
	}
	?>
	<div id="info" class="row" style="float:left;width: auto;">
		<div>
			<ul style="padding-left: 0px;">
				<li class="list-group-item"><h5>Volqueta número <?php echo $volqueta->getNro() ?></h5></li>
				<li class="list-group-item">Estado físico actual: <?php echo $volqueta->getEstadoFisico() ?></li>
				<li class="list-group-item">Estado del contenido: <?php echo $volqueta->getEstadoContenido() ?></li>
				<li class="list-group-item">Fecha de ingreso: <?php echo $volqueta->getFechaIngreso() ?></li>
				<li class="list-group-item">Latitud: <?php echo $volqueta->getLat()?></li>
				<li class="list-group-item">Longitud: <?php echo $volqueta->getLong() ?></li>
				<li class="list-group-item">Ubicación: <?php echo "<td><button onclick=\"mostrarUbicacion(".$volqueta->getLat().",".$volqueta->getLong().")\" data-toggle=\"modal\" data-target=\"#myModal\" style=\"background:url('../Imagenes/ver.png');background-position:center center;background-repeat:no-repeat;width:70px; height:25px\" type=\"input\" name=\"Ver\" class=\"btn btn-primary\"></button></td>"; ?></li>
			</ul>
		</div>
	</div>
	<br>
	<div class="divBuscar" style="width: 20%; margin-left: auto;margin-right: auto;left: 0;right: 0;text-align: center">
		<input id="buscar" style=" display: block;margin-right: auto;margin-left: auto;width: 216px" type="text" name="Buscar" class="form-control" placeholder="Buscar" onkeyup="FiltrarTabla()" />
	</div>
	<br>
	<div class="table-responsive div" style="width: auto;padding-right: 50px;padding-left: 50px;height: auto;">
		<table id="tabla" class="table table-striped w-auto" style="margin-bottom: 0px;width: auto;" >
			<thead>
				<tr> 
					<th class="active" style = "color: black" >Fecha de registro</th>
					<th class="active" style = "color: black" >Estado físico</th>
					<th class="active" style = "color: black" >Estado del contenido</th>
					<th class="active" style = "color: black" >Residuos fuera</th>
					<th class="active" style = "color: black" >Descripción</th>
					<th class="active" style = "color: black" >Fotografía</th>
				</tr>
			</thead>
			<tbody style="background-color: #ffffff" class="thead-light">
				<?php
				$volquetas = volquetas::mostrarHistoria($volqueta->getNro());
				if ($row = mysqli_fetch_array($volquetas)) {
					do {
						echo "<tr>";
						echo "<td><p>" . $row["fecha"] . "</p></td>";
						echo "<td><p>" . $row['estadoFisico'] . "</p></td>";
						echo"<td><p>" . $row['estadoContenido'] . "</p></td>";
						if($row['contenidoFuera']==1){
							echo"<td><p>SI</p></td>";	
						}else{
							echo"<td><p>NO</p></td>";		
						}
						if($row['nota']){
							echo"<td><p>" . $row['nota'] . "</p></td>";	
						}else{
							echo"<td><p>SIN DESCRIPCION</p></td>";	
						}
						if($row['imagen']){
							echo "<td><button onclick=mostrarFoto('".$row['imagen']."') style=\"background:url('../Imagenes/ver.png');background-position:center center;background-repeat:no-repeat;width:70px; height:25px\" type=\"input\" name=\"Ver\" class=\"btn btn-primary\"></button></td>";
						}
						echo "</tr>";
					} while ($row = mysqli_fetch_array($volquetas));
					?>
				<?php }
				?>
			</tbody>
		</table>
	</div>

	<div id="myModal" class="modal fade container-fluid" role="dialog">
		?>

		<div style="width: 100%;height: auto" class="modal-dialog">
			<div style="height: 90%;width: 100%;" class="modal-content">
				<div class="modal-header">
					<h4 style="font" class="modal-title">Ubicación</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<div style="width:100%;height:400px;" id="mapa"></div><br>	
				</div>
			</div>
		</div>
	</div>

	<div id="modalFoto" class="modal" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-body">
					<img style="width: 100%;height: 100%" id="fotoReporte" src="">
				</div>
			</div>
		</div>

		<script async defer
		src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD54tM7ElFXcXcXvvfZTuFrxMySD-nUcag&callback=initMap">
	</script>
</body>
</html>