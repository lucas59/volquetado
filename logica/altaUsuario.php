<?php

require ('../conexion/abrir_conexion.php');
require ('../logica/usuario.php');

if (isset($_POST['submit'])) {
    $cedula = $_POST['cedula'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $direccion = $_POST['direccion'];
    $tipo = $_POST['tipo'];
    $pass = $_POST['pass'];
    $passc = $_POST['passc'];
    $celular = $_POST['celular'];
    $fecha = $_POST['fecha'];
    if ($pass != $passc) {
        header('location: ../Vistas/altaUser.php?malPass=Verifique la contraseña');
    } 

    $hoy = new DateTime();
    $annos = $hoy->diff($fecha);

    if ($annos->y>18) {
        header('location: ../Vistas/altaUser.php?edad=verifique su edad');
    } 
    $passencry = sha1($pass);
        //verifico si existe ese usuario
    $existe = usuario::existe($cedula);
    $conexion = DB::conexion();
    if ($existe==true) {
        header('location: ../Vistas/altaUser.php?noexito=Este usuario ya existe');
    } else {
        $sql = "INSERT INTO usuarios (ci, nombre, apellido,cargo,celular,direccion,password)
        VALUES ('$cedula', '$nombre', '$apellido','$tipo','$celular','$direccion','$passencry')";
        $resultado = mysqli_query($conexion, $sql);
        if ($resultado == TRUE) {
            header('location: ../Vistas/altaUser.php?exito=Usuario ingresado al sistema con exito');
        } else {
            header('location: ../Vistas/altaUser.php?fallo=fallo la consulta');
        }
    }

    include '../conexion/cerrar_conexion.php';
}
?>
