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
		$inspeccionado=$_POST["inspeccionado"];
		$base64=null;
		if(isset($_FILES["archivo"])){
			$base64 = base64_encode($_FILES['archivo']['tmp_name']);
		}
		$fecha = new DateTime();
		$resultado=reporte::agregarReporte($circuito,$numero,$fecha->format('Y-m-d H:i:s'), $estadoFisico, $estadoContenido, $nota, $residuosFuera, $inspeccionado,$base64);
		if($resultado){
			echo '1';
		}else{
			echo '0';
		}
		return;
	}else if ($accion=="aceptarReporte") {
		$circuito=$_POST["circuito"];
		$numero=$_POST["numero"];
		$estadoContenido=$_POST["estadoContenido"];
		$estadoFisico=$_POST["estadoFisico"];
		$residuos=$_POST["residuos"];
		echo "<script>console.log(".$numero.")</script>";
		$resultado = reporte::aceptarReporte($circuito,$numero,$estadoContenido,$estadoFisico,$residuos);
		if($resultado==true){
			echo true;
		}else{
			echo false;
		}
	}else if($accion=="nuevoReporte"){
		$circuito=$_POST["circuito"];
		$volqueta=$_POST["volqueta"];
		$estadoContenido=$_POST["estadoContenido"];
		$estadoFisico=$_POST["estadoFisico"];
		$residuos=$_POST["residuos"];
		$nota=$_POST["nota"];
		$base64=null;
		if(isset($_FILES["archivo"])){
			$base64 = base64_encode(file_get_contents($_FILES['archivo']['tmp_name']));
		}
		$fecha = new DateTime();
		$inspeccionado=$_POST["inspeccionado"];
		$resultado = reporte::nuevoReporte($circuito,$volqueta,$fecha->format('Y-m-d H:i:s'),$estadoFisico,$estadoContenido,$nota,$residuos,$inspeccionado,$base64);
		if($resultado==true){
			echo '1';
		}else{
			echo '0';
		}
		return;
	}
}
?>