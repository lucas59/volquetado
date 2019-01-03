<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of usuario
 *
 * @author Lucas
 */
if(class_exists("usuario"))
    return;

class usuario {

    private $ci;
    private $nombre;
    private $apellido;
    private $cargo;
    private $celular;
    private $direccion;
    private $pass;

    function __construct($ci, $nombre, $apellido, $cargo, $celular, $direccion, $pass) {
        $this->ci = $ci;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->cargo = $cargo;
        $this->celular = $celular;
        $this->direccion = $direccion;
        $this->pass = $pass;
    }
    
    

    function getCi() {
        return $this->ci;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getApellido() {
        return $this->apellido;
    }

    function getCargo() {
        return $this->cargo;
    }

    function getCelular() {
        return $this->celular;
    }

    function getDireccion() {
        return $this->direccion;
    }

    function getPass() {
        return $this->pass;
    }

    function setCi($ci) {
        $this->ci = $ci;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setApellido($apellido) {
        $this->apellido = $apellido;
    }

    function setCargo($cargo) {
        $this->cargo = $cargo;
    }

    function setCelular($celular) {
        $this->celular = $celular;
    }

    function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    function setPass($pass) {
        $this->pass = $pass;
    }

    public static function getUsuarios() {
        ini_set("display_errors", 1);
        error_reporting(E_ALL & ~E_NOTICE);
        $usuarios = [];
        $stmt = DB::conexion()->prepare(
            "SELECT * from usuarios");
        $stmt->execute();
        $resultado = $stmt->get_result();
        while ($fila = $resultado->fetch_object()) { //fetch_object devuelve el resultado como un objeto
            $datosPersona = $this->datosVerPerfil($fila->ci);
            $usuarios[] = $datosPersona;
        }
        return $usuarios;
    }

    public function datosVerPerfil($cedula) {
        $stmt = DB::conexion()->prepare("SELECT * FROM volquetado_usuarios where ci='" . $cedula . "'");
        $stmt->execute();
        $usuario = $stmt->get_result();
        $usuario_obj = $usuario->fetch_object();
        return $usuario_obj;
    }

    public static function existe($cedula) {
        $a = false;
        $consulta = DB::conexion()->prepare("select * from volquetado_usuarios where ci='".$cedula."'");
        $consulta->execute();
        //$consulta = DB::conexion()->prepare("select * from historiavolquetas as hvv where fecha IN (select MAX(fecha) from historiavolquetas as hv where hv.circuito=hvv.circuito and hv.nro=hvv.nro)  and circuito = ? GROUP BY nro ORDER BY fecha DESC");
        $resultado = $consulta->get_result();
        if ($resultado->num_rows == 1) {
            return true;
        } else if($resultado->num_rows==0) {
            return false;
        }
    }

    function calcularEdad($fecha_nacimiento) { 
        $tiempo = strtotime($fecha); 
        $ahora = time(); 
        $edad = ($ahora-$tiempo)/(60*60*24*365.25); 
        $edad = floor($edad); 
        return $edad; 
    } 

    public function listarRecolectores() {
        ini_set("display_errors", 1);
        error_reporting(E_ALL & ~E_NOTICE);
        $recolectores= [];
        $stmt = DB::conexion()->prepare("SELECT * from volquetado_usuarios where cargo='Recolector'");
        $stmt->execute();
        $resultado = $stmt->get_result();//$ci, $nombre, $apellido, $cargo, $celular, $direccion, $pass
        while ($fila = $resultado->fetch_object()) { //fetch_object devuelve el resultado 
            $usuario = new usuario($fila->ci,$fila->nombre,$fila->apellido,$fila->cargo,$fila->celular,$fila->direccion,$fila->pass);
            $recolectores[] = $usuario;
        }
        return $recolectores;
    }
    public function registrar($cedula,$nombre,$apellido,$direccion,$tipo,$passencry,$celular,$fecha,$libreta){
        $consulta = DB::conexion()->prepare("INSERT INTO `volquetado_usuarios` (`ci`, `nombre`, `apellido`, `nacimiento`, `libreta`, `cargo`, `celular`, `direccion`, `password`) VALUES (?,?,?,?,?,?,?,?,?)");
        //INSERT INTO `usuarios` (`ci`, `nombre`, `apellido`, `nacimiento`, `libreta`, `cargo`, `celular`, `direccion`, `password`) VALUES ('123', 'lucas', 'cieri', '1998-12-04 00:00:00', '2018-12-29 00:00:00', 'Recolector', '4567890', 'iubisauyhdbas', 'asd');
        $consulta->bind_param("sssssssss",$cedula,$nombre,$apellido,$fecha,$libreta,$tipo,$celular,$direccion,$passencry);
        if($consulta->execute()){
            return true;
        }else{
            return false;
        }
    }
    public function listarUsuarios() {
        $conexion = DB::conexion();
        return $resultado = mysqli_query($conexion, "SELECT * from volquetado_usuarios");
    }

    public function eliminarUsuario($cedula){
        $consulta = DB::conexion()->prepare('UPDATE volquetado_usuarios SET activo = 0 WHERE ci=?');
        $consulta->bind_param("s",$cedula);
        if($consulta->execute()){
            return true;
        }else{
            return false;}

        }
        public function activarUsuario($cedula){
            $consulta = DB::conexion()->prepare('UPDATE volquetado_usuarios SET activo = 1 WHERE ci=?');
            $consulta->bind_param("s",$cedula);
            if($consulta->execute()){
                return true;
            }else{
                return false;}

            }
        }
