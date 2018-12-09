<?php 
include '../logica/circuito.php';
if(isset($_POST['accion'])){
	$accion=$_POST['accion'];
	if($accion=='agregarCircuito'){
		$circuito=$_POST['circuito'];
		$exite = circuito::getCircuito($circuito);
		if($exite==true){
			return false;
		}else{
			$resultado=circuito::agregarCircuito($circuito);
			if($resultado){
				echo "ok";
			}else{
				echo "error";
			}
		}
		return;
	}
}
?>}
