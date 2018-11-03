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
    
}
