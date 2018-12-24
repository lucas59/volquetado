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
    private $vivo;

    function __construct($padron,$matricula, $marca, $modelo, $tipo, $vivo) {
        $this->padron=$padron;
        $this->matricula = $matricula;
        $this->marca = $marca;
        $this->modelo = $modelo;
        $this->tipo = $tipo;
        $this->vivo=$vivo;
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

    function getVivo() {
        return $this->vivo;
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

    function setVivo($vivo) {
        $this->vivo = $vivo;
    }
    
    public function habilidatCamion($padron,$matricula,$marca,$modelo,$tipo){
        $consulta=DB::conexion()->prepare("UPDATE camion SET vivo = '1', marca =?,modelo=?,tipo=? WHERE padron = ? AND matricula = ?");
        $consulta->bind_param('sssss',$marca,$modelo,$tipo,$padron,$matricula);
        if($consulta->execute()){
            return true;
        }else{
            return false;
        }
    }

    public static function existeCamion($padron,$matricula) {
        $retorno;
        $consulta = DB::conexion()->prepare("select * from camion where padron=? AND matricula=?");
        $consulta->bind_param("ss",$padron,$matricula);
        $consulta->execute();
        //
        $resultado = $consulta->get_result();
        if($fila = $resultado->fetch_object()) { //fetch_object devuelve el resultado 
            $camion=new camion($fila->padron,$fila->matricula,$fila->marca,$fila->modelo,$fila->tipo,$fila->vivo);
        }
        //
        if ($camion) {
            if($camion->getVivo()==1){
                $retorno=1;
            }else {
                $retorno=2;
            }
        } else {
            $retorno=0;
        }
        return $retorno;
    }

    public static function ingresar($padron,$matricula, $marca, $modelo, $tipo) {
        $conexion = DB::conexion();
        $sql = "INSERT INTO camion (padron,matricula, marca, modelo, tipo,vivo) VALUES('$padron','$matricula','$marca','$modelo','$tipo',1)";
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
            $camion=new camion($fila->padron,$fila->matricula,$fila->marca,$fila->modelo, $fila->tipo,$fila->vivo);
        }
        return $camion;
    }
    public function borrarCamion($padron,$matricula){
     $consulta=DB::conexion()->prepare("UPDATE camion SET vivo = '0' WHERE padron = ? AND matricula = ?");
     $consulta->bind_param('ss',$padron,$matricula);
     if($consulta->execute()){
        return true;
    }else{
        return false;
    }
}
}

?>