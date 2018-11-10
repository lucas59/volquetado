<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
<head>
	<meta charset="UTF-8">
	<title></title>
</head>
<body style="background-color: #e4e5e6">
	<?php
	include '../Vistas/barra_menu.php';
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
			$volqueta = new volquetas($arreglo['nro'], $arreglo['lat'], $arreglo['long'], $arreglo['fechaIngreso'], $arreglo['estado']);
		}
	}
	?>

	<div style="float:left;width: auto;height: auto">
		<div style="width: auto">
			<div><h3>Volqueta número <?php echo $volqueta->getNro() ?></h3></div>
			<ul style="padding-left: 0px">
				<li class="list-group-item">Estado actual: <?php echo $volqueta->getEstado() ?></li>
				<li class="list-group-item">Fecha de ingreso: <?php echo $volqueta->getFechaIngreso() ?></li>
				<li class="list-group-item">Latitud: <?php echo $volqueta->getLat()?></li>
				<li class="list-group-item">Longitud: <?php echo $volqueta->getLong() ?></li>
			</ul>
		</div>
	</div>
	<div style="width: 75%;float: right;height: auto;">
		<table id="tabla" class="table table-striped table-bordered table-hover" >
			<thead>
				<tr>   
					<th class="active" style = "color: black" >Fecha de registro</th>
					<th class="active" style = "color: black" >Estado fisico</th>
					<th class="active" style = "color: black" >Estado del contenido</th>
					<th class="active" style = "color: black" >Reciduos fuera</th>
					<th class="active" style = "color: black" >Descripcion</th>
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
							echo"<td><p>" . $row['contenidoFuera'] . "</p></td>";
							echo"<td><p>" . $row['nota'] . "</p></td>";
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