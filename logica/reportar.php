<?php 
include '../conexion/abrir_conexion.php';
include '../logica/reporte.php';

if (isset($_POST["accion"])) {
	$accion=$_POST["accion"];
	if($accion=="reportar"){
		$circuito=$_POST["circuito"];
		$numero=$_POST["numero"];
		$estadoFisico=$_POST["estadoFisico"];
		$estadoContenido=$_POST["estadoContenido"];
		$residuosFuera=$_POST["residuo"];
		$nota=$_POST["nota"];
		$inspeccionado = 1;
		$fecha = new DateTime();
		$resultado=reporte::agregarReporte($circuito,$numero,$fecha->format('Y-m-d H:i:s'), $estadoFisico, $estadoContenido, $nota, $residuosFuera, $inspeccionado);
		if($resultado==true){
			echo true;
		}else{
			echo false;
		}
		return;
	}else if ($accion=="aceptarReporte") {
		$circuito=$_POST["circuito"];
		$numero=$_POST["numero"];
		$estadoContenido=$_POST["estadoContenido"];
		$estadoFisico=$_POST["estadoFisico"];
		$residuos=$_POST["residuos"];
		$resultado = reporte::aceptarReporte($circuito,$numero,$estadoContenido,$estadoFisico,$residuos);
		if($resultado==true){
			echo true;
		}else{
			echo false;
		}
	}
	return;
}

?>