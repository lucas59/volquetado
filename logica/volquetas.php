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

    private $nro;
    private $lat;
    private $long;
    private $fechaIngreso;
    private $estadoFisico;
    private $estadoContenido;

    function __construct($nro="0", $lat="0", $long="0", $fechaIngreso="",$estadoFisico="",$estadoContenido="",$circuito="") {
        $this->nro = $nro;
        $this->lat = $lat;
        $this->long = $long;
        $this->fechaIngreso=$fechaIngreso;
        $this->estadoFisico = $estadoFisico;
        $this->estadoContenido = $estadoContenido;
        $this->circuito = $circuito;

    }



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

    public function getVolquetas() {
        ini_set("display_errors", 1);
        error_reporting(E_ALL & ~E_NOTICE);
        $volquetas = [];
        $stmt = DB::conexion()->prepare("SELECT * from volquetas");
        $stmt->execute();
        $resultado = $stmt->get_result();
        while ($fila = $resultado->fetch_object()) { //fetch_object devuelve el resultado 
            $datosVolquetas = new volquetas($fila->nro,$fila->lat,$fila->lng,$fila->fechaIngreso,$fila->estadoFisico,$fila->estadoContenido,$fila->circuito);
            $volquetas[] = $datosVolquetas;
        }
        return $volquetas;
    }
    public function agregarVolqueta($nro,$lat,$long,$fecha,$circuito){
        $conexion = DB::conexion()->prepare("INSERT INTO volquetas(nro,lat,lng,fechaIngreso,estadoFisico,estadoContenido,circuito) VALUES (?,?,?,?,?,?,?)");
        $normal = "Normal";
        $vacio = "Vacio";
        $l=(double)$lat;
        $l2=(double)$long;
        $conexion->bind_param("sddssss",$nro,$l,$l2,$fecha,$normal,$vacio,$circuito);
        if($conexion->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function listarTodas() {
        $conexion = DB::conexion();
        return $resultado = mysqli_query($conexion, "SELECT * FROM volquetas");
    }

    public function mostrarHistoria($nro) {
        $conexion = DB::conexion();
        return $resultado = mysqli_query($conexion, "SELECT * FROM historiavolquetas WHERE nro='".$nro."'");
    }

    public static function existe($numero,$circuito) {
        $consulta = DB::conexion()->prepare("select * from volquetas where nro= ? and circuito = ?");
        $consulta->bind_param("ss",$numero,$circuito);
        $consulta->execute();
        $resultado = $consulta->get_result();
        if ($resultado->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }
}