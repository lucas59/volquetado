<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of volquetas
 *
 * @author Lucas
 */

require('../conexion/abrir_conexion.php');

if(class_exists("volquetas"))
    return;

class volquetas {

    public $nro;
    public $lat;
    public $long;
    public $fechaIngreso;
    public $estadoFisico;
    public $estadoContenido;
    public $circuito;
    public $activa;

    function __construct($nro, $lat, $long, $fechaIngreso, $estadoFisico, $estadoContenido, $circuito, $activa) {
        $this->nro = $nro;
        $this->lat = $lat;
        $this->long = $long;
        $this->fechaIngreso = $fechaIngreso;
        $this->estadoFisico = $estadoFisico;
        $this->estadoContenido = $estadoContenido;
        $this->circuito = $circuito;
        $this->activa = $activa;
    }

    /*function __construct($nro, $lat, $long, $fechaIngreso,$estadoFisico,$estadoContenido,$circuito,$activa) {
        $this->nro = $nro;
        $this->lat = $lat;
        $this->long = $long;
        $this->fechaIngreso=$fechaIngreso;
        $this->estadoFisico = $estadoFisico;
        $this->estadoContenido = $estadoContenido;
        $this->circuito = $circuito;
        $this->activa = $activa;
    }*/
/*
 function __construct($padron,$matricula, $marca, $modelo, $tipo, $vivo) {
        $this->padron=$padron;
        $this->matricula = $matricula;
        $this->marca = $marca;
        $this->modelo = $modelo;
        $this->tipo = $tipo;
        $this->vivo=$vivo;
    }
    */


    function getCircuito() {
        return $this->circuito;
    }

    function getNro() {
        return $this->nro;
    }

    function getLat() {
        return $this->lat;
    }

    function getLong() {
        return $this->long;
    }

    function getFechaIngreso() {
        return $this->fechaIngreso;
    }


    function getEstadoFisico() {
        return $this->estadoFisico;
    }


    function getEstadoContenido() {
        return $this->estadoContenido;
    }

    function getActiva() {
        return $this->activa;
    }

    function setCircuito($nro) {
        $this->circuito= $circuito;
    }

    function setNro($nro) {
        $this->nro = $nro;
    }

    function setLat($lat) {
        $this->lat = $lat;
    }

    function setLong($long) {
        $this->long = $long;
    }

    function setFechaIngreso($fechaIngreso) {
        $this->fechaIngreso= $fechaIngreso;
    }


    function setEstadoFisico($estadoFisico) {
        $this->estadoFisico = $estadoFisico;
    }

    function setEstadoContenido($estadoContenido) {
        $this->estadoContenido = $estadoContenido;
    }
    function setActiva($activa) {
        $this->activa = $activa;
    }

    public function getVolquetas() {
        ini_set("display_errors", 1);
        error_reporting(E_ALL & ~E_NOTICE);
        $volquetas = [];
        $stmt = DB::conexion()->prepare("SELECT * from volquetado_volquetas");
        $stmt->execute();
        $resultado = $stmt->get_result();
        while ($fila = $resultado->fetch_object()) { //fetch_object devuelve el resultado 
            if($fila->activa==1){
                $datosVolquetas = new volquetas($fila->nro,$fila->lat,$fila->lng,$fila->fechaIngreso,$fila->estadoFisico,$fila->estadoContenido,$fila->circuito,$fila->activa);
                $volquetas[] = $datosVolquetas;
            }
        }
        //$nro, $lat, $long, $fechaIngreso,$estadoFisico,$estadoContenido,$circuito,$activa
        return $volquetas;
    }

    public function listarVolquetasDeCircuito($circuito){
        ini_set("display_errors", 1);
        error_reporting(E_ALL & ~E_NOTICE);
        $volquetas = [];
        $stmt = DB::conexion()->prepare("SELECT * from volquetado_volquetas where circuito=? and activa = 1");
        $stmt->bind_param("s",$circuito);
        $stmt->execute();
        $resultado = $stmt->get_result();
        while ($fila = $resultado->fetch_object()) { //fetch_object devuelve el resultado 
            if($fila->activa==1){
                $datosVolquetas = new volquetas($fila->nro,$fila->lat,$fila->lng,$fila->fechaIngreso,$fila->estadoFisico,$fila->estadoContenido,$fila->circuito,$fila->activa);
                $volquetas[] = $datosVolquetas;
            }
        }
        return $volquetas;
    }

    public function listarVolquetasPorCircuito($circuito){
        ini_set("display_errors", 1);
        error_reporting(E_ALL & ~E_NOTICE);
        $volquetas = [];
        $stmt = DB::conexion()->prepare("SELECT * from volquetado_volquetas where circuito=? and activa = ?");
        $stmt->bind_param("si",$circuito,1);
        $stmt->execute();
        $resultado = $stmt->get_result();
        while ($fila = $resultado->fetch_object()) { //fetch_object devuelve el resultado 
            $datosVolquetas = new volquetas($fila->nro,$fila->lat,$fila->lng,$fila->fechaIngreso,$fila->estadoFisico,$fila->estadoContenido,$fila->circuito,$fila->activa);
            $volquetas[] = $datosVolquetas;
        }
        return $volquetas;
    }

    public function listarVolquetasParaMostrar($circuito){
        $volquetas = [];
        $stmt = DB::conexion()->prepare("SELECT * from volquetado_volquetas where activa = 1");
        $stmt->execute();
        $resultado = $stmt->get_result();
        if($circuito=='Todos'){
        while ($fila = $resultado->fetch_object()) { //fetch_object devuelve el resultado 
            $datosVolquetas = new volquetas($fila->nro,$fila->lat,$fila->lng,$fila->fechaIngreso,$fila->estadoFisico,$fila->estadoContenido,$fila->circuito,$fila->activa);
            $volquetas[] = $datosVolquetas;
        }
    }else{
        while ($fila = $resultado->fetch_object()) { //fetch_object devuelve el resultado 
            if($fila->circuito==$circuito){
                $datosVolquetas = new volquetas($fila->nro,$fila->lat,$fila->lng,$fila->fechaIngreso,$fila->estadoFisico,$fila->estadoContenido,$fila->circuito,$fila->activa);
                $volquetas[] = $datosVolquetas;
            }        
        }
    }
    return $volquetas;
}


public function agregarVolqueta($nro,$lat,$long,$fecha,$circuito,$forma){

    if($forma==2){
        $consulta=DB::conexion()->prepare("UPDATE volquetado_volquetas SET lat=?,lng=?,activa=1 WHERE nro=? AND circuito=?");
        $consulta->bind_param("ddss",$lat,$long,$nro,$circuito);
        if($consulta->execute()){
            return true;
        }else{
            return false;}
        }else if($forma==0){  
            $conexion = DB::conexion()->prepare("INSERT INTO volquetado_volquetas(nro,lat,lng,fechaIngreso,estadoFisico,estadoContenido,circuito,activa) VALUES (?,?,?,?,?,?,?,1)");
            $normal = "Normal";
            $vacio = "Vacio";
            //$l=(double)$lat;
            //$l2=(double)$long;
            echo "<scipt>console.log('".$forma."');</script>";
            
            $conexion->bind_param("sddssss",$nro,$lat,$long,$fecha,$normal,$vacio,$circuito);
            if($conexion->execute()){
                return true;
            }else{
                return false;
            }
        }
    }
    public function borrar($numero,$circuito){
       $consulta=DB::conexion()->prepare("UPDATE volquetado_volquetas SET activa=0 WHERE nro=? AND circuito=? ");
       $consulta->bind_param("ss",$numero,$circuito);
       if($consulta->execute()){
        return true;
    }else{
        return false;}

    }

    public function listarTodas() {
        $consulta = DB::conexion()->prepare("SELECT * FROM volquetado_volquetas WHERE activa = 1 ORDER by circuito ASC");
        $consulta->execute();
        $resultado = $consulta->get_result();
        return $resultado;
    }

    public function mostrarHistoria($nro) {
        $consulta = DB::conexion()->prepare("SELECT * FROM volquetado_historiavolquetas WHERE nro=? ORDER BY fecha DESC");
        $consulta->bind_param("i",$nro);
        $consulta->execute();
        $resultado = $consulta->get_result();
        return $resultado;
    }

    public static function existe($numero,$circuito) {
        $retorno;
        $consulta = DB::conexion()->prepare("select * from volquetado_volquetas where nro= ? and circuito = ?");
        $consulta->bind_param("ss",$numero,$circuito);
        $consulta->execute();
        $resultado = $consulta->get_result();
        $volqueta=null;
        if ($fila = $resultado->fetch_object()) {
            $volqueta = new volquetas($fila->nro,$fila->lat,$fila->lng,$fila->fechaIngreso,$fila->estadoFisico,$fila->estadoContenido,$fila->circuito,$fila->activa);
        }
        if($volqueta){
            if($volqueta->getActiva()==1){
                $retorno=1;
            }else{
                $retorno=2;
            }
        }else{
            $retorno=0;
        }     
        return $retorno;
    }
}