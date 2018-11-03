<!DOCTYPE html>
<html>
<head>
	<title></title>
	<?php
	if(isset($_GET['mensaje'])){
		echo "<script type='text/javascript'>alert('$mensaje');</script>";
	}
	?>
</head>
<body>
	<div><a href="../Vistas/altaUser.php">Agregar un usuario</a></div>
	<div><a href="../Vistas/altaCamion.php">Agregar un camion</a></div>
	<div><a href="../Vistas/altaVolqueta.php">Agregar volqueta</a></div>
</body>
</html>
