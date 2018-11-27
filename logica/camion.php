<?php

/**
 * 
 */
if(class_exists("camion"))
    return;

class camion {

    private $matricula;
    private $marca;
    private $modelo;
    private $tipo;

    function __construct($matricula, $marca, $modelo, $tipo) {
        $this->matricula = $matricula;
        $this->marca = $marca;
        $this->modelo = $modelo;
        $this->tipo = $tipo;
    }

    function getMatricula() {
        return $this->matricula;
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
        $consulta = DB::conexion()->prepare("select * from camion where padron=$padron AND matricula=$matricula");
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

}

?>