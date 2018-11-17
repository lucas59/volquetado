<?php 
require('../conexion/abrir_conexion.php');
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
}
?>