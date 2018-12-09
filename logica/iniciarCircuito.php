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
		$recolectores = $_POST["recolectores"];
		$inicio= new DateTime();
		$camion = camion::buscarCamion($matricula);
		$recorrido=new recorrido($circuito, $camion->getPadron(), $camion->getMatricula(), $chofer->getCi(), $recolectores[0], $recolectores[1], $inicio,$inicio);
		$_SESSION['recorrido'] = $recorrido;
		$resultado=recorrido::agregarRecorrido($circuito, $camion->getPadron(), $camion->getMatricula(), $chofer->getCi(), $recolectores[0],$recolectores[1],$inicio,$inicio);
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
