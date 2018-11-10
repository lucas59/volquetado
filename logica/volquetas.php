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
            $datosVolquetas = new volquetas($fila->nro,$fila->lat,$fila->long,$fila->fechaIngreso,$fila->estado);
            $volquetas[] = $datosVolquetas;
        }
        return $volquetas;
    }

    public function listarTodas() {
        $conexion = DB::conexion();
        return $resultado = mysqli_query($conexion, "SELECT * FROM volquetas");
    }

    public function mostrarHistoria($nro) {
        $conexion = DB::conexion();
        return $resultado = mysqli_query($conexion, "SELECT * FROM historiavolquetas WHERE nro='".$nro."'");
    }

    



    public function datosVolqueta($nro) {
        $stmt = DB::conexion()->prepare("SELECT nro, fechaIngreso,estado  FROM volquetas where nro='" . $nro . "'");
        $stmt->execute();
        $volqueta = $stmt->get_result();
        $volqueta_obj = $volqueta->fetch_object();
        return $volqueta_obj;
    }

}

if(isset($_GET['funcion'])){
    $funcion = $_GET['funcion'];
    switch ($funcion) {
        case 'agregar':
        $numero= $_GET['numero'];
        $circuito= $_GET['circuito'];
        $lat= $_GET['lat'];
        $long= $_GET['long'];
        $fecha=new date('d-m-Y');

        function agregarVolqueta($numero,$circuito){
            $conexion = DB::conexion();
            $consulta="select * from volquetas where circuito='$circuito' and nro'$numero'";
            $resultado = mysqli_query($conexion,$consulta);
            if(mysqli_num_rows($resultado)==0){
                $ingreso ="INSERT INTO volquetas(nro,lat,long,fechaIngreso,estado,circuito) VALUES('$numero','$lat','$long','$fecha','Normal','$circuito')";
                $resultado = mysqli_query($conexion, $ingreso);
                if ($resultado == TRUE) {
                    return true;
                } else {
                    return false;
                }
            }else {
                return false;
            }
        }
        break;
        
        default:
            # code...
        break;
    }
}