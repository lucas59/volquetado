<?php

/**
 * 
 */
if(class_exists("camion"))
    return;

class camion {

    private $padron;
    private $matricula;
    private $marca;
    private $modelo;
    private $tipo;

    function __construct($padron,$matricula, $marca, $modelo, $tipo) {
        $this->padron=$padron;
        $this->matricula = $matricula;
        $this->marca = $marca;
        $this->modelo = $modelo;
        $this->tipo = $tipo;
    }

    function getMatricula() {
        return $this->matricula;
    }
    function getPadron() {
        return $this->padron;
    }
    function getMarca() {
        return $this->marca;
    }

    function getModelo() {
        return $this->modelo;
    }

    function getTipo() {
        return $this->tipo;
    }

    function setMatricula($matricula) {
        $this->matricula = $matricula;
    }
    function setPadron($padron) {
        $this->padron = $padron;
    }

    function setMarca($marca) {
        $this->marca = $marca;
    }

    function setModelo($modelo) {
        $this->modelo = $modelo;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    public static function existeCamion($padron,$matricula) {
        $consulta = DB::conexion()->prepare("select * from camion where padron=? AND matricula=?");
        $consulta->bind_param("ss",$padron,$matricula);
        $consulta->execute();
        $resultado = $consulta->get_result();
        if ($resultado->num_rows == 1) {
            return true;
        } else if ($resultado->num_rows == 0) {
            return false;
        }
    }

    public static function ingresar($padron,$matricula, $marca, $modelo, $tipo) {
        $conexion = DB::conexion();
        $sql = "INSERT INTO camion (padron,matricula, marca, modelo, tipo) VALUES('$padron','$matricula','$marca','$modelo','$tipo')";
        $resultado = mysqli_query($conexion, $sql);
        if ($resultado == TRUE) {
            return true;
        } else {
            return false;
        }
    }
    public static function listarCamiones() {
        $conexion = DB::conexion();
        return $resultado = mysqli_query($conexion, "SELECT * from camion");
    }
    public function buscarCamion($matricula){
        $consulta=DB::conexion()->prepare("SELECT * FROM camion where matricula=?");
        $consulta->bind_param("s",$matricula);
        $consulta->execute();
        $resultado = $consulta->get_result();
        $camion;
        if($fila = $resultado->fetch_object()) { //fetch_object devuelve el resultado como un objeto
            $camion=new camion($fila->padron,$fila->matricula,$fila->marca,$fila->modelo, $fila->tipo);
        }
        return $camion;
    }

}

?>