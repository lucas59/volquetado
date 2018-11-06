<?php

include '../conexion/abrir_conexion.php';
include '../logica/usuario.php';
session_start();
if (isset($_POST['submit'])) {
    if ((isset($_POST['user']) && (isset($_POST['password'])))) {
        $cedula = $_POST['user'];
        $pass = $_POST['password'];
        $consulta = "SELECT * FROM usuarios WHERE ci=$cedula";
        $conexion= DB::conexion();

        $resultado = mysqli_query($conexion, $consulta);
        $arreglo = mysqli_fetch_array($resultado);
        if ($arreglo) {
            $usuario = new usuario($arreglo['ci'], $arreglo['nombre'], $arreglo['apellido'], $arreglo['cargo'], $arreglo['celular'], $arreglo['direccion'], $arreglo['password']);
            if ($pass == $usuario->getPass()) {
                $_SESSION['user'] = $usuario;

                if ($usuario->getCargo() == "Oficina") {
                    header('location: ../Vistas/oficina.php');
                } else if ($usuario->getCargo() == "Gestor") {
                    header('location: ../Vistas/gestor.php');
                } else if ($usuario->getCargo() == "Chofer") {
                    header('location: ../Vistas/chofer.php');
                } else if ($usuario->getCargo() == "Inspector") {
                    header('location: ../Vistas/inspector.php');
                }
            } else {
                header('location: ../index.php?malPass=Su contraseña no coincide');
            }
        } else {
            //header('location: ../index.php?noExiste=El usuario no existe');
        }
        include '../conexion/cerrar_conexion.php';
    } else {
        header('location: ../index.php?noLlego=nollego');
    }
} else {
    header('location: ../index.php');
}
?>