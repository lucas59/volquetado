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
//include '../conexion/abrir_conexion.php';
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
        $stmt = DB::conexion()->prepare("SELECT * FROM usuario where ci='" . $cedula . "'");
        $stmt->execute();
        $usuario = $stmt->get_result();
        $usuario_obj = $usuario->fetch_object();
        return $usuario_obj;
    }

    public static function existe($cedula) {
        $a = false;
        $consulta = DB::conexion()->prepare("select * from usuarios where ci='.$cedula'");
        $consulta->execute();
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
        $stmt = DB::conexion()->prepare("SELECT * from usuarios where cargo='Recolector'");
        $stmt->execute();
        $resultado = $stmt->get_result();//$ci, $nombre, $apellido, $cargo, $celular, $direccion, $pass
        while ($fila = $resultado->fetch_object()) { //fetch_object devuelve el resultado 
            $usuario = new usuario($fila->ci,$fila->nombre,$fila->apellido,$fila->cargo,$fila->celular,$fila->direccion,$fila->pass);
            $recolectores[] = $usuario;
        }
        return $recolectores;
    }
}
