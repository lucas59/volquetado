<?php 
require ('../logica/recorrido.php');
include '../logica/usuario.php';
include '../logica/camion.php';
session_start();
if(isset($_SESSION['user'])){
	if(isset($_POST['circuito'])){
		$chofer=$_SESSION['user'];
		$circuito = $_POST["circuito"];
		$matricula= $_POST["camion"];
		$recolector1 = $_POST["recolector1"];
		$recolector2 = $_POST["recolector2"];
		
		$inicio= new DateTime();
		$camion = camion::buscarCamion($matricula);
		$recorrido=new recorrido($circuito, $camion->getPadron(), $camion->getMatricula(), $chofer->getCi(), $recolector1, $recolector2, $inicio,$inicio);
		$_SESSION['recorrido'] = $recorrido;
		$resultado=recorrido::agregarRecorrido($circuito, $camion->getPadron(), $camion->getMatricula(), $chofer->getCi(), $recolector1,$recolector2,$inicio,$inicio);
		if($recorrido){
			echo "inicio";
		}else{
			echo "error";
		}
		return;
	}else if (isset($_POST['accion'])) {
		if($_POST['accion']=="finalizar"){
			$fin=new DateTime();
			$recorrido=$_SESSION['recorrido'];
			$recorrido->setFin($fin);
			$retorno=recorrido::finalizarRecorrido($recorrido);
			if($retorno){
				echo "finalizo";
			}else{
				echo "noFinalizo";
			}
			return;
		}
	}
}
?>}
