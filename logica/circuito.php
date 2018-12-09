<?php 
include('../conexion/abrir_conexion.php');

if(class_exists("circuito"))
	return;

class circuito  {

	private $codigo;

	function getCodigo(){
		return $this->codigo;
	}

	function setCodigo($codigo){
		$this->codigo=$codigo;
	}

	function __construct($codigo){
		$this->codigo=$codigo;
	}

	public static function listarCircuitos() {
		$conexion = DB::conexion();
		return $resultado = mysqli_query($conexion, "SELECT * FROM circuito");
	}

	public function agregarCircuito($circuito){
			$insert = DB::conexion()->prepare("INSERT INTO `circuito` (`circuito`) VALUES (?)");
			$insert->bind_param("s",$circuito);
			if($insert->execute()){
				return true;
			}else{
				return false;
			}
	}

	public function getCircuito($circuito){
		$consulta = DB::conexion()->prepare("SELECT * from circuito where circuito = ?");
		$consulta->bind_param("s",$circuito);
		$consulta->execute();
		$resultado=$consulta->get_result();
		if ($resultado->num_rows == 1) {
			return true;
		} else if ($resultado->num_rows == 0) {
			return false;
		}
	}
}
?>