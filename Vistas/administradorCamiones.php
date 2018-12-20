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

<?php include '../Vistas/barra_menu.php';  
if($_SESSION['user']==false){
header('location: ../index.php');
}?>
</head>
<body style="background-color:#e4e5e6">

	<div id="login-overlay" class="modal-dialog">
		<div class="modal-content" style="margin-top: 18%;">
			<div class="modal-header centrar">
				<h3 style="padding-left: 25%" class="modal-title" id="myModalLabel">Administrador de camiónes</h3>
			</div>
			<div class="modal-body centrar">
				<div class="btn btn-primary btn-block" ><a style="color: #ffff" href="../Vistas/altaCamion.php">Agregar un camión</a></div>
				<div class="btn btn-primary btn-block"><a style="color: #ffff" href="../Vistas/eliminarCamion.php">Eliminar un camión</a></div>
			</div>
		</div>
		<!--***********************************************************************************-->
		<!-- Modal -->
		<script type="text/javascript" src="../js/Oficina.js"></script>
	</body>
	</html>
