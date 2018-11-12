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
    private $estado;

    function __construct($nro="0", $lat="0", $long="0", $fechaIngreso="",$estado="") {
        $this->nro = $nro;
        $this->lat = $lat;
        $this->long = $long;
        $this->fechaIngreso=$fechaIngreso;
        $this->estado = $estado;
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


    function getEstado() {
        return $this->estado;
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


    function setEstado($estado) {
        $this->estado = $estado;
    }

    public function getVolquetas() {
        ini_set("display_errors", 1);
        error_reporting(E_ALL & ~E_NOTICE);
        $volquetas = [];
        $stmt = DB::conexion()->prepare(
            "SELECT * from volquetas");
        $stmt->execute();
        $resultado = $stmt->get_result();
        while ($fila = $resultado->fetch_object()) { //fetch_object devuelve el resultado 
            $datosVolquetas = new volquetas($fila->nro,$fila->lat,$fila->lng,$fila->fechaIngreso,$fila->estado);
            $volquetas[] = $datosVolquetas;
        }
        return $volquetas;
    }
    public function agregarVolqueta($nro,$lat,$long,$fecha,$circuito){
        $conexion = DB::conexion()->prepare("INSERT INTO volquetas(nro,lat,lng,fechaIngreso,estado,circuito) VALUES (?,?,?,?,?,?)");
        $normal = "Normal";
        $l=(double)$lat;
        $l2=(double)$long;
        $conexion->bind_param("sddsss",$nro,$l,$l2,$fecha,$normal,$circuito);
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

    public function datosVolqueta($nro) {
        $stmt = DB::conexion()->prepare("SELECT nro, fechaIngreso,estado  FROM volquetas where nro='" . $nro . "'");
        $stmt->execute();
        $volqueta = $stmt->get_result();
        $volqueta_obj = $volqueta->fetch_object();
        return $volqueta_obj;
    }

}