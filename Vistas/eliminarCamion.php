<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css"/>
	<script type="text/javascript" src="../js/jquery-3.31.min.js"></script>
	<script type="text/javascript" src="../js/listarTabla.js"></script>
	<title>Oficina</title>
	<style type="text/css">
	#centrar{
		align-items: center;
		display: flex;
		justify-content: center;
	}
</style>
<script type="text/javascript">
	function eliminarCamion(padron,matricula){
		console.log('sda');
		console.log(padron);
		console.log(matricula);
		$.ajax({
			url: '/volquetado/logica/altaCamion.php',
			type: 'POST',
			data: {
				accion:"eliminarCamion",
				padron:padron,
				matricula:matricula
			},
			success: function(response){
				console.log(response);
				if(response=="borrado"){
					alert("Camión borrado con exito.");
					location.reload();
				}else if(response=="error"){
					console.log('error');
					alert("Error interno al borrar este camion.");
				}
			}
		});
	}
</script>
</head>
<body style="background-color:#e4e5e6">
	<?php include '../Vistas/barra_menu.php'; 	
	require ('../conexion/abrir_conexion.php');?>
	<div style="position: absolute;width: 20%; margin-left: auto;margin-right: auto;left: 0;right: 0;text-align: center">
		<input id="buscar" style=" display: block;margin-right: auto;margin-left: auto;width: 216px" type="text" name="Buscar" class="form-control" placeholder="Buscar" onkeyup="FiltrarTabla()" />
	</div>
	<?php 
	if($_SESSION['user']==false){
		header('location: ../index.php');
	}?>
	<a href="../Vistas/administradorCamiones.php"><img src="../Imagenes/atras.png" style="width: 50px;height: 50px" /></a>
	<br>
	<table id="tabla" class="table table-striped table-bordered table-hover" style="margin-bottom: 0px;" >
		<thead>
			<tr>
				<th class="active" style = "color: black" >Padrón</th>   
				<th class="active" style = "color: black" >Matricula</th>
				<th class="active" style = "color: black" >Marca</th>
				<th class="active" style = "color: black" >Modelo</th>
				<th class="active" style = "color: black" >Tipo</th>
				<th class="active" style = "color: black" >Eliminar</th>
				
			</tr>
		</thead>
		<tbody style="background-color: #ffffff" class="thead-light">
			<?php
			include '../logica/camion.php'; 
			$camiones = camion::listarCamiones();
			if ($row = mysqli_fetch_array($camiones)) {
				do {
					echo "<tr>";
					echo "<td><p>" . $row["padron"] . "</p></td>";
					echo "<td><p>" . $row["matricula"] . "</p></td>";
					echo "<td><p>" . $row['marca'] . "</p></td>";
					echo"<td><p>" . $row['modelo'] . "</p></td>";
					echo"<td><p>" . $row['tipo'] . "</p></td>";
					$padron=$row["padron"];
					$matricula=$row["matricula"];
					if($row['vivo']==1){
						echo "<td><button onclick=eliminarCamion('".$padron."','".$matricula."') id=\"btnEliminar\" style=\"background:url('../Imagenes/borrar.png');background-position:center center;background-repeat:no-repeat;width:70px; height:25px\" type=\"input\" name=\"Ver\" class=\"btn btn-primary\"></button></td>";
					}
					echo "</tr>";
				} while ($row = mysqli_fetch_array($camiones));
				?>
			<?php }
			?>
		</tbody>
	</table>
</body>
</html>
