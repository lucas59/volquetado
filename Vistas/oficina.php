<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css"/>
	<script type="text/javascript"></script>
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
				<h2 style="padding-left: 25%px" class="modal-title" id="myModalLabel">Bienvenido</h2>
			</div>
			<div class="modal-body centrar">
				<div class="btn btn-primary btn-block" ><a style="color: #ffff" href="../Vistas/altaUser.php">Agregar un usuario</a></div>
				<div class="btn btn-primary btn-block"><a style="color: #ffff" href="../Vistas/altaCamion.php">Agregar un camion</a></div>
				<div class="btn btn-primary btn-block"><a style="color: #ffff" href="../Vistas/altaVolqueta.php">Agregar volqueta</a></div>
			</div>
		</div>
	</div>
</div>

</body>
</html>
