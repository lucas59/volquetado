<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css"/>
	<title>Oficina</title>
	<style type="text/css">
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
				<h2 style="padding-left: 25%" class="modal-title" id="myModalLabel">Bienvenido</h2>
			</div>
			<div class="modal-body centrar">
				<div class="btn btn-primary btn-block" ><a style="color: #ffff" href="../Vistas/altaUser.php">Agregar un usuario</a></div>
				<div class="btn btn-primary btn-block"><a style="color: #ffff" href="../Vistas/altaCamion.php">Agregar un camión</a></div>
				<div class="btn btn-primary btn-block"><a style="color: #ffff" href="../Vistas/altaVolqueta.php">Agregar volqueta</a></div>
				<div data-toggle="modal" data-target="#exampleModal" class="btn btn-primary btn-block"><a style="color: #ffff">Agregar circuito</a></div>
			</div>
			<div style="align-content: center" class="modal-footer">
				<div style="display: none;text-align: center;margin-right: 25%;" id="contenedorMensajeExito" class="alert alert-success">
					<input style="border: none;" id="mensajeExito" type="text" class="alert-link"></input>
				</div>
			</div>
		</div>
	</div>
	<!--***********************************************************************************-->
	<!-- Modal -->
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Agregar circuito</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div>
						<input id="circuito" style="text-transform:uppercase" type="text" maxlength="2" name="circuito" required/>
					</div>
				</div>
				<div class="modal-footer">
					<button id="agregarCircuito" style="width: 100%" type="button" class="btn btn-primary">Listo</button>
					<div style="width: 100%">
						<div style="display: none;text-align: center;" id="contenedorMensaje" class="alert alert-danger">
							<input style="border: none;" id="mensaje" type="text" class="alert-link"></input>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="../js/Oficina.js"></script>
</body>
</html>
