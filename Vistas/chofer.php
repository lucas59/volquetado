<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="../css/chofer.css">
	<link rel="stylesheet" href="../bootstrap/css/bootstrap.css" type="text/css"/>
	<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css" type="text/css"/>
	<link rel="stylesheet" type="text/css" href="../css/registrar.css">
	<script type="text/javascript" src="../js/jquery.js"></script>
	<title>Chofer</title>
	<?php 
	require ('../conexion/abrir_conexion.php');
	require ('../logica/volquetas.php');
	include '../logica/circuito.php';
	include '../logica/camion.php';
	include '../logica/usuario.php';
	?>
	<style type="text/css">
	#container {
		width:100%;
		text-align:center;
	}

	#left {
		float:left;
		width:100px;
	}

	#center {
		display: inline-block;
		margin:0 auto;
		width:100px;
	}

	#right {
		float:right;
		width:100px;
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
			<div id="container" class="modal-body">
				<div id="left" style="float: left;display: inline-block;">
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
				<div id="center"  style="display:inline-block;margin-right: auto;margin-left: auto" id="recolectores">
					<h4 style="text-align: center;margin-left: auto;" for="circuito" class="control-label">Recolectores</h4>
					<select id="recolector1">
						<?php
						$recolectores = usuario::listarRecolectores();
						for ($i = 0; $i < count($recolectores); $i++) {									
							echo "<option value=".$recolectores[$i]->getCi().">".$recolectores[$i]->getNombre()." ".$recolectores[$i]->getApellido()."</option>";
						}?>
					</select><br>
					<select id="recolector2">
						<?php
						$recolectores = usuario::listarRecolectores();
						for ($i = 0; $i < count($recolectores); $i++) {									
							echo "<option value=".$recolectores[$i]->getCi().">".$recolectores[$i]->getNombre()." ".$recolectores[$i]->getApellido()."</option>";
						}?>
					</select>
				</div>

				<div id="right" style="float: right;" id="camiones">
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