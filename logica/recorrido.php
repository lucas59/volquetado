<?php

/**
 * 
 */
require('../conexion/abrir_conexion.php');

if(class_exists("recorrido"))
    return;

class recorrido {

    private $circuito;
    private $padron;
    private $matricula;
    private $chofer;
    private $recolector1;
    private $recolector2;
    private $inicio;
    private $fin;

    function __construct($circuito, $padron, $matricula, $chofer, $recolector1, $recolector2, $inicio, $fin) {
        $this->circuito = $circuito;
        $this->padron = $padron;
        $this->matricula = $matricula;
        $this->chofer = $chofer;
        $this->recolector1 = $recolector1;
        $this->recolector2 = $recolector2;
        $this->inicio = $inicio;
        $this->fin = $fin;
    }

    function getCircuito() {
        return $this->circuito;
    }

    function getPadron() {
        return $this->padron;
    }

    function getMatricula() {
        return $this->matricula;
    }

    function getChofer() {
        return $this->chofer;
    }

    function getRecolector1() {
        return $this->recolector1;
    }

    function getRecolector2() {
        return $this->recolector2;
    }

    function getInicio() {
        return $this->inicio;
    }

    function getFin() {
        return $this->fin;
    }

    function setCircuito($circuito) {
        $this->circuito = $circuito;
    }

    function setPadron($padron) {
        $this->padron = $padron;
    }

    function setMatricula($matricula) {
        $this->matricula = $matricula;
    }

    function setChofer($chofer) {
        $this->chofer = $chofer;
    }

    function setRecolector1($recolector1) {
        $this->recolector1 = $recolector1;
    }

    function setRecolector2($recolector2) {
        $this->recolector2 = $recolector2;
    }

    function setInicio($inicio) {
        $this->inicio = $inicio;
    }

    function setFin($fin) {
        $this->fin = $fin;
    }
    public function agregarRecorrido($circuito, $padron, $matricula, $chofer, $recolector1, $recolector2, $inicio,$fin){
        $arranque=$inicio->format('Y-m-d H:i:s');
        $final=$fin->format('Y-m-d Hs:i:s');
        $conexion = DB::conexion()->prepare("INSERT INTO `volquetado_recorrido` (`id`, `circuito`, `padron`, `matricula`, `chofer`, `recolector1`, `recolector2`, `inicio`, `fin`,`terminado`) VALUES (NULL,?,?,?,?,?,?,?,?,0);");
        $conexion->bind_param('ssssssss',$circuito,$padron,$matricula,$chofer,$recolector1,$recolector2,$arranque,$final);
        if($conexion->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function finalizarRecorrido($recorrido){
        $fin=new DateTime();
        $fin2=$fin->format('Y-m-d H:i:s');
        $chofer = $recorrido->getChofer();
        $a = 1;
        echo "<script>console.log(".$fin2.")</script>";
        $inicio=$recorrido->getInicio()->format('Y-m-d H:i:s');
        $conexion=DB::conexion()->prepare("UPDATE volquetado_recorrido SET `fin`=?,`terminado`=? WHERE `chofer`=? and `terminado` = 0 and `inicio`=?;");
        $conexion->bind_param('siss',$fin2,$a,$chofer,$inicio);
        if($conexion->execute()){
            return true;
        }else{
            return false;
        }
    }
}
?>