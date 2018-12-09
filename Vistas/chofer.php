<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="../css/chofer.css">
	<link rel="stylesheet" href="../bootstrap/css/bootstrap.css" type="text/css"/>
	<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css" type="text/css"/>
	<link rel="stylesheet" type="text/css" href="../css/registrar.css">
	<script type="text/javascript" src="../js/jquery.js"></script>
	<title>Chofer</title>
	<style type="text/css">
	<?php 
	require ('../conexion/abrir_conexion.php');
	require ('../logica/volquetas.php');
	include '../logica/circuito.php';
	include '../logica/camion.php';
	include '../logica/usuario.php';
	?>
	#centrar{
		align-items: center;
		display: flex;
		justify-content: center;
	}
</style>
</head>
<body style="background-color:#e4e5e6">
	<?php include '../Vistas/barra_menu.php'; ?>

	<div id="login-overlay" class="modal-dialog">
		<div class="modal-content" style="margin-top: 18%;">
			<div class="modal-header centrar">
				<h2 style="padding-left: 25%px" class="modal-title" id="myModalLabel">Bienvenido</h2>
			</div>
			<div class="modal-body">
				<div style="float: left;display: inline-block;">
					<h4 style="" for="circuito" class="control-label">Circuito</h4>
					<div class="select">
						<?php
						$circuito = circuito::listarCircuitos();
						if ($row = mysqli_fetch_array($circuito)) {
							?>
							<select id="circuito">
								<?php
								do {
									echo "<option>" . $row['circuito'] . "</option>";
								} while ($row = mysqli_fetch_array($circuito));
								?>
							</select>
						<?php } ?>
					</div>
				</div>
				<div style="display:inline-block;" id="recolectores">
					<h4 style="text-align: center;margin-left: auto;" for="circuito" class="control-label">Recolectores</h4>
					<form name="recolectores">
						<?php
						$recolectores = usuario::listarRecolectores();
						for ($i = 0; $i < count($recolectores); $i++) {									
							echo "<input value=\"".$recolectores[$i]->getCi()."\" name=\"recolector\" type=\"checkbox\" checked=\"checked\">";
							echo "<label>".$recolectores[$i]->getNombre()." ".$recolectores[$i]->getApellido()."</label>";
							echo("<br>");
						}?>
					</form>
				</div>

				<div style="float: right;" id="camiones">
					<h4 style="text-align: center;margin-left: auto;" for="circuito" class="control-label">Camión</h4>
					<?php
					$camiones = camion::listarCamiones();
					if ($row = mysqli_fetch_array($camiones)) {
						?>
						<select id="vehiculos">
							<?php
							do {
								echo "<option>".$row['matricula']."</option>";
								echo("<br>");
							} while ($row = mysqli_fetch_array($camiones));
							?>
						</select>
					<?php } ?>
				</div>

			</div>
			<div class="modal-header centrar">
				<button id="iniciar" name="submit" type="submit" style="background-color: #287AE6; color : white"  class="btn btn-block">Iniciar circuito</button>
			</div>	
		</div>
		<script type="text/javascript" src="../js/iniciarRecorrido.js"></script>
	</body>
	</html>