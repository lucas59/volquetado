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
	function eliminarCamion(ci){
		$.ajax({
			url: '/volquetado/logica/altaUsuario.php',
			type: 'POST',
			data: {
				accion:"eliminarUsuario",
				ci:ci,
			},
			success: function(response){
				console.log(response);
				if(response=="borrado"){
					alert("Usuario borrado con exito.");
					location.reload();
				}else if(response=="error"){
					console.log('error');
					alert("Error interno al borrar el usuario.");
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
	<a href="../Vistas/administradorUsuarios.php"><img src="../Imagenes/atras.png" style="width: 50px;height: 50px" /></a>
	<table id="tabla" class="table table-striped table-bordered table-hover" style="margin-bottom: 0px;" >
		<thead>
			<tr>
				<th class="active" style = "color: black" >Cédula</th>   
				<th class="active" style = "color: black" >Nombre</th>
				<th class="active" style = "color: black" >Cargo</th>
				<th class="active" style = "color: black" >Permiso de conducción</th>
				<th class="active" style = "color: black" >Celular</th>
				<th class="active" style = "color: black" >Dirección</th>
				<th class="active" style = "color: black" >Eliminar</th>
				
				
			</tr>
		</thead>
		<tbody style="background-color: #ffffff" class="thead-light">
			<?php
			include '../logica/usuario.php'; 
			$usuarios = usuario::listarUsuarios();
			if ($row = mysqli_fetch_array($usuarios)) {
				do {
					echo "<tr>";
					echo "<td><p>" . $row["ci"] . "</p></td>";
					echo "<td><p>" . $row["nombre"] ." ". $row["apellido"] . "</p></td>";
					echo "<td><p>" . $row['cargo'] . "</p></td>";
					$hoy = date("Y-m-d");
					if($row['cargo']!='Chofer'){
							echo "<td><p>No ingresada</p></td>";
					}else{
						if($hoy<=$row['libreta']){
							echo "<td><p>" . $row['libreta'] . "</p></td>";
						}else{
							echo "<td><p style=\"color: red\">" . $row['libreta'] . "</p></td>";
						}}
						echo "<td><p>" . $row['celular'] . "</p></td>";
						echo "<td><p>" . $row['direccion'] . "</p></td>";
						if($row['activo']==1){
							$ci =$row['ci'];
							echo "<td><button onclick=eliminarCamion('".$ci."') id=\"btnEliminar\" style=\"background:url('../Imagenes/borrar.png');background-position:center center;background-repeat:no-repeat;width:70px; height:25px\" type=\"input\" name=\"Ver\" class=\"btn btn-primary\"></button></td>";
						}
						echo "</tr>";
					} while ($row = mysqli_fetch_array($usuarios));
					?>
				<?php }
				?>
			</tbody>
		</table>
	</body>
	</html>
